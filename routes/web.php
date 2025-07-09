<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\{
    ChangePasswordController,
    HomeController,
    InfoUserController,
    RegisterController,
    ResetController,
    SessionsController,
    AgencyController,
    PropertyController,
    RequestController,
    TransactionController,
    MessageController,
    UserController,
    AccueilController,
    AuthController,
    VacanceController,
    ProfileController,
    DashboardController,
    MessageSupportController,
    VisitController,
    ServiceController,
    AIController,
    ChatbotController
};

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
    return 'Laravel is working 🎉';
});