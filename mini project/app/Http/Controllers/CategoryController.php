<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller

{
    public function categories()
    {
        $category = Category::all();
        return response()->json(['Category Postingan'=>$category],200);
    }

    public function create(Request $request)
    {
        $gambar = $request->file('gambar');
        $result = CloudinaryStorage2::upload($gambar->getRealPath(),$gambar->getClientOriginalName());

        $request -> validate([
            'name'=>'required',
            'gambar'=>'required'
        ]);

        $category = Category::create([
           'name'=>$request->name,
           'gambar'=>$result
        ]);

        return response()->json(['message'=>'Category baru berhasil ditambahkan',
                                        'Category'=> $category],200);
    }

    public function ShowCategory($id)
    {
        $category = Category::find($id);
        // $category = $request->category();
        $data = Post::where('category_id',$category->id)->get();

        return response()->json(['message' => 'Category',
                                        'name' => $category->name,
                                        'Data' => $data],200);
    }

    public function jumlahCategory()
    {
        $categoryCount = Category::count();
        return response()->json([
            'Jumlah Category' => $categoryCount,
            ],200);
    }

    public function DelCategory($id)
    {
        $data = Category::find($id);
        $data->delete();

        return response()->json(['message'=>'data berhasil dihapus'],200);
    }


}
