<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\HoliPlanController;
use App\Http\Controllers\AssignementController;
use App\Http\Controllers\DayController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('addEmploye', [EmployeController::class,'store']);
Route::get('employes', [EmployeController::class,'index']);
Route::put('employeUpdate/{id}', [EmployeController::class,'update']);
Route::put('setToBusy/{id}', [EmployeController::class,'setToBusy']);
Route::get('getEmploye/{id}', [EmployeController::class,'show']);

Route::delete('deleteEmploye/{id}', [EmployeController::class,'destroy']);

Route::post('addRound', [RoundController::class,'store']);
Route::get('rounds', [RoundController::class,'index']);
Route::get('getRoundsNumber', [RoundController::class,'getRoundsNumber']);
Route::put('roundUpdate/{id}', [RoundController::class,'update']);
Route::delete('deleteRound/{id}', [RoundController::class,'destroy']);

Route::post('dailyRounds', [RoundController::class,'dailyRounds']);

Route::post('addPlan', [PlanController::class,'store']);
Route::get('plans', [PlanController::class,'index']);
Route::get('plan/{id}', [PlanController::class,'show']);
Route::delete('deletePlan/{id}', [PlanController::class,'destroy']);
Route::get('verifyPlan', [PlanController::class,'verifyPlan']);


Route::get('planDays', [DayController::class,'index']);

Route::post('addAssignement', [AssignementController::class,'store']);
Route::post('assignements', [AssignementController::class,'index']);

Route::post('planEmployes', [EmployeController::class,'planEmployes']);
Route::post('planRounds', [RoundController::class,'planRounds']);


Route::put('assignementUpdate/{id}', [AssignementController::class,'update']);
Route::delete('deleteAssignement/{id}', [AssignementController::class,'destroy']);
Route::get('assignmentsPlan/{id}', [planController::class,'show']);

Route::post('getDay', [DayController::class,'getDay']);

