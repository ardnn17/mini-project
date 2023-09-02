<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Carbon\CarbonTimeZone;
class AuthController extends Controller

{
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'number_phone' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed',
            'tanggal_lahir' => 'required|date'
        ]);

        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;

        return response()->json([ 'user' => $user, 'token' => $token],200);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->json(['user' => auth()->user(), 'token' => $token],200);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(["status" => "Logged Out"],200);
    }

    public function admin()
    {
        return response()->json(["message"=>"abang adalah admin, wellcome"],200);
    }

    public function jumlahUser()
    {
        $userCount = User::count();
        return response()->json([
            'Jumlah Pengguna' => $userCount,
            ],200);
    }

    public function allUser()
    {
        $data = User::all();
        return response()->json([
            'semua data user' => $data],200);
    }

    public function editUsername(Request $request)
    {
        $user = $request->user();

        $user->update([
            "username" => $request->username
        ]);

        return response()->json([
            'message'=>'username berhasil diubah',
            $user]);
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        // $data = Post::destroy($id);
        return response()->json(['message'=>'Akun ini berhasil dihapus'],200);
    }
}
