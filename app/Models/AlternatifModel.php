<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = [
        'id_alternatif',
        'alternatif',
    ];
}
