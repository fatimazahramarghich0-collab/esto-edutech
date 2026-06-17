<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semesters';

    protected $primaryKey='id';

    protected $guarded = [];

    function sector() : BelongsTo {
        return $this->belongsTo(Sector::class);
    }

    // Dans le modèle Semester
    // Dans votre modèle Semester
    // Dans le modèle Semester, définissez la relation avec les modules
    public function modules()
    {
        return $this->hasMany(Module::class);
    }




    function semesterGrade(): HasMany {
        return $this->hasMany(SemesterGrade::class);
    }


}
