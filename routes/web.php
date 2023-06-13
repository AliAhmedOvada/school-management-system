<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLmsController;
use App\Http\Controllers\SubjectController;
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



Route::resource('countries', CountryController::class);

Route::get('/pizzas', function (Request $request) {

    // $a = ['2', '3', '4', '1', '12',5,7,8,54,3,2,3,5,7];

    // for ($i = 0; $i < count($a) - 1; $i++) {
    //     if ($a[$i] < $a[$i + 1]) {
    //         $temp = $a[$i];
    //         $a[$i] = $a[$i + 1];
    //         $a[$i + 1] = $temp;
    //          $i = -1;
    //         // die;// Reset $i to recheck previous elements
    //     }
    //     echo $i . ' tt ';
    // }
    // echo "<pre>";

    // print_r($a);

    // $aa = ['aa', 'absw', 'sss', 'fdsfsdf', 'dasd', 'sss', 'a', 'fdsfsdf'];
    // $max_length = strlen($aa[0]);
    // $max_length_array = [];

    // foreach ($aa as $string) {
    //   if (strlen($string) > $max_length) {
    //     $max_length = strlen($string);
    //     $max_length_array = [$string];
    //   } else if (strlen($string) == $max_length) {
    //     $max_length_array[] = $string;
    //   }
    // }

    // echo "The array with the maximum length of strings is: ";
    // print_r($max_length_array);
    // $highestLenght = strlen($array[0]);

    // $newArray = [];
    // foreach($array as $key => $val){
    //     if(strlen($val) > $highestLenght){
    //         $newArray = [];
    //         $newArray[]= $val;
    //         $highestLenght = strlen($val);
    //     }elseif(strlen($val) == $highestLenght){
    //         $newArray[]= $val;
    //     }
    // }

    // echo "<pre>";
    // print_r($newArray);
});




Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('lms', [StudentLmsController::class, 'index'])->name('student-lms');
});

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::resource('classes', ClassController::class);
Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('lectures', LectureController::class);
Route::get('/classes/{class}', [ClassController::class, 'show'])->name('class.show');
Route::post('/update-class-model-lecture', [ClassController::class, 'updateClassModelLecture'])->name('update.class.model.lecture');
Route::get('showLectures/{id}', [StudentLmsController::class, 'showLectures'])->name('showLectures');
Route::get('lectureDetails/{id}', [StudentLmsController::class, 'lectureDetails'])->name('lectureDetails');
