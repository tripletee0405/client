<?php
session_start();
use Illuminate\Http\Request;
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

Route::get('/playgame', function(){
    return view('playgame');
})->name('playgame');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('scores', 'ScoreController');

Route::get('auth/passport', function () {
     $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://localhost:8888/callback',
        'response_type' => 'code',
        'scope' => ''
      ]);

     return redirect('http://localhost:8000/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost:8000/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '3',
            'client_secret' => '5GEHbAgWn9MEZIcy774Cr6hM1Bqp5pfpukQE32Co',
            'redirect_uri' => 'http://localhost:8888/callback',
            'code' => $request->code
        ],
    ]);

    $body = json_decode((string) $response->getBody(), true);

    $response = $http->get('http://localhost:8000/api/user', [
      'headers' => [
            'Authorization' => 'Bearer ' . $body['access_token'],
        ],
    ]);

    $body2 = json_decode((string) $response->getBody(), true);

    $name = $body2['name'];
    $img = $body2['id'];

    $_SESSION['playerName'] = $name;

    // return $name;
    return redirect()->route('playgame', ['name'=>$name]);
    // $minutes = 30;
    // $name_cookie = cookie('name', $name, $minutes);
    // $img_cookie = cookie('img', $img, $minutes);

    // $data = ['success'=>'Login Successfully!'];

    // return redirect('');
    
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
