<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku")->json();
        $datauser = json_decode($this->getUserInfo($request));
        // abort_if(!Auth::user()->level->can_see_book, 404);
        // $bukus = Buku::get();
        // dd($bukus);
        return view('home');
    }
    public function tambah_buku_dari_ci(Request $request)
    {
        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku")->json();
        $datauser = $this->getUserInfo($request);
        // $bukus = json_decode(json_encode($data), true);
        // print_r(json_decode(json_encode($bukus), true));
        // dd($data);
        return view('tambah_buku_dari_ci', ["bukus" => $data, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function simpan_buku_dari_ci_satu(Request $request)
    {
        $validate = $request->validate([
            "nama_buku" => "required|max:255",
            "penulis" => "required",
            "penerbit" => "required",
            "jumlah" => "required|numeric"
        ], [
            "nama_buku.required" => "Nama Buku harus dicantumkan!",
            "penulis.required" => "Nama Penulis harus dicantumkan!",
            "penerbit.required" => "Nama Penerbit harus dicantumkan!",
            "jumlah.required" => "Jumlah harus dicantumkan!",
            "jumlah.numeric" => "Jumlah Buku harus berisi angka saja!"
        ]);
        // dd($request->all());
        $datajson = [
            "nama_buku" => $request->nama_buku,
            "penulis" => $request->penulis,
            "penerbit" => $request->penerbit,
            "jumlah" => $request->jumlah,
        ];
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        // $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/buku/add", $datajson);
        // dd($data);
        return redirect()->route("dari_ci");
    }
    public function lihat_buku_dari_ci(Request $request)
    {
        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku")->json();
        $datauser = $this->getUserInfo($request);
        // $bukus = json_decode(json_encode($data), true);
        // print_r(json_decode(json_encode($bukus), true));
        // dd($data);
        return view('lihat_buku_dari_ci', ["bukus" => $data, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function lihat_buku_dari_ci_satu(Request $request, $id)
    {
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        // dd($data);
        return view("lihat_buku_dari_ci_satu", ["data" => $data, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function edit_buku_dari_ci_satu(Request $request, $id)
    {
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        // dd($data);
        return view("edit_buku_dari_ci", ["data" => $data, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function update_buku_dari_ci_satu(Request $request, $id)
    {
        $validate = $request->validate([
            "nama_buku" => "required|max:255",
            "penulis" => "required",
            "penerbit" => "required",
            "jumlah" => "required|numeric"
        ], [
            "nama_buku.required" => "Nama Buku harus dicantumkan!",
            "penulis.required" => "Nama Penulis harus dicantumkan!",
            "penerbit.required" => "Nama Penerbit harus dicantumkan!",
            "jumlah.required" => "Jumlah harus dicantumkan!",
            "jumlah.numeric" => "Jumlah Buku harus berisi angka saja!"
        ]);
        // dd($request->all());
        $datajson = [
            "nama_buku" => $request->nama_buku,
            "penulis" => $request->penulis,
            "penerbit" => $request->penerbit,
            "jumlah" => $request->jumlah,
        ];
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        // $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/buku/edit/" . $id, $datajson);
        // dd($data);
        return redirect()->route("dari_ci");
    }
    public function hapus_buku_dari_ci_satu(Request $request, $id)
    {
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        // dd($data);
        return view("hapus_buku_dari_ci", ["data" => $data, "hasapi" => $hasapi, "datauser" => $datauser]);
    }
    public function delete_buku_dari_ci_satu(Request $request, $id)
    {
        $datajson = [];
        $datauser = $this->getUserInfo($request);

        $hasapi = $request->session()->has("api_token");
        // $data = Http::get(env("CODEIGNITER_ADDRESS") . "/buku/" . $id)->json();
        $data = $this->ambil_post(env("CODEIGNITER_ADDRESS") . "/buku/delete/" . $id, $datajson);
        // dd($data);
        return redirect()->route("dari_ci");
    }
    public function lihat_buku($id)
    {
        abort_if(!Auth::user()->level->can_see_book, 404);

        $data = Buku::findOrFail($id);
        return view("lihat_buku", ["data" => $data]);
    }
    public function edit_buku($id)
    {
        abort_if(!Auth::user()->level->can_edit_book, 404);
        // abort_if(!Auth::user()->level->can_edit_book && Auth::guest(), 404);

        $data = Buku::findOrFail($id);
        return view("edit_buku", ["data" => $data]);
    }
    public function hapus_buku($id)
    {
        abort_if(!Auth::user()->level->can_delete_book, 404);
        $data = Buku::findOrFail($id);
        return view("hapus_buku", ["data" => $data]);
    }
    public function delete_buku($id)
    {
        abort_if(!Auth::user()->level->can_delete_book, 404);

        $data = Buku::findOrFail($id);
        $data->delete();
        return response()->redirectToRoute("home");
    }
    public function tambah_buku()
    {
        abort_if(!Auth::user()->level->can_add_book, 404);
        return view("tambah_buku");
    }
    public function update_buku(Request $request, $id)
    {
        abort_if(!Auth::user()->level->can_edit_book, 404);

        $validate = $request->validate([
            "nama_buku" => "required|max:255",
            "penerbit" => "required",
            "penulis" => "required",
            "jumlah" => "required|numeric"
        ], [
            "nama_buku.required" => "Nama Buku harus dicantumkan!",
            "penerbit.required" => "Nama Penerbit harus dicantumkan!",
            "penulis.required" => "Nama Penulis harus dicantumkan!",
            "jumlah.required" => "Jumlah harus dicantumkan!",
            "jumlah.numeric" => "Jumlah Buku harus berisi angka saja!"
        ]);
        $buku = Buku::findOrFail($id);
        $buku->nama_buku = $request->nama_buku;
        $buku->penerbit = $request->penerbit;
        $buku->penulis = $request->penulis;
        $buku->jumlah = $request->jumlah;
        $buku->save();
        return response()->redirectToRoute("home");
        // dd($request->nama_buku);
    }
    public function simpan_buku(Request $request)
    {
        abort_if(!Auth::user()->level->can_add_book, 404);
        $validate = $request->validate([
            "nama_buku" => "required|max:255",
            "penulis" => "required",
            "penerbit" => "required",
            "jumlah" => "required|numeric"
        ], [
            "nama_buku.required" => "Nama Buku harus dicantumkan!",
            "penulis.required" => "Nama Penulis harus dicantumkan!",
            "penerbit.required" => "Nama Penerbit harus dicantumkan!",
            "jumlah.required" => "Jumlah harus dicantumkan!",
            "jumlah.numeric" => "Jumlah Buku harus berisi angka saja!"
        ]);
        $buku = new Buku();
        $buku->nama_buku = $request->nama_buku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->jumlah = $request->jumlah;
        $buku->save();
        return response()->redirectToRoute("home");
        // dd($request->nama_buku);
    }



    /// UNTUK API

}
