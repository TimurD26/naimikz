<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spec;
use App\Models\Respoce;
use App\Models\Category;

class Order extends Model
{
    protected $fillable=['category_id','user_id','isModerated','text','url_to_photo','sum','tel_number','address','isActive'];

    public function respoces()
    {
        return $this->hasMany(Respoce::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function specs()
    {
        return $this->hasManyThrough(
            Spec::class, 
            Respoce::class, 
            'order_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'spec_id' // Local key on the environments table...
        );

    }
}
