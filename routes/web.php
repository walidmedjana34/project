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

// ==================== PUBLIC ROUTES ====================
 Route::patch('/properties/{property}/approve', [PropertyController::class, 'approve'])->name('properties.approve');
    Route::patch('/properties/{property}/reject', [PropertyController::class, 'reject'])->name('properties.reject');
    
   
    Route::patch('/vacances/{vacance}/approve', [VacanceController::class, 'approve'])->name('vacance.approve');
    Route::patch('/vacances/{vacance}/reject', [VacanceController::class, 'reject'])->name('vacance.reject');

// Home/Accueil Routes
Route::get('/', [AccueilController::class, 'index'])->name('home.Accueil');
Route::get('/connexion', fn() => view('home.connexion'))->name('home.connexion');
Route::get('/details', fn() => view('home.details'))->name('home.details');
Route::get('/home/details/{id}', [PropertyController::class, 'detaille'])->name('home.detaills');
Route::get('/type-annonce', fn() => view('home.type-annonce'))->name('home.type-annonce');
Route::get('/annonces', [PropertyController::class, 'indexx'])->name('home.annonces');
Route::get('/agences', [AgencyController::class, 'indexx'])->name('agence.agences');
Route::get('/agence/profile/{id}', [AgencyController::class, 'profile'])->name('agence.profile');
Route::get('/services', fn() => view('service.services'))->name('service.services');
Route::get('/services/plan', [ServiceController::class, 'plan'])->name('services.plan');
Route::post('requestse', [AgencyController::class, 'store'])->name('agency.store');
// Authentication Routes
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/session', [SessionsController::class, 'store'])->name('login.post');
Route::get('/login/forgot-password', [ResetController::class, 'create']);
Route::post('/forgot-password', [ResetController::class, 'sendEmail'])->name('password.request');
Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Password Reset Routes
Route::get('/motedepass', fn() => view('user.motedepass'))->name('user.oblier');
Route::get('/confirmation', fn() => view('user.confirmation'))->name('user.confirmation');
Route::get('/newpass', fn() => view('user.newpass'))->name('user.newpass');
Route::post('/password/send-code', [ChangePasswordController::class, 'sendResetCode'])->name('password.send.code');
Route::post('/verify-code', [ChangePasswordController::class, 'verifyResetCode'])->name('password.verify.code');
Route::post('/newpass', [ChangePasswordController::class, 'submitNewPassword'])->name('password.change');

// Property Routes
Route::get('/annonces', [PropertyController::class, 'indexx'])->name('home.annonces');
Route::post('/annonces', [PropertyController::class, 'store'])->name('annonces.store');
Route::get('/annoncecreate', [PropertyController::class, 'create'])->name('annonces.create');

// Agency Routes
Route::get('/agence/inscription', fn() => view('agence.inscription'))->name('agence.inscription');
Route::post('/contact-agency', [MessageController::class, 'store'])->name('contact.agency');

// Vacance Routes
Route::get('/ajouter vacance', fn() => view('vacance.ajouter_vacance'))->name('home.ajouter_vacance');
Route::get('/vacances', [VacanceController::class, 'index'])->name('vacances.index');
Route::post('/vacances/filtrer', [VacanceController::class, 'filtrer'])->name('vacances.filtrer');
Route::get('/vacances/{vacance}', [VacanceController::class, 'show'])->name('vacance.details');
Route::post('Vacanceeee', [VacanceController::class, 'store'])->name('vacances.store');

// Request Routes
Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
Route::patch('/requests/{request}/approve', [RequestController::class, 'approve'])->name('requests.approve');
Route::patch('/requests/{request}/reject', [RequestController::class, 'reject'])->name('requests.reject');

// Visit Routes
Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');

// Message Routes
Route::post('messages', [MessageController::class, 'store'])->name('messages.store');

Route::post('/storemessage', [MessageSupportController::class, 'store'])->name('message.store');


// Utility Routes
Route::get('/get-communes', function(Request $request) {
    $wilaya = $request->input('wilaya');
    $communes = config("communes.$wilaya", []);
    return response()->json($communes);
});
   
// ==================== AUTHENTICATED ROUTES ====================
Route::group(['middleware' => 'auth'], function () {
 
    
  
    
     
   
    
   
    
    // Transaction Routes
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    
    
   
    
    
    
    // Profile Routes
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/agency/password/update', [ProfileController::class, 'updatePassword'])->name('passwordupdate');
});

// ==================== AGENCY-SPECIFIC ROUTES ====================
Route::middleware(['auth:agency'])->prefix('dashboard')->name('agence.')->group(function() {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
   
 

    // Properties
    Route::get('/properties', [PropertyController::class, 'indexxxx'])->name('properties');
    Route::put('/properties/{property}', [ProfileController::class, 'updatee'])->name('update');
    Route::put('/update-property/{id}', [ProfileController::class, 'updateee'])->name('updatee');
	Route::delete('/vacances-properties/{id}', [ProfileController::class, 'destroy'])->name('destroy');
	Route::delete('/propertiesshome.detaille/{id}', [ProfileController::class, 'destroyy'])->name('destroyy');
    Route::get('/agency/properties', [PropertyController::class, 'agencyProperties'])->name('agency.properties');
    Route::post('/generate-description', [AIController::class, 'generateDescription'])->name('description');
    // Vacances
    Route::get('/vacances', [VacanceController::class, 'indexxxx'])->name('vacances');
    Route::get('/agency/vacances', [VacanceController::class, 'agencyVacances'])->name('agency.vacances');
    
    // Requests
    Route::get('/request', [PropertyController::class, 'agencyRequests'])->name('request');
    Route::get('/requestdd', [VacanceController::class, 'agencyVacances'])->name('vacancess');
    
    // Settings
    Route::get('/settings', [ProfileController::class, 'setting'])->name('settings');
    
    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/conversation/{user}', [MessageController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages/send', [MessageController::class, 'sendMessage']);
    Route::post('/messages/mark-as-read/{messageId}', [MessageController::class, 'markAsRead']);
    
    // Visits
    Route::get('/visitees', [VisitController::class, 'index'])->name('visites');
    Route::post('/visits/{visit}/reschedule', [VisitController::class, 'reschedule'])->name('visits.reschedule');
    Route::put('/visits/{visit}/update-status', [VisitController::class, 'updateStatus'])->name('visits.update-status');
    Route::get('/services/plan', [ServiceController::class, 'plan'])->name('plan');
  
Route::post('/dashboard/chatbot/message', [ChatbotController::class, 'send'])->name('send');


});

// ==================== CLIENT-SPECIFIC ROUTES ====================
Route::middleware(['auth'])->group(function() {
    Route::get('/client/dashboard', [ProfileController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/client/visits', [VisitController::class, 'clientVisits'])->name('client.visits');
    Route::post('/client/visits/{visit}/cancel', [VisitController::class, 'clientCancelVisit'])->name('client.visits.cancel');
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboarde', fn() => view('dashboard'))->name('dashboard');
       // Dashboard Routes
Route::get('/message-management', [MessageSupportController::class, 'index'])->name('message.management');
    Route::get('billing', fn() => view('billing'))->name('billing');
    Route::get('profile', fn() => view('profile'))->name('profile');
    Route::get('rtl', fn() => view('rtl'))->name('rtl');
    Route::get('tables', fn() => view('tables'))->name('tables');
    Route::get('virtual-reality', fn() => view('virtual-reality'))->name('virtual-reality');
    Route::get('static-sign-in', fn() => view('static-sign-in'))->name('sign-in');
    Route::get('static-sign-up', fn() => view('static-sign-up'))->name('sign-up');
    Route::get('agency-request-management', [AgencyController::class, 'indexxx'])->name('agency-request-management');
    Route::get('/anoncy-request-management', [PropertyController::class, 'index'])->name('anoncy-request-management');
// Agency Request Management
    
    Route::patch('/agencies/{agency}/approve', [AgencyController::class, 'approve'])->name('agencies.approve');
    Route::patch('/agencies/{agency}/reject', [AgencyController::class, 'reject'])->name('agencies.reject');
// Property Management Routes
    Route::get('anoncy-gestion', fn() => view('laravel-examples/anoncy-gestion'))->name('anoncy-gestion');


 // User Management Routes
    Route::get('user-management', [UserController::class, 'index'])->name('user-management');  
 // Vacance Management Routes
    Route::get('/vaconcy-request-management', [VacanceController::class, 'indexx'])->name('vaconcy-request-management');
  // User Profile Routes
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
     Route::match(['post', 'put'], 'user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    // Routes pour les agences
	Route::get('Agency-Management',[AgencyController::class, 'index'])->name('agency-management');
	Route::post('Agency-Management', [AgencyController::class, 'store'])->name('agencies.store');
    Route::get('Agency-Management/{agency}', [AgencyController::class, 'show'])->name('agencies.show');
	Route::get('/Agency-Management/{agency}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');
    Route::put('Agency-Management/{agency}', [AgencyController::class, 'update'])->name('agencies.update');
    Route::delete('agencies/{agency}', [AgencyController::class, 'destroy'])->name('agencies.destroy');
	
	
});
Route::get('/', function () {
    return 'Laravel works without DB! 🎉';
});
