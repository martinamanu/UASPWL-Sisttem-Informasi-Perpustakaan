<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Level;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    protected function ambil_post($alamat, $data)
    {
        $client = new Client();
        $res = $client->request('POST', $alamat, [
            'form_params' => $data
        ]);
        if ($res->getStatusCode() == 200) { // 200 OK
            return $res->getBody()->getContents();
        }
    }
    public function login_form(Request $request)
    {
        $hasapi = $request->session()->has("api_token");

        return view("http_auth.login", ["hasapi" => $hasapi]);
    }
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route("awal");
    }
    public function awal(Request $request)
    {
        $data['hasapi'] = $request->session()->has("api_token");
        $hasapi = $request->session()->has("api_token");
        // dd($hasapi);
        if ($hasapi) {
            $datauser = json_decode($this->getUserInfo($request));
            $data['datauser'] = $datauser->data[0];
        } else {
            $data['datauser'] = null;
            $data['hasapi'] = false;
        }
        return view("welcome", $data);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        // dd($request->all());

        $email = $request->email;
        $password = $request->password;

        $data2 = $this->ambil_post("http://localhost:8080/api/auth/login", [
            "email" => $email,
            "password_form" => $password,
        ]);
        $data = json_decode($data2);
        // dd();

        // return $data2;
        // $datauser = $this->getUserInfo($request);

        $request->session()->put("api_token", $data->data->api_token);
        // return $data2;
        return redirect()->route("dari_ci");
    }
    public function getUserInfo(Request $request)
    {
        // dd($request->all());

        $token = $request->session()->get("api_token");

        $data2 = $this->ambil_post("http://localhost:8080/api/auth/user", [
            "token" => $token
        ]);

        // $request->session()->put("api_token", $data2);
        // return $data2;
        // dd($data2);
        return $data2;
    }


    // public function can_i($token)
    // {
    //     // $user = User::where("api_token", $token)->first()->level->toArray();
    //     $user = User::where("api_token", $token)->first();
    //     // return $user[$priv];
    //     return $user;
    // }
    // public function auth_level_api(Request $request)
    // {
    //     abort_unless(!empty($request->token), 404);
    //     $token = $request->token;
    //     $user = User::where("api_token", $token)->first();
    //     if ($user) {
    //         return response()->json($user->level);
    //     } else {
    //         abort(404);
    //     }
    // }
    // public function auth_levelall_api(Request $request)
    // {
    //     // abort_unless(!empty($request->token), 404);
    //     // $token = $request->token;
    //     $user = Level::all();
    //     $array = [];
    //     foreach ($user as $item) {
    //         $arraydump = [
    //             "id" => $item->id,
    //             "nama" => $item->nama
    //         ];
    //         array_push($array, $arraydump);
    //     }
    //     if ($user) {
    //         return response()->json($array);
    //     } else {
    //         abort(404);
    //     }
    // }
    // public function auth_user_api(Request $request)
    // {
    //     abort_unless(!empty($request->token), 404);
    //     $token = $request->token;
    //     $user = User::where("api_token", $token)->first();
    //     if ($user) {
    //         return response()->json($user);
    //     } else {
    //         abort(404);
    //     }
    // }
    // public function auth_userid_api(Request $request, $id)
    // {
    //     abort_unless(!empty($id), 404);
    //     $token = $id;
    //     $user = User::find($id);
    //     if ($user) {
    //         return response()->json($user);
    //     } else {
    //         abort(404);
    //     }
    // }
    // public function auth_userall_api(Request $request)
    // {
    //     // abort_unless(!empty($request->token), 404);
    //     // $token = $request->token;
    //     $user = User::all();
    //     $array = [];
    //     if ($user) {
    //         foreach ($user as $item) {

    //             $arrayitem = [
    //                 "id" => $item->id,
    //                 "name" => $item->name,
    //                 "email" => $item->email,
    //                 "level" => $item->level->nama
    //             ];
    //             array_push($array, $arrayitem);
    //         }
    //         return response()->json($array);
    //     } else {
    //         abort(404);
    //     }
    // }
    // public function auth_login_api(Request $request)
    // {
    //     abort_unless(!empty($request->email), 404);
    //     abort_unless(!empty($request->password), 404);
    //     $email = $request->email;
    //     $password = $request->password;
    //     $user = User::where("email", $email)->first();
    //     if (!$user) {
    //         return response()->json([
    //             "status" => 404,
    //             "errors" => "User tidak ditemukan"
    //         ]);
    //     }
    //     if (password_verify($password, $user->password)) {
    //         $data = [
    //             "status" => 200,
    //             "data" => [
    //                 "api_token" => $user->api_token
    //             ]
    //         ];
    //     } else {
    //         $data = [
    //             "status" => 404,
    //             "errors" => "User tidak ditemukan"
    //         ];
    //     }
    //     return response()->json($data);
    // }
    // public function user_all(Request $request)
    // {
    //     // return response()->json($request->user());
    //     // $priv = $this->can_i($request->user()->api_token, "can_see_user");
    //     // if (!$priv) {
    //     //     return response()->json([
    //     //         "status" => 404,
    //     //         "errors" => "Not Authorized User"
    //     //     ]);
    //     // }
    //     // abort_unless($this->can_i($request->user()->api_token, "can_see_user"), 404);
    //     $user = User::all();
    //     $data = [
    //         "status" => 200,
    //         "data" => $user
    //     ];
    //     return $data;
    // }
    // public function index()
    // {
    //     $data = Buku::all();
    //     return $data;
    // }
    // public function lihat_buku($id)
    // {

    //     $data = Buku::find($id);
    //     return $data;
    // }
    // public function update_buku_api(Request $request, $id)
    // {
    //     // abort_if(!Auth::user()->level->can_edit_book, 404);
    //     $buku = Buku::findOrFail($id);
    //     $buku->nama_buku = $request->nama_buku;
    //     $buku->penerbit = $request->penerbit;
    //     $buku->penulis = $request->penulis;
    //     $buku->jumlah = $request->jumlah;
    //     $buku->save();
    //     return response(["status" => 200, "data" => $buku]);
    //     // return response()->redirectToRoute("home");
    // }
    // public function tambah_buku_api(Request $request)
    // {
    //     // abort_if(!Auth::user()->level->can_edit_book, 404);
    //     $buku = new Buku();
    //     $buku->nama_buku = $request->nama_buku;
    //     $buku->penerbit = $request->penerbit;
    //     $buku->penulis = $request->penulis;
    //     $buku->jumlah = $request->jumlah;
    //     $buku->save();
    //     return response(["status" => 200, "data" => $buku]);
    //     // return response()->redirectToRoute("home");
    // }
    // public function delete_buku_api($id)
    // {
    //     // abort_if(!Auth::user()->level->can_delete_book, 404);

    //     $data = Buku::findOrFail($id);
    //     $data->delete();
    //     return response(["status" => 200, "messages" => "success"]);
    // }
}
