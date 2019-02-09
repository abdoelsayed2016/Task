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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group( [ 'prefix' => '/admin', 'middleware' => [ 'auth','admin' ] ], function () {
    Route::get( '/', function () {
        return view( 'admin.home' );
    } )->name('admin.home');
    Route::prefix( 'students' )->group( function () {

        Route::get( '/', 'admin\StudentsController@index' )->name( 'students.index' );

        Route::get( '/create', 'admin\StudentsController@create' )->name( 'students.create' );

        Route::post( '/store', 'admin\StudentsController@store' )->name( 'students.store' );

        Route::get( '/{student}/edit', 'admin\StudentsController@edit' )->name( 'students.edit' );

        Route::put( '/{student}/update', 'admin\StudentsController@update' )->name( 'students.update' );

        Route::get( '/{student}/destroy', 'admin\StudentsController@destroy' )->name( 'students.destroy' );

        Route::get( '/{student}/show', 'admin\StudentsController@show' )->name( 'students.show' );

    } );
    Route::prefix( 'semesters' )->group( function () {

        Route::get( '/', 'admin\SemestersController@index' )->name( 'semesters.index' );

        Route::get( '/create', 'admin\SemestersController@create' )->name( 'semesters.create' );

        Route::post( '/store', 'admin\SemestersController@store' )->name( 'semesters.store' );

        Route::get( '/{semester}/edit', 'admin\SemestersController@edit' )->name( 'semesters.edit' );

        Route::put( '/{semester}/update', 'admin\SemestersController@update' )->name( 'semesters.update' );

        Route::get( '/{semester}/destroy', 'admin\SemestersController@destroy' )->name( 'semesters.destroy' );

        Route::get( '/{semester}/show', 'admin\SemestersController@show' )->name( 'semesters.show' );

    } );
    Route::prefix( 'subjects' )->group( function () {

        Route::get( '/', 'admin\SubjectsController@index' )->name( 'subjects.index' );

        Route::get( '/create', 'admin\SubjectsController@create' )->name( 'subjects.create' );

        Route::post( '/store', 'admin\SubjectsController@store' )->name( 'subjects.store' );

        Route::get( '/{subject}/edit', 'admin\SubjectsController@edit' )->name( 'subjects.edit' );

        Route::put( '/{subject}/update', 'admin\SubjectsController@update' )->name( 'subjects.update' );

        Route::get( '/{subject}/destroy', 'admin\SubjectsController@destroy' )->name( 'subjects.destroy' );

        Route::get( '/{subject}/show', 'admin\SubjectsController@show' )->name( 'subjects.show' );

    } );
    Route::prefix( 'registerations' )->group( function () {

        Route::get( '/', 'admin\RegisterationController@index' )->name( 'registerations.index' );

        Route::get( '/create', 'admin\RegisterationController@create' )->name( 'registerations.create' );

        Route::post( '/store', 'admin\RegisterationController@store' )->name( 'registerations.store' );

        Route::get( '/{registeration}/edit', 'admin\RegisterationController@edit' )->name( 'registerations.edit' );

        Route::put( '/{registeration}/update', 'admin\RegisterationController@update' )->name( 'registerations.update' );

        Route::get( '/{registeration}/destroy', 'admin\RegisterationController@destroy' )->name( 'registerations.destroy' );

        Route::get( '/{registeration}/marks', 'admin\RegisterationController@marks' )->name( 'registerations.marks' );

        Route::post( '/{registeration}/post/marks', 'admin\RegisterationController@postMarks' )->name( 'registerations.post.marks' );

    } );
    Route::prefix( 'degrees' )->group( function () {

        Route::get( '/', 'admin\DegreesController@index' )->name( 'degrees.index' );
        Route::post( '/semester', 'admin\DegreesController@semesters' )->name( 'degrees.semester' );
        Route::post( '/marks', 'admin\DegreesController@marks' )->name( 'degrees.marks' );

    } );
} );
Route::group( [ 'prefix' => '/student', 'middleware' => [ 'auth' ,'student'] ], function () {
    Route::get( '/', 'student\HomeController@index')->name('student.home');

});

