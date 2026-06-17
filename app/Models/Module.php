<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    // Définir les attributs fillables si nécessaire
    protected $fillable = [
        'name',
        // autres attributs...
    ];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function gradeModule(): HasMany
    {
        return $this->hasMany(ModuleGrade::class);
    }
}

