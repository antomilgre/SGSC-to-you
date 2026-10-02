<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ClubController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventTypeController;
use App\Http\Controllers\Api\FinancialTransactionController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GalleryImageController;
use App\Http\Controllers\Api\MembershipApplicationController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\OfficialMemberController;
use App\Http\Controllers\Api\OfficialRoleController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\SportController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::put('/accept-registration', [AdminController::class, 'acceptRegistrationRequest']);

Route::apiResource('club', ClubController::class);
Route::apiResource('event-type', EventTypeController::class);
Route::apiResource('events', EventController::class);
Route::put('events/{event}/teams', [EventController::class, 'syncTeams']);
Route::apiResources([
    'types' => TypeController::class,
    'activities' => ActivityController::class,
    'registrations' => RegistrationController::class,
    'financial-transactions' => FinancialTransactionController::class,
    'sports' => SportController::class,
    'teams' => TeamController::class,
    'players' => PlayerController::class,
    'official-members' => OfficialMemberController::class,
    'official-roles' => OfficialRoleController::class,
    'memberships' => MembershipController::class,
    'membership-applications' => MembershipApplicationController::class,
    'news' => NewsController::class,
    'galleries' => GalleryController::class,
    'gallery-images' => GalleryImageController::class,
    'pages' => PageController::class,
]);
