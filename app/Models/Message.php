<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table='messages';

    protected $fillable = ['surname','name','estLu','message'];

    protected $primaryKey='id';

    protected $casts = [
        'estLu' => 'boolean',
    ];
}
