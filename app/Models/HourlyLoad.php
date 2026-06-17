<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Subject;
use App\Models\Teacher;

class HourlyLoad extends Model
{
    use HasFactory;

    protected $table = 'hourly_loads';

    protected $guarded = [];

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo {
        return $this->belongsTo(Subject::class);
    }
}
