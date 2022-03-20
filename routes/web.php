<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ログインしていない時にアクセスできるアドレス
Route::middleware(['guest'])->group(function () {

    // 新規登録画面表示
    Route::get('/signup', 'App\Http\Controllers\AuthController@showSignup')->name('showSignup');

    // 新規登録処理
    Route::post('/signup/exeSignup', 'App\Http\Controllers\AuthController@exeSignup')->name('exeSignup');

    // ログイン画面表示
    Route::get('/', 'App\Http\Controllers\AuthController@showLogin')->name('showLogin');

    // ログイン処理
    Route::post('/login', 'App\Http\Controllers\AuthController@exeLogin')->name('exeLogin');

});

// ログインしている時にアクセスできるアドレス
Route::middleware(['auth'])->group(function (){
    //ホーム画面表示
    Route::get('home', 'App\Http\Controllers\RecordController@showAll')->name('home'); 
    //年月を指定した場合の画面表示
    Route::post('home', 'App\Http\Controllers\RecordController@showAll')->name('showSelect'); 

    //記録作成画面表示
    Route::get('home/log/{ymd}', 'App\Http\Controllers\RecordController@showLogForm')->name('log'); 

    // 記録登録
    Route::post('home/store', 'App\Http\Controllers\RecordController@exeStore')->name('store');

    //記録内容表示
    Route::get('home/detail/{ymd}', 'App\Http\Controllers\RecordController@showDetail')->name('detail'); 

    // 記録編集画面を表示
    Route::get('home/detail/edit/{id}', 'App\Http\Controllers\RecordController@showEdit')->name('edit');

    // 記録内容更新
    Route::post('home/detail/update', 'App\Http\Controllers\RecordController@exeUpdate')->name('update');

    // 記録を削除
    Route::post('home/detail/delete/{id}', 'App\Http\Controllers\RecordController@exeDelete')->name('delete');
    
    // ログアウト
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});



// ログインに関係なくアクセスできるアドレス
//ヘルプ画面表示
Route::get('/help', function(){
    return view('help');
})->name('showHelp');