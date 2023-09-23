<?php

namespace App\Http\Controllers;
use App\Models\Cat;
use App\Models\CatImage;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function create()
{
    return view('clients.cats.create');
}

public function store(Request $request)
{
    // Tạo một bản ghi mèo
    $cat = new Cat();
    $cat->cat_name = $request->input('cat_name');
    $cat->save();

    $firstImage = true;

    // Xử lý và lưu hình ảnh liên quan đến mèo
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
        $imagePath = $image->store('cat_image', 'public');

        $catImage = new CatImage();
        $catImage->link = $imagePath;
        $catImage->cat_id = $cat->id; // Gán giá trị khóa ngoại


        if ($firstImage) {
            $catImage->is_main = true;
            $firstImage = false; // Đánh dấu rằng đã tìm thấy ảnh đầu tiên
        }

        $catImage->save();
         }
    }

    // return redirect('cat/catadd.blade.php')->with('success', 'Cat created successfully');

    // return redirect()->route('cat.create')->with('msg', 'Thêm người dùng thành công');
    return redirect('/create')->with('success', 'Cat created successfully');
}
}
