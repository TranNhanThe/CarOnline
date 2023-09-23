<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatImage extends Model
{
    use HasFactory;
    protected $table = 'cat_image'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = ['link']; // Các trường có thể gán

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id');
    }
}
