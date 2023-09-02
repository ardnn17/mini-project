<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AdminPageController extends Controller
{
    // Dashboad Admin
    public function showAll()
    {
        $data = Post::all();
        return response()->json(["Data dari semua user" => $data],200);
    }

    public function deletePost($id)
    {
        $data = Post::find($id);
        CloudinaryStorage::delete($data->gambar);
        $data->delete();
        // $data = Post::destroy($id);
        return response()->json(['message'=>'Postingan user berhasil dihapus',
                                        $data],200);
    }
}
