<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;
    protected $table= 'exams';

    protected $guarded = [];

    protected $primaryKey='id';

    protected $fillable = ['subject_id', 'dateExam', 'type'];

    function ExamGrade(): HasMany {
        return $this->hasMany(ExamGrade::class);
    }
    function subject(): BelongsTo {
        return $this->belongsTo(Subject::class);
    }


}
