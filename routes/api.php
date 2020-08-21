<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('/verzoeken', function (Request $request) {

//     return $request->user();
// });


Route::apiResources(['user' =>  'API\UserController']);
Route::apiResources(['task' =>  'API\TaskController']);
Route::apiResources(['company' =>  'API\CompanyController']);
Route::get('profile', 'API\UserController@profile');
Route::get('findUser', 'API\UserController@search');
Route::put('profile', 'API\UserController@updateProfile');
Route::put('company', 'API\CompanyController@updateCompany');
Route::get('allTasks', 'API\TaskController@allTasks');
Route::get('companyTasks/{id}', 'API\TaskController@companyTasks');
// Route::apiResources(['task' =>  'API\TaskControllers']);
