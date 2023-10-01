<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteRental extends Model
{
    use HasFactory;
    protected $fillable = ['id_frentalcar', 'id_fuser'];
    protected $table = 'favorite_rental';
}
