<?php

use Illuminate\Http\Request;

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
Route::post('login', 'API\UserController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group( [ 'prefix' => '/admin', 'middleware' => [ 'auth:api','admin' ] ], function () {
    Route::get( '/students', 'API\AdminController@students')->name('student.home');
    Route::get( '/{semester}/grades', 'API\AdminController@grades' )->name( 'semesters.grade' );

    Route::prefix( 'semesters' )->group( function () {

        Route::get( '/', 'admin\SemestersController@index' )->name( 'semesters.index' );

        Route::post( '/store', 'admin\SemestersController@store' )->name( 'semesters.store' );

        Route::put( '/{semester}/update', 'admin\SemestersController@update' )->name( 'semesters.update' );

        Route::get( '/{semester}/destroy', 'admin\SemestersController@destroy' )->name( 'semesters.destroy' );

    } );
    Route::prefix( 'students' )->group( function () {

        Route::get( '/', 'admin\StudentsController@index' )->name( 'students.index' );
        Route::post( '/store', 'admin\StudentsController@store' )->name( 'students.store' );

        Route::put( '/{student}/update', 'admin\StudentsController@update' )->name( 'students.update' );

        Route::get( '/{student}/destroy', 'admin\StudentsController@destroy' )->name( 'students.destroy' );

    } );


});
