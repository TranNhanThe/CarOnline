<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $table = 'cat';

    protected $fillable = ['cat_name'];

    public function images()
    {
        return $this->hasMany(CatImage::class, 'cat_id');
    }
}
