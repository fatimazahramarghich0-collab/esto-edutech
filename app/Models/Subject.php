<?php
namespace App\Models;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\HourlyLoad;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $guarded = [];

    function subjectGrades(): HasMany {
        return $this->hasMany(SubjectGrade::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    function module(): BelongsTo {
        return $this->belongsTo(Module::class);
    }

    public function absence(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function hourlyLoads(): HasMany {
        return $this->hasMany(HourlyLoad::class);
    }
}

