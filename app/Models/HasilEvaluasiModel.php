<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilEvaluasiModel extends Model
{
    use HasFactory;
    protected $table = 'hasil_evaluasi';
    protected $primaryKey = ['id_alternatif', 'id_kriteria'];
    public $incrementing = false;
    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'value',
    ];
}
