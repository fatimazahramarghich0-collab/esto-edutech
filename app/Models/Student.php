<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $table = 'students';

    protected $guarded = ['remember_token'];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    use Notifiable;

    // Définir la relation avec Sector
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    function moduleGrade(): HasMany {
        return $this->hasMany(ModuleGrade::class);
    }

    function semestreGrade(): HasMany {
        return $this->hasMany(SemesterGrade::class);
    }

    function examGrade(): HasMany {
        return $this->hasMany(ExamGrade::class);
    }

    function absence(): HasMany {
        return $this->hasMany(Absence::class);
    }

    function subjectGrade(): HasMany {
        return $this->hasMany(SubjectGrade::class);
    }
    

}
