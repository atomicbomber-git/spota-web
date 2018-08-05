<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();
// Route::get('create',function(){
//     $user = new App\User;
//     $user->name = "All Binardo V B B";
//     $user->email = "all_binardo@rocketmail.com";
//     $user->identity_number = "D1041141045";
//     $user->status = "A";
//     $user->type = "A";
//     $user->password = bcrypt("1041141045");
//     $user->save();
//     return $user;
// });

// Route::get('create/admin',function(){
//     $user = App\User::find(1)->admin()->save(new App\Admin([
//         'user_id' => 1,
//         'privilieges' => 'S',
//         'phone' => '081350050997',
//         'position' => 'Pengangguran'
//     ]));
//     return $user;
// });
/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
// Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth', 'Role:0']], function() {
//     Route::get('/', 'DashboardController@index')->name('dash');
//     Route::resource('users', 'UserController');
// });
Route::get('dosen','DashboardController@dosen')->name('dosen');
Route::get('mahasiswa','DashboardController@mahasiswa')->name('mahasiswa');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>['auth','can:active','can:admin'],'prefix'=>'admin'],function(){
    Route::get('/','DashboardController@admin');
    Route::group(['prefix'=>'data','middleware'=>['can:manage-superadmin']],function(){
        Route::get('fakultas','FacultyController@index')->name('faculty.index');
        Route::post('fakultas','FacultyController@store')->name('faculty.create');
        Route::get('fakultas/{id}','FacultyController@show')->name('faculty.edit');
        Route::post('fakultas/{id}','FacultyController@update')->name('faculty.update');
        Route::post('fakultas/{id}/hapus','FacultyController@destroy')->name('faculty.delete');
        Route::get('fakultas-jurusan/{id}','FacultyController@department')->name('faculty.department'); //API for Department use

        Route::get('jurusan','DepartmentController@index')->name('department.index');
        Route::post('jurusan','DepartmentController@store')->name('department.create');
        Route::get('jurusan/{id}','DepartmentController@show')->name('department.edit');
        Route::post('jurusan/{id}','DepartmentController@update')->name('department.update');
        Route::post('jurusan/{id}/hapus','DepartmentController@destroy')->name('department.delete');

        Route::get('prodi','MajorController@index')->name('major.index');
        Route::post('prodi','MajorController@store')->name('major.create');
        Route::get('prodi/{id}','MajorController@show')->name('major.edit');
        Route::post('prodi/{id}','MajorController@update')->name('major.update');
        Route::post('prodi/{id}/hapus','MajorController@destroy')->name('major.delete');
    });
    Route::group(['prefix'=>'pengumuman'],function(){
        Route::get('/','AnnouncementController@index')->name('announcement.index');
        Route::get('buat','AnnouncementController@create')->name('announcement.create');
        Route::get('edit/{id}','AnnouncementController@edit')->name('announcement.edit');
        Route::post('buat','AnnouncementController@store')->name('announcement.store');
        Route::post('edit/{id}','AnnouncementController@update')->name('announcement.update');
        Route::post('announce/{id}','AnnouncementController@announce')->name('announcement.announce');
        Route::post('hapus/{id}','AnnouncementController@destroy')->name('announcement.delete');
    });
    Route::group(['prefix'=>'data','middleware'=>['can:manage-admin']],function(){
        Route::group(['prefix'=>'mahasiswa'],function(){
            Route::get('/','StudentController@index')->name('student.index');
            Route::post('/','StudentController@store')->name('student.store');
            Route::get('edit/{id}','StudentController@show')->name('student.edit');
            Route::post('edit/{id}','StudentController@update')->name('student.update');
            Route::post('aktivasi/{id}','StudentController@activate')->name('student.activate');
            Route::post('hapus/{id}','StudentController@destroy')->name('student.delete');
        });
        Route::prefix('dosen')->group(function(){
            Route::get('/','LecturerController@index')->name('lecturer.index');
            Route::post('/','LecturerController@store')->name('lecturer.store');
            Route::get('edit/{id}','LecturerController@edit')->name('lecturer.edit');
            Route::post('edit/{id}','LecturerController@update')->name('lecturer.update');
            Route::post('aktivasi/{id}','LecturerController@activate')->name('lecturer.activate');
            Route::post('hapus/{id}','LecturerController@destroy')->name('lecturer.delete');
        });
    });

    Route::group(['prefix'=>'akun','middleware'=>['can:manage-superadmin']],function(){
        Route::get('/','AdminController@index')->name('admin.create');
        Route::post('/','AdminController@store')->name('admin.store');
        Route::post('aktivasi/{id}','AdminController@activate')->name('admin.activate');
        Route::post('hapus/{id}','AdminController@destroy')->name('admin.delete');
        Route::get('edit/{id}','AdminController@edit')->name('akun.edit');
        Route::post('edit/{id}','AdminController@update')->name('akun.update');
    });

    Route::get('profil-saya','UserController@myProfile')->name('admin.edit');
    Route::post('profil-saya','AdminController@updateMyProfile')->name('admin.update');

    
});