<?php

namespace App\Http\Controllers;

use App\Level;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    protected function ambil_get($alamat)
    {
        $client = new Client();
        $res = $client->request('GET', $alamat);
        if ($res->getStatusCode() == 200) { // 200 OK
            return $res->getBody()->getContents();
        }
    }
    public function getUserInfo(Request $request)
    {
        // dd($request->all());

        $token = $request->session()->get("api_token");
        // dd($token);

        $data2 = $this->ambil_post("http://localhost:8080/api/auth/user", [
            "token" => $token
        ]);
        $data = json_decode($data2);

        // $request->session()->put("api_token", $data2);
        // return $data2;
        // return dd($data2);
        return $data->data[0];
    }
    public function index(Request $request)
    {
        abort_unless($this->getUserInfo($request)->level->can_see_user, 404);
        $user2 = $this->ambil_get(env("CODEIGNITER_ADDRESS") . "/user");
        $user = json_decode($user2);
        $datauser = $this->getUserInfo($request);
        // dd($user->data[0][0]);
        $hasapi = $request->session()->has("api_token");
        return view("user.list_user", ["users" => $user->data[0], "datauser" => $datauser, "hasapi" => $hasapi]);
    }
    // public function lihat_user($id)
    // {
    //     abort_if(!Auth::user()->level->can_see_user, 404);
    //     $data = User::findOrFail($id);
    //     return view("user.lihat_user", ["data" => $data]);
    // }
    public function hapus_user(Request $request, $id)
    {
        abort_unless($this->getUserInfo($request)->level->can_delete_user, 404);
        $user2 = $this->ambil_get(env("CODEIGNITER_ADDRESS") . "/user/" . $id);
        $datauser = $this->getUserInfo($request);
        $user = json_decode($user2);
        $hasapi = $request->session()->has("api_token");
        // dd($user->data[0]);
        return view("user.hapus_user", ["data" => $user->data[0], "datauser" => $datauser, "hasapi" => $hasapi]);
    }
    public function delete_user(Request $request, $id)
    {
        abort_if(!$this->getUserInfo($request)->level->can_delete_user, 404);
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/user/delete/" . $id, []);
        // $data->delete();
        return response()->redirectToRoute("user");
    }
    public function edit_user(Request $request, $id)
    {
        $datauser = $this->getUserInfo($request);
        abort_unless($datauser->level->can_edit_user, 404);
        $user2 = $this->ambil_get(env("CODEIGNITER_ADDRESS") . "/user/" . $id);
        $level2 = $this->ambil_get(env("CODEIGNITER_ADDRESS") . "/level");

        $user = json_decode($user2);
        $leveel = json_decode($level2);
        $level = $leveel->data[0];
        $hasapi = $request->session()->has("api_token");
        // dd($level[0]);
        // $user = User::findOrFail($id);
        // $level = Level::all();
        return view("user.edit_user", ["data" => $user->data[0], "levels" => $level, "datauser" => $datauser, "hasapi" => $hasapi]);
    }
    public function update_user(Request $request, $id)
    {
        // abort_unless(Auth::user()->level->can_edit_edit, 404);
        abort_unless($this->getUserInfo($request)->level->can_edit_user, 404);
        // $user = User::findOrFail($id);
        // dd($request->all());
        $request->validate([
            "nama_user" => "required|max:255|string",
            "email" => "sometimes|required|email|string",
            "level" => "required"
            // "level" => "required"
        ]);
        if ($request->has("password") && $request->password != null) {
            $datajson = [
                "email" => $request->email,
                "password_form" => $request->password,
                "nama" => $request->nama_user,
                "level" => $request->level,

            ];
        } else {
            $datajson = [
                "email" => $request->email,
                // "password_form" => Hash::make($request->password),
                "nama" => $request->nama_user,
                "level" => $request->level,

            ];
        }
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/user/edit/" . $id, $datajson);
        // dd($request->all());
        // $user->name = $request->nama_user;
        // $user->email = $request->email;
        // $user->level_id = $request->level;
        // if (!empty($request->password)) {
        //     $user->password = Hash::make($request->password);
        // }
        // $user->save();
        return response()->redirectToRoute("user");
    }
    public function tambah_user(Request $request)
    {

        abort_if(!$this->getUserInfo($request)->level->can_add_user, 404);
        $datauser = $this->getUserInfo($request);
        $user2 = $this->ambil_get(env("CODEIGNITER_ADDRESS") . "/level");
        $user = json_decode($user2);
        // dd($user->data[0]);
        $hasapi = $request->session()->has("api_token");
        $level = $user->data[0];
        return view("user.add_user", ["levels" => $level, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function add_user(Request $request)
    {
        abort_if(!$this->getUserInfo($request)->level->can_add_user, 404);

        $request->validate([
            "nama_user" => "required|max:255|string",
            "email" => "required|email|string",
            "password" => "required",
            "level" => "required"
            // "level" => "required"
        ]);
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/user/add/", [
            "email" => $request->email,
            "password_form" => $request->password,
            "nama" => $request->nama_user,
            "level" => $request->level,
        ]);
        // dd($data);
        return response()->redirectToRoute("user");
        // $user = new User();
        // // dd($request->all());
        // $user->name = $request->nama_user;
        // $user->email = $request->email;
        // $user->level_id = $request->level;
        // // if (!empty($request->password)) {
        // $user->password = Hash::make($request->password);
        // }
        // $user->save();
        // return response()->redirectToRoute("user");
    }
}
