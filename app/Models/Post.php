<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    //quy ước tên table
    /*
        Tên Model: Post => table: posts 
        Tên Model: ProductCategory: product_categories   
    */

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $timestamps = true;

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at'; 

    // public $incrementing = false;

    // protected $keyType = 'string';

    protected $fillable = ['title', 'content', 'status']; 
}