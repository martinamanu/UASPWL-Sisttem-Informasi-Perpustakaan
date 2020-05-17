<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'ApiController@index')->name("api");
Route::get('/{id}', 'ApiController@lihat_buku')->name("lihat_buku_api");
Route::post('/auth/login', 'ApiController@auth_login_api')->name("auth_login_api");
Route::post('/auth/user', 'ApiController@auth_user_api')->name("auth_user_api");
Route::get('/auth/userall', 'ApiController@auth_userall_api')->name("auth_userall_api");
Route::get('/auth/userid/{id}', 'ApiController@auth_userid_api')->name("auth_userid_api");
Route::post('/auth/level', 'ApiController@auth_level_api')->name("auth_level_api");
Route::get('/auth/levelall', 'ApiController@auth_levelall_api')->name("auth_levelall_api");
// Route::get('/api/user/', 'ApiController@user_all')->name("user_all_api");
Route::post('/edit/{id}', 'ApiController@update_buku_api')->name("update_buku_api");
Route::post('/delete/{id}', 'ApiController@delete_buku_api')->name("delete_buku_api");
Route::post('/tambah', 'ApiController@tambah_buku_api')->name("tambah_buku_api");
Route::get('/user_all', 'ApiController@user_all')->name("user_all_api");

Route::middleware('auth:api')->group(function () {
    // Route::get('/api/user/', function (Request $request) {
    //     return $request->user();
    // })->name("user_all_api");
});
Route::post('/user/add/', function (Request $request) {
    $user = new User();
    $api = new ApiController();
    // return response()->json($request->user()->api_token);

    abort_if(empty($request->name), 404);
    abort_if(empty($request->email), 404);
    abort_if(empty($request->password), 404);
    abort_if(empty($request->level), 404);
    // $token = $request->user()->api_token;
    // $priv = $api->can_i($token, "can_add_user");
    // return response()->json($request->all());
    // // return response()->json([$priv]);
    // if (!$priv) {
    //     return response()->json([
    //         "status" => 404,
    //         "errors" => "Not Authorized User"
    //     ]);
    // }
    // abort_unless($this->can_i($request->user()->api_token, "can_see_user"), 404);
    $datajson = [
        "name" => $request->name,
        "email" => $request->email,
        "password" => Hash::make($request->password),
        "level_id" => $request->level,
        "api_token" => Str::random(32)
    ];
    // return response()->json([$datajson]);

    $user = User::create($datajson);
    // $user->update($datajson);
    $data = [
        "status" => 200,
        "data" => $user
    ];
    return response()->json($data);
    // return $request->user();
});
Route::post('/admin/edit/{id}', function (Request $request, $id) {
    $user = new User();
    $api = new ApiController();
    // abort_if(empty($request->name), 404);
    // abort_if(empty($request->email), 404);
    // abort_if(empty($request->password), 404);
    // abort_if(empty($request->level), 404);
    // return response()->json($request->user()->api_token);

    // abort_unless($api->can_i($request->user()->api_token, "can_see_user"), 404);
    // $token = $request->user()->api_token;
    // $priv = $api->can_i($token);
    // dd($priv);
    // return response()->json($priv);
    // return response()->json([$priv]);
    // if (!$priv) {
    //     return response()->json([
    //         "status" => 404,
    //         "errors" => "Not Authorized User"
    //     ]);
    // }
    // abort_unless($this->can_i($request->user()->api_token, "can_see_user"), 404);
    if (!empty($request->password) && $request->password != null) {
        $datajson = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "level_id" => $request->level
        ];
    } else {
        $datajson = [
            "name" => $request->name,
            "email" => $request->email,
            // "password" => Hash::make($request->password),
            "level_id" => $request->level
        ];
    }
    $user = User::findOrFail($id);
    $user->update($datajson);
    $data = [
        "status" => 200,
        "data" => $user
    ];
    return response()->json($data);
    // return $request->user();
});
Route::get('/user/delete/{id}', function (Request $request, $id) {
    $user = new User();
    $api = new ApiController();
    // return response()->json($request->user()->api_token);

    // abort_unless($api->can_i($request->user()->api_token, "can_see_user"), 404);
    // $token = $request->user()->api_token;
    // $priv = $api->can_i($token, "can_delete_user");
    // // return response()->json($priv);
    // // return response()->json([$priv]);
    // if (!$priv) {
    //     return response()->json([
    //         "status" => 404,
    //         "errors" => "Not Authorized User"
    //     ]);
    // }
    // abort_unless($this->can_i($request->user()->api_token, "can_see_user"), 404);
    $user = User::find($id);
    $user->delete();
    $data = [
        "status" => 200,
        "data" => "success"
    ];
    return response()->json($data);
    // return $request->user();
});
Route::middleware('auth:api')->get('/user/{id}', function (Request $request, $id) {
    $user = new User();
    $api = new ApiController();
    // return response()->json($request->user()->api_token);

    // abort_unless($api->can_i($request->user()->api_token, "can_see_user"), 404);
    // $token = $request->user()->api_token;
    // $priv = $api->can_i($token, "can_see_user");
    // // return response()->json($priv);
    // // return response()->json([$priv]);
    // if (!$priv) {
    //     return response()->json([
    //         "status" => 404,
    //         "errors" => "Not Authorized User"
    //     ]);
    // }
    // abort_unless($this->can_i($request->user()->api_token, "can_see_user"), 404);
    $user = User::findOrFail($id);
    $data = [
        "status" => 200,
        "data" => $user
    ];
    return response()->json($data);
    // return $request->user();
});
// Route::get("/userall", function (Request $request) {
//     $user = new User();
//     $api = new ApiController();
//     return response()->json(["asdasdsad"]);
//     $user = User::findAll();
//     $data = [
//         "status" => 200,
//         "data" => $user
//     ];
//     return response()->json($data);
//     // return $request->user();
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
