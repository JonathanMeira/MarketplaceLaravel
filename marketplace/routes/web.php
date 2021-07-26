<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/models',function(){
    
/*
    Using Active Records:

    $user = new \App\User();
    $user -> name = 'UserTest';
    $user -> email ='userTestEmail@gmail.com';
    $user -> password = bcrypt('12345678');

    $user -> save();

    return \App\User::all();
*/

/*
    Using Mass Assignment:

    $user = \App\User::create([
            'name' => 'UserTest2',
            'email' => 'userTest2Email@gmail.com',
            'password' => bcrypt('12345678')
        ]);

    dd($user);
*/
   
/*
    Using Mass Update:

    $user = \App\User::find(1); 
    $user -> update([
             'name' => '*New Name*'
        ]);

    dd($user);

*/

    return \App\User::all();


});