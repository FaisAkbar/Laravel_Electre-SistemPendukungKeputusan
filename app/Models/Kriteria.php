<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kriteria extends Model
{
    use HasFactory;

    public function alternatifs(): BelongsToMany {
        return $this->belongsToMany(Alternatif::class, 'evaluasi_elektre');
    }
}
