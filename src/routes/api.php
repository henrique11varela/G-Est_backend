<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyPersonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\EndedInternshipController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\StudentCollectionController;
use App\Http\Controllers\StudentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    /**
     * LOGIN ROUTES...
     */

    Route::post('login', [LoginController::class, 'login']);

    // Route::group(['middleware' => 'auth:sanctum'], function () {


        Route::prefix('applications')->group(function () {
            Route::get('', [ApplicationController::class, 'index']);
            Route::post('', [ApplicationController::class, 'store']);
            Route::get('{application}', [ApplicationController::class, 'show']);
            Route::put('{application}', [ApplicationController::class, 'update']);
            Route::delete('{application}', [ApplicationController::class, 'destroy']);
        });

        Route::prefix('areas')->group(function () {
            Route::get('', [AreaController::class, 'index']);
            Route::post('', [AreaController::class, 'store']);
            Route::get('{area}', [AreaController::class, 'show']);
            Route::put('{area}', [AreaController::class, 'update']);
            Route::delete('{area}', [AreaController::class, 'destroy']);
        });

        Route::prefix('companies')->group(function () {
            Route::get('', [CompanyController::class, 'index']);
            Route::post('', [CompanyController::class, 'store']);
            Route::get('{company}', [CompanyController::class, 'show']);
            Route::put('{company}', [CompanyController::class, 'update']);
            Route::delete('{company}', [CompanyController::class, 'destroy']);
        });

        Route::prefix('companypeople')->group(function () {
            Route::get('', [CompanyPersonController::class, 'index']);
            Route::post('', [CompanyPersonController::class, 'store']);
            Route::get('{companyPerson}', [CompanyPersonController::class, 'show']);
            Route::put('{companyPerson}', [CompanyPersonController::class, 'update']);
            Route::delete('{companyPerson}', [CompanyPersonController::class, 'destroy']);
        });

        Route::prefix('courses')->group(function () {
            Route::get('', [CourseController::class, 'index']);
            Route::post('', [CourseController::class, 'store']);
            Route::get('{course}', [CourseController::class, 'show']);
            Route::put('{course}', [CourseController::class, 'update']);
            Route::delete('{course}', [CourseController::class, 'destroy']);
        });

        Route::prefix('coursetypes')->group(function () {
            Route::get('', [CourseTypeController::class, 'index']);
            Route::post('', [CourseTypeController::class, 'store']);
            Route::get('{courseType}', [CourseTypeController::class, 'show']);
            Route::put('{courseType}', [CourseTypeController::class, 'update']);
            Route::delete('{courseType}', [CourseTypeController::class, 'destroy']);
        });

        Route::prefix('endedinternships')->group(function () {
            Route::get('', [EndedInternshipController::class, 'index']);
            Route::post('', [EndedInternshipController::class, 'store']);
            Route::get('{endedInternship}', [EndedInternshipController::class, 'show']);
            Route::put('{endedInternship}', [EndedInternshipController::class, 'update']);
            Route::delete('{endedInternship}', [EndedInternshipController::class, 'destroy']);
        });

        Route::prefix('internships')->group(function () {
            Route::get('', [InternshipController::class, 'index']);
            Route::post('', [InternshipController::class, 'store']);
            Route::get('{internship}', [InternshipController::class, 'show']);
            Route::put('{internship}', [InternshipController::class, 'update']);
            Route::delete('{internship}', [InternshipController::class, 'destroy']);
        });

        Route::prefix('studentcollections')->group(function () {
            Route::get('', [StudentCollectionController::class, 'index']);
            Route::post('', [StudentCollectionController::class, 'store']);
            Route::get('{studentCollection}', [StudentCollectionController::class, 'show']);
            Route::put('{studentCollection}', [StudentCollectionController::class, 'update']);
            Route::delete('{studentCollection}', [StudentCollectionController::class, 'destroy']);
        });

        Route::prefix('students')->group(function () {
            Route::get('', [StudentController::class, 'index']);
            Route::post('', [StudentController::class, 'store']);
            Route::get('{student}', [StudentController::class, 'show']);
            Route::put('{student}', [StudentController::class, 'update']);
            Route::delete('{student}', [StudentController::class, 'destroy']);
        });


    // });
});
