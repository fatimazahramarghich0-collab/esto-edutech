<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleGrade extends Model
{
    use HasFactory;
    protected $table= 'module_grades';

    protected $primaryKey='id';

    protected $guarded = [];

    function module(): BelongsTo{
        return $this->belongsTo(Module::class);
    }

    function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }
}
