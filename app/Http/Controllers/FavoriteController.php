<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteRental;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
{
    $title = 'Danh sách Yêu thích';
    $user = Auth::user();
    $favorites = $user->favorites; // Lấy danh sách các xe yêu thích của người dùng

    return view('clients.rental.rentallist', compact(['favorites' => $favorites], 'title'));
}
    public function toggleFavorite($carId)
{
    $user = Auth::user();
    $favorite = FavoriteRental::where('id_frentalcar', $carId)
        ->where('id_fuser', $user->id)
        ->first();


    if ($favorite) {
        // Nếu đã yêu thích, xóa khỏi danh sách yêu thích
        $favorite->delete();
        return redirect()->back()->with('message', 'Đã xóa khỏi danh sách yêu thích');
    } else {
        // Nếu chưa yêu thích, thêm vào danh sách yêu thích
        FavoriteRental::create([
            'id_frentalcar' => $carId,
            'id_fuser' => $user->id,
        ]);
        return redirect()->back()->with('message', 'Đã thêm vào danh sách yêu thích');
    }
}
}
