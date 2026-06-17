<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\HourlyLoad;
use App\Models\Subject;


class Teacher extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'teachers';

    protected $guarded = ['remember_token'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function hourlyLoads()
    {
        return $this->hasMany(HourlyLoad::class, 'teacher_id');
    }
   
}
