<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Td extends Model
{
    use HasFactory;

   protected $table= "tds";

   protected $guarded = [];

   protected $primaryKey='id';

   function coures(): BelongsTo {
       return $this->belongsTo(Course::class);
   }


}
