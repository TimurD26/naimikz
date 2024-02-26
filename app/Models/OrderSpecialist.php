<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSpecialist extends Model
{
    protected $fillable=['order_id','user_id'];
    use HasFactory;
}
