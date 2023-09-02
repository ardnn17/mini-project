<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CloudinaryStorage2;

class ProfileController extends Controller
{
    /**
    * menambahkan data foto profil user,
    * mengedit username dan foto profile,
    * menghapus foto profile
    */
    public function addPhoto(Request $request)
    {
        $user = $request->user();
        $gambar = $request->file('gambar');
        $userr = $user->gambar;

        $result = CloudinaryStorage2::replace
                ($userr,$gambar->getRealPath(),$gambar->getClientOriginalName());

        $user->update([
            "gambar" => $result
        ]);
        return response()->json(
            ['Gambar' => $user, 'message' => 'Gambar berhasil diubah']);
    }

    public function deletePhoto(Request $request)
    {
        $user = $request->user();

        CloudinaryStorage2::delete($user->gambar);

        $user->update([
            "gambar" => "https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg"
        ]);

        return response()->json([
            'message'=>'foto profile berhasil dihapus'
        ],200);
    }
}
