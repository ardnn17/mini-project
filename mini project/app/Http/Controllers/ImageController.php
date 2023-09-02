<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CloudinaryStorage;

use function PHPUnit\Framework\returnSelf;

// class ImageController extends Controller
// {

//     public function index_image()
//     {
//         $data = Image::all();
//         return response()->json(['Data semua gambar'=>$data],200);
//     }

//     public function upload_image(Request $request)
//     {
//         $gambar = $request->file('gambar');
//         $result = CloudinaryStorage::upload($gambar->getRealPath(),$gambar->getClientOriginalName());
//         $end = Image::create ([
//             "gambar" => $result
//         ]);
//         return response()->json(['messaage'=>'gambar berhasil di upload',
//                                         'Data'=>$end],200);
//     }

//     public function update_image(Request $request,$id)
//     {
//         $gambar = $request->file('gambar');
//         $data = Image::find($id);
//         $data_gambar = $data->gambar;

//         $result = CloudinaryStorage::replace
//         ($data_gambar,$gambar->getRealPath(),$gambar->getClientOriginalName());

//         $data->update(['gambar'=>$result]);
//         return response()->json(['message'=>'gambar berhasil diubah',
//                                         'Gambar'=> $result],200);
//     }

    // public function delete_image($id)
    // {
    //     $gambar = Image::find($id);
    //     CloudinaryStorage::delete($gambar->gambar); 
    //     $gambar->delete;

    //     return response()->json(['message'=>'Gambar berhasil dihapus',
    //                                     'Gambar'=>$gambar],200);
    // }
// }
