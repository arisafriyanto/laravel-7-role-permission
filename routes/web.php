<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('admin', 'AdminController@index')->middleware('role:admin');
// Route::get('admin', 'AdminController@index')->middleware('permission:delete post');

Route::middleware('role:admin')->group(function () {
    // letakkan routing yang menggunakan middleware yang role nya admin
    Route::get('admin', 'AdminController@index')->middleware('role:admin');
});


/* Details 

Route::get('/', function () {


    ROLE   BERDASARKAN YANG LOGIN/USERS/MODEL

    $user = auth()->user();                     CEK SIAPA YANG LOGIN

    $user->assignRole('admin');                 CREATE ROLE BERDASARKAN YANG LOGIN => table => model_has_roles
    if ($user->hasRole('admin')) {
    return $user->name . " => admin";           CEK USER INI ADMIN ATAU BUKAN
    }
    $user->removeRole('admin');                 REMOVE ROLE ADMIN
    $user->syncRoles(['admin', 'user']);        UPDATE ROLE => syncRoles([ semua yang didalam array ini akan jadi role ])
    dd($user->hasAnyRole(['admin', 'users']));  CEK USERS APAKAH MEMPUNYAI SALAH SATU ROLE DARI ARRAY JIKA IYA true
    dd($user->hasAllRoles(Role::all());         CEK USERS APAKAH MEMPUNYAI SEMUA ROLE JIKA IYA true





    DIRECT PERMISSIONS  BERDASARKAN YANG LOGIN/USERS/MODEL


    $user = auth()->user();                                             CEK SIAPA YANG LOGIN

    $user->givePermissionTo('add post');                                CREATE PERMISSION BERDASARKAN YANG LOGIN => table => model_has_permissions
    $user->givePermissionTo('edit post', 'delete post');                CREATE 2 PERMISSION BERDASARKAN YANG LOGIN => table => model_has_permissions
    $user->syncPermissions(['add post', 'edit post', 'delete post']);   UPDATE PERMISSION BERDASARKAN YANG LOGIN syncPermissions([ semua yang didalam array ini akan jadi permission ]) => table => model_has_permissions
    $user->revokePermissionTo('delete post');                           MENCABUT PERMISSION delete post => table =>  => model_has_permissions
    dd($user->hasPermissionTo('add post'));                             CEK PERMISSION BERDASARKAN YANG LOGIN => table => model_has_permissions
    dd($user->hasAnyPermission(['add post', 'delete post']));           CEK USERS APAKAH MEMPUNYAI SALAH SATU ARRAY JIKA IYA true
    dd($user->hasAllPermissions(['add post', 'edit post']));            CEK USERS APAKAH MEMPUNYAI SEMUA ARRAY JIKA IYA true
    dd($user->can('add post'));                                         CEK USERS APAKAH MEMPUNYAI PERMISSION INI dengan method defualt laravel






    PERMISSIONS VIA ROLES




    $user = auth()->user();

    $roleAdmin = Role::find(1);

    $roleAdmin->givePermissionTo('add post');                                             MEMBUAT 1 PERMISSION BERDASARKAN ROLE => table => role_has_permissions
    $roleAdmin->givePermissionTo('add post', 'edit post', 'delete post');                 MEMBUAT BANYAK PERMISSION BERDASARKAN ROLE => table => role_has_permissions
    $roleAdmin->syncPermissions(['add post', 'edit post', 'delete post', 'view post']);   UPDATE PERMISSION BERDASARKAN ROLE syncPermissions([ semua yang didalam array ini akan jadi permission ]) => table => model_has_permissions
    $roleAdmin->revokePermissionTo('delete post');                                        MENCABUT PERMISSION delete post => table =>  => model_has_permissions
    dd($roleAdmin->hasPermissionTo('add post'));                                          CEK PERMISSION BERDASARKAN ROLE => table => model_has_permissions
    dd($roleAdmin->hasAnyPermission(['add post', 'delete post']));                        CEK ROLE APAKAH MEMPUNYAI SALAH SATU ARRAY JIKA IYA true
    dd($roleAdmin->hasAllPermissions(['add post', 'edit post', 'view post']));            CEK ROLE APAKAH MEMPUNYAI SEMUA ARRAY JIKA IYA true



    JIKA INGIN MENGHAPUS PERMISSION BERDASARKAN LOGIN/USERS/MODEL/ID TIDAK AKAN TERHAPUS KARENA JIKA ROLE ADMIN/USER SUDAH DIDEFINISIKAN DI TABLE => role_has_permissions 
    TETAP AKAN MEMBACA PERMISSION YANG KITA HAPUS BERDASARKAN ID, JADI JIKA INGIN MENGHAPUS PERMISSION BERDASARKAN ID NYA HAPUS JUGA DI table role_has_permissions admin/user. JIKA KITA INGIN ADA FITUR SPECIAL KITA TINGGAL LAKUKAN CARA DI LOGIN ID 2


    dd($user->id);
    $user->givePermissionTo('delete post');
    $roleAdmin->givePermissionTo('delete post');
    dd($user->can('add post'));
    if ($user->hasPermissionTo('delete post')) {    JIKA DI table => model_has_permissions tidak ada delete post di id ini maka tetap akan muncul ada karena kita atur permission di table role_has_permissions admin ada untuk delete post
    return $user->name . " => ada";
    } else {
    echo "zdln";
    }



    LOGIN KE USERS ID 2

    $user = auth()->user();

    $roleUser = Role::find(2);

    $user->assignRole('user');                      CREATE ROLE BERDASARKAN YANG LOGIN => table => model_has_roles
    $roleUser->givePermissionTo('view post');       CREATE PERMISSION BERDASARKAN ROLE => table => role_has_permissions 
    $user->givePermissionTo('delete post');         USER SPECIAL DITAMBAH delete post permission yang id 2
    dd($user->can('delete post'));



    LOGIN KE USERS ID 3


    $roleUserId3 = Role::find(3);
    $user->assignRole('user');
    $user->givePermissionTo('view post');
    dd($user->can('edit post'));


});

    
    

    */
