<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alternatif extends Model
{
    use HasFactory;

    public function kriterias(): BelongsToMany {
        return $this->belongsToMany(Kriteria::class, 'evaluasi_elektre');
    }
}
