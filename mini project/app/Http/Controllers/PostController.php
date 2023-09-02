<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{

    public function create(Request $request)
    {
        $gambar = $request->file('gambar');
        $result = CloudinaryStorage::upload($gambar->getRealPath(),$gambar->getClientOriginalName());

        $request -> validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);

        $data = Post::create([
            "user_id" => $request->user()->id,
            "judul" => $request->judul,
            "deskripsi" => $request->deskripsi,
            "gambar" => $result,
            "category_id" => $request->category_id,
        ]);

        return response()->json(
            ['message' => 'Create Success',
                    "Data" => $data,
                    ],200);
    }

    public function dashboard()
    {
        // $data = Post::with('user:username')->get();
        $data = Post::all();
        return response()->json(["message"=>"tampilkan semua",
                                        "data"=>$data,

                                        ],200);
    }

    public function postCount()
    {
        $postCount = Post::count();
        return response()->json([
            'Jumlah Semua Postingan' => $postCount
        ],200);
    }

    public function profile(Request $request)
    {
        // $data = Post::where('user_id', Auth()->user()->id)->get();

        $user = $request -> user();
        $data = Post::where('user_id',$user->id)->get();
        $user = auth()->user();

        return response()->json([
            'message'=>'tampilkan postingan user',
            'Data'=>$data,
            ],200);
    }

    public function detailUser(Request $request)
    {
        $user = $request -> user();
        $data = Post::where('user_id',$user->id)->get()->count();
        $user = auth()->user();

        return response()->json([
            'Jumlah Post'=>$data,
            'User'=>$user],200);
    }

    public function detailPost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Postingan tidak ditemukan'], 404);
        }

        return response()->json([$post]);
    }

    public function edit(Request $request,$id)
    {
        $gambar = $request->file('gambar');
        $data = Post::find($id);
        $data_gambar = $data->gambar;

        $result = CloudinaryStorage::replace
        ($data_gambar,$gambar->getRealPath(),$gambar->getClientOriginalName());

        $data->update([
            "judul" => $request->judul,
            "deskripsi" => $request->deskripsi,
            "gambar" => $result
        ]);
        // $data->update($request->except('token'));

        return response()->json(['message'=>'postingan berhasil di-edit',
                                        'Data'=>$data],200);
    }

    public function delete($id)
    {
        $data = Post::find($id);
        CloudinaryStorage::delete($data->gambar);
        $data->delete();
        // $data = Post::destroy($id);
        return response()->json(['message'=>'Postingan berhasil dihapus'],200);
    }

}
