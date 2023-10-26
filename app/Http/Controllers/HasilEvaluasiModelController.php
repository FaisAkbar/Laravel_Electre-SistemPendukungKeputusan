<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\HasilEvaluasiModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class HasilEvaluasiModelController extends Controller
{
    function index() {
        return view('electre');
    }

    public function getAlternatives()
    {
        $alternatif = AlternatifModel::all();

        return response()->json(['alternatif' => $alternatif]);
    }

    public function getCriterias()
    {
        $kriteria = KriteriaModel::all();

        return response()->json(['kriteria' => $kriteria]);
    }

    public function result()
    {
        $n = KriteriaModel::count();

        $evaluasi = HasilEvaluasiModel::orderBy('id_alternatif')
            ->orderBy('id_kriteria')
            ->get();

        $X = [];
        $alternatif = '';
        $m = 0;

        foreach ($evaluasi as $evaluasi) {
            if ($evaluasi->id_alternatif != $alternatif) {
                $X[$evaluasi->id_alternatif] = [];
                $alternatif = $evaluasi->id_alternatif;
                $m++;
            }
            $X[$evaluasi->id_alternatif][$evaluasi->id_kriteria] = $evaluasi->value;
        }

        $x_rata = [];

        foreach ($X as $i => $x) {
            foreach ($x as $j => $value) {
                $x_rata[$j] = (isset($x_rata[$j]) ? $x_rata[$j] : 0) + pow($value, 2);
            }
        }

        for ($j = 1; $j <= $n; $j++) {
            $x_rata[$j] = sqrt($x_rata[$j]);
        }

        $R = [];
        $alternatif = '';

        foreach ($X as $i => $x) {
            if ($alternatif != $i) {
                $alternatif = $i;
                $R[$i] = [];
            }
            foreach ($x as $j => $value) {
                $R[$i][$j] = $value / $x_rata[$j];
            }
        }

        $kriteria = KriteriaModel::orderBy('id_kriteria')
            ->pluck('bobot', 'id_kriteria')
            ->toArray();

        $V = [];

        foreach ($R as $i => $r) {
            $V[$i] = [];

            foreach ($r as $j => $value) {
                $V[$i][$j] = $kriteria[$j] * $value;
            }
        }

        $c = [];
        $d = [];

        for ($k = 1; $k <= $m; $k++) {
            $c[$k] = [];
            $d[$k] = [];

            for ($l = 1; $l <= $m; $l++) {
                if ($k !== $l) {
                    $c[$k][$l] = [];
                    $d[$k][$l] = [];

                    for ($j = 1; $j <= $n; $j++) {
                        if ($V[$k][$j] >= $V[$l][$j]) {
                            array_push($c[$k][$l], $j);
                        } else {
                            array_push($d[$k][$l], $j);
                        }
                    }
                } else {
                    $c[$k][$l] = ['-'];
                    $d[$k][$l] = ['-'];
                }
            }
        }

        $sigma_c = 0;
        $sigma_d = 0;

        foreach ($c as $cl) {
            foreach ($cl as $l => $value) {
                foreach ($kriteria as $j => $bobot) {
                    if (in_array($j, $value)) {
                        $sigma_c += $bobot;
                    }
                }
            }
        }

        for ($k = 1; $k <= $m; $k++) {
            for ($l = 1; $l <= $m; $l++) {
                if ($k !== $l) {
                    $max_d = 0;
                    $max_j = 0;

                    if (count($d[$k][$l])) {
                        for ($j = 0; $j < count($d[$k][$l]); $j++) {
                            $current_j = $d[$k][$l][$j];
                            $difference = abs($V[$k][$current_j] - $V[$l][$current_j]);

                            if ($max_d < $difference) {
                                $max_d = $difference;
                            }
                        }
                    }

                    for ($j = 1; $j <= $n; $j++) {
                        $difference = abs($V[$k][$j] - $V[$l][$j]);

                        if ($max_j < $difference) {
                            $max_j = $difference;
                        }
                    }

                    $D[$k][$l] = $max_d / $max_j;
                    $sigma_d += $D[$k][$l];
                }
            }
        }

        $threshold_c = $sigma_c / ($m * ($m - 1));
        $threshold_d = $sigma_d / ($m * ($m - 1));

        $F = [];
        $G = [];

        foreach ($c as $k => $cl) {
            $F[$k] = [];

            foreach ($cl as $l => $value) {
                if (in_array('-', $value)) {
                    $F[$k][$l] = '-';
                } else {
                    $total = 0;
                    foreach ($kriteria as $j => $bobot) {
                        if (in_array($j, $value)) {
                            $total += $bobot;
                        }
                    }

                    $F[$k][$l] = ($total >= $threshold_c) ? 1 : 0;
                }
            }
        }

        for ($k = 1; $k <= $m; $k++) {
            for ($l = 1; $l <= $m; $l++) {
                if ($k !== $l) {
                    $max_d = 0;
                    $max_j = 0;
                    $total = 0; // Reset total setiap kali ganti baris atau kolom

                    if (count($d[$k][$l])) {
                        for ($j = 0; $j < count($d[$k][$l]); $j++) {
                            $current_j = $d[$k][$l][$j];
                            $difference = abs($V[$k][$current_j] - $V[$l][$current_j]);

                            if ($max_d < $difference) {
                                $max_d = $difference;
                            }
                        }
                    }

                    for ($j = 1; $j <= $n; $j++) {
                        $difference = abs($V[$k][$j] - $V[$l][$j]);

                        if ($max_j < $difference) {
                            $max_j = $difference;
                        }
                    }

                    $D[$k][$l] = $max_d / $max_j;
                    $total += $D[$k][$l]; // Akumulasi total

                    // Membandingkan dengan treshold_d dan menambahkan 1 atau 0 ke $G
                    $G[$k][$l] = ($total > $threshold_d) ? 1 : 0;
                } else {
                    $G[$k][$l] = '-';
                }
            }
        }

        $E = [];

        foreach ($F as $k => $sl) {
            $E[$k] = [];

            foreach ($sl as $l => $value) {
                if ($value === '-') {
                    $E[$k][$l] = '-';
                } else {
                    $E[$k][$l] = $F[$k][$l] * $G[$k][$l];
                }
            }
        }


        return response()->json([
            'n' => $n,
            'X' => $X,
            'm' => $m,
            'x_rata' => $x_rata,
            'R' => $R,
            'kriteria' => $kriteria,
            'V' => $V,
            'c' => $c,
            'd' => $d,
            'threshold_c' => $threshold_c,
            'threshold_d' => $threshold_d,
            'F' => $F,
            'G' => $G,
            'E' => $E,
        ]);
    }
}
