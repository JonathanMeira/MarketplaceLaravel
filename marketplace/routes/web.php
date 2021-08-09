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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product/{slug}','HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){

    Route::get('/','CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove/{slug}','CartController@remove')->name('remove');
    Route::get('cancel','CartController@cancel')->name('cancel');

});


Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/','CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');

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

/* 
    $user = \App\User::find(1);
    
    return $user -> store; 
    
    If you call this as an string, it will return an unique object,
    but if you call this as an function, it will allow condictional queries

*/

/*  
    Creating one store for one user:

        $user =\App\User::find(1);
        $store = $user ->store()->create([
            'name'=>'Test Store',
            'description'=>'Lorem Ipsum',
            'phone'=>'xx-xxxx-xxxx',
            'mobile_phone'=>'xx-xxxx-xxxx',
            'slug' =>'test-store'
        ]);
*/

/*  
    Creating one product for one store:

        $store =\App\Store::find(1);
        $product = $store ->products()->create([
            'name'=>'Test Product',
            'description'=>'Lorem Ipsum',
            'body'=>'Lorem Ipsum',
            'price'=>28.00,
            'slug' =>'test-product'
        ]);
*/

/*
    Creating one category:

    $category = \App\Category::create([
        'name' => 'Test Category',
        'description' => null,
        'slug' =>'test-category',
    ])
*/


/*
    Setting one product for one category:

    $product = \App\Product::find(1);
    $product-> categories()-> sync([1]);

*/
    return \App\User::all();
});



Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin') ->name('admin.') -> namespace('Admin')-> group(function(){

        /*
          Route::prefix('stores')-> name('stores.')->group(function(){
    
            Route::get('/','StoreController@index')->name('index');
            Route::get('/create','StoreController@create')->name('create');
                Route::post('/store','StoreController@store')->name('store');
            Route::get('/{store}/edit','StoreController@edit')->name('edit');
                Route::post('/update/{store}','StoreController@update')->name('update');
            Route::get('/destroy/{store}','StoreController@destroy')->name('destroy');
        }); 
        */   
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    
    });    
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
