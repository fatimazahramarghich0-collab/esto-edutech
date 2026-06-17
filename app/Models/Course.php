<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['subject_id', 'name', 'fichier'];

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function tds()
    {
        return $this->hasMany(Td::class);
    }

    // Définir la relation avec Tps
    public function tps()
    {
        return $this->hasMany(Tp::class);
    }

    function subject(): BelongsTo {
        return $this->belongsTo(Subject::class);
    }
}
