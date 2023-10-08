<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::get('students', function() {
// return 'this is a student apo';
// }
// );

//This route gets student information
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::get('students/{id}/edit', [StudentController::class, 'edit']);
Route::put('students/{id}/update', [StudentController::class, 'update']);
Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);
//Make your migrations next by running
// php artisian:migratationa create-students-table
//then you add the database fields in the database folder of the laravel app 
// Locate your migrations 
//run php artisan migrate 



//run a commnd"php artisan make:model Student"

////you can then declare the table in models 

// then make the Controller