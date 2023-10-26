<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganElektreController extends Controller
{
    public function index()
    {
        $matriks = DB::table('evaluasi_elektre')
                ->select('*')
                ->orderBy('alternatif_id')
                ->orderBy('kriteria_id')
                ->get();
        
        $bobot = DB::table('kriterias')
                ->select('bobot')
                ->orderBy('id')
                ->get();

        $array = $this->toArray($matriks);
        $normalisasi = $this->normalizedMatrix($array);
        $preferensi = $this->weightingNormalizedMatrix($normalisasi, $bobot);

        $m = 5;
        $n = 4;
        $index = $this->findConcordanceDiscordanceIndex($preferensi, $m, $n);

        $concordancematrix = $this->findConcordanceMatrix($index['concordance'], $bobot, $m);
        $disordancematrix = $this->findDiscordanceMatrix($preferensi, $index['discordance'], $m, $n);

        $concordanceThreshold = $this->findThresholdC($concordancematrix, $m);
        $discordanceThreshold = $this->findThresholdD($disordancematrix, $m);

        $concordanceDominance = $this->findConcordanceDominance($concordancematrix, $concordanceThreshold);
        $discordanceDominance = $this->findDiscordanceDominance($disordancematrix, $discordanceThreshold);
        $aggregateDominance = $this->findAggregateDominance($concordanceDominance, $discordanceDominance);  

        return view('electre', [
            'array'=> $array, 
            'normalisasi' => $normalisasi,
            'bobot' => $bobot,
            'preferensi' => $preferensi,
            'concordanceIndex' => $index['concordance'],
            'discordanceIndex' => $index['discordance'],
            'concordanceMatrix' => $concordancematrix,
            'discordanceMatrix' => $disordancematrix,
            'concordanceThreshold' => $concordanceThreshold,
            'discordanceThreshold' => $discordanceThreshold,
            'concordanceDominance' => $concordanceDominance,
            'discordanceDominance' => $discordanceDominance,
            'aggregateDominance' => $aggregateDominance,
        ]);
    }

    public function toArray($matrix)
    {
        foreach ($matrix as $m) {
            $result[$m->alternatif_id][$m->kriteria_id] = $m->value;
        }

        return $result;
    }

    public function normalizedMatrix(array $matrix)
    {
        // $matrix[A][C]
        for ($i = 1; $i <= count($matrix[1]); $i++) { // kriteria
            $xb = 0;
            for ($j = 1; $j <= count($matrix); $j++) { // alternatif
                $xb += pow($matrix[$j][$i], 2);
            }
            $xb = sqrt($xb);

            for ($k = 1; $k <= count($matrix); $k++) { // alternatif
                $normalisasi[$k][$i] = round($matrix[$k][$i] / $xb, 3);
            }
        }

        return $normalisasi;
    }

    public function weightingNormalizedMatrix($nMatrix, $kriteria)
    {
        for ($i = 1; $i <= count($nMatrix[1]); $i++) { // kriteria
            for ($j = 1; $j <= count($nMatrix); $j++) { // alternatif
                $v[$j][$i] = $nMatrix[$j][$i] * $kriteria[$i - 1]->bobot;
            }
        }

        return $v;
    }

    public function findConcordanceDiscordanceIndex(array $matrixV, $m, $n)
    {
        $index = '';

        for ($k = 1; $k <= $m; $k++) {
            if ($index != $k) {
                $index = $k;
                $c[$k] = [];
                $d[$k] = [];
            }
            for ($l = 1; $l <= $m; $l++) {
                if ($k != $l) {
                    for ($j = 1; $j <= $n; $j++) {
                        if (!isset($c[$k][$l])) $c[$k][$l] = [];
                        if (!isset($d[$k][$l])) $d[$k][$l] = [];

                        if ($matrixV[$k][$j] >= $matrixV[$l][$j]) {
                            array_push($c[$k][$l], $j);
                        } else if ($matrixV[$k][$j] < $matrixV[$l][$j]) {
                            array_push($d[$k][$l], $j);
                        }
                    }
                }
            }
        }

        return [
            'concordance' => $c,
            'discordance' => $d,
        ];
    }

    public function findConcordanceMatrix(array $c, $kriteria, $m)
    {
        $c_index = '';

        for ($k = 1; $k <= $m; $k++) {
            if ($c_index != $k) {
                $c_index = $k;
                $C[$k] = [];
            }
            for ($l = 1; $l <= $m; $l++) {
                if ($k != $l && count($c[$k][$l])) {
                    foreach ($c[$k][$l] as $j) {
                        $C[$k][$l] = (isset($C[$k][$l]) ? $C[$k][$l] : 0) + $kriteria[$j - 1]->bobot;
                    }
                }
            }
        }

        return $C;
    }

    public function findDiscordanceMatrix($matrixV, $d, $m, $n)
    {
        $d_index = '';
        for ($k = 1; $k <= $m; $k++) {
            if ($d_index != $k) {
                $d_index = $k;
                $D[$k] = [];
            }
            for ($l = 1; $l <= $m; $l++) {
                if ($k != $l) {
                    $max_d = 0;
                    $max_j = 0;
                    if (count($d[$k][$l])) {
                        foreach ($d[$k][$l] as $j) {
                            if ($max_d < abs($matrixV[$k][$j] - $matrixV[$l][$j]))
                                $max_d = abs($matrixV[$k][$j] - $matrixV[$l][$j]);
                        }
                    }

                    for ($j = 1; $j <= $n; $j++) {
                        if ($max_j < abs($matrixV[$k][$j] - $matrixV[$l][$j]))
                            $max_j = abs($matrixV[$k][$j] - $matrixV[$l][$j]);
                    }
                    $D[$k][$l] = round($max_d / $max_j, 3);
                }
            }
        }

        return $D;
    }

    public function findThresholdC($C, $m)
    {
        $sigma_c = 0;
        foreach ($C as $cl) {
            foreach ($cl as $value) {
                $sigma_c += $value;
            }
        }
        return $sigma_c / ($m * ($m - 1));
    }

    public function findThresholdD($D, $m)
    {
        $sigma_d = 0;
        foreach ($D as $dl) {
            foreach ($dl as $value) {
                $sigma_d += $value;
            }
        }
        return $sigma_d / ($m * ($m - 1));
    }

    public function findConcordanceDominance($C, $threshold_c)
    {
        foreach ($C as $k => $cl) {
            $F[$k] = [];
            foreach ($cl as $l => $value) {
                $F[$k][$l] = ($value >= $threshold_c ? 1 : 0);
            }
        }

        return $F;
    }

    public function findDiscordanceDominance($D, $threshold_d)
    {
        foreach ($D as $k => $dl) {
            $G[$k] = [];
            foreach ($dl as $l => $value) {
                $G[$k][$l] = ($value >= $threshold_d ? 1 : 0);
            }
        }

        return $G;
    }

    public function findAggregateDominance($F, $G)
    {
        foreach ($F as $k => $sl) {
            $E[$k] = [];
            foreach ($sl as $l => $value) {
                $E[$k][$l] = $F[$k][$l] * $G[$k][$l];
            }
        }

        return $E;
    }
}
