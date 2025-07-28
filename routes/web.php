<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LivryController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FedaPayController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\PayDunyaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\AcceptLivraisonController;

Route::controller(UserController::class)->group(function () {
    Route::get('user/UserCreate', 'UserCreate')->name('UserCreate');
    Route::post('user/register', 'register')->name('register');
    Route::get('/login',   'login')->name('login');
    Route::post('/loginUpdate',   'loginUpdate')->name('login.Update');
    Route::post('/logout',   'logout')->name('logout');

    Route::get('/email/verify',  'emailVerify')->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}',  'emailVerifyUpdate')->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/resend',   'emailResend')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    Route::get('/complete-profile',  'completeProfile')->name('completeProfile');
    Route::post('/completeProfile',  'completeProfileUpdate')->name('completeProfile.Update');



    Route::get('/forgot-password',   'forgotPassword')
        ->middleware('guest')->name('password.request');
    Route::post('/forgot-password',  'PasswordEmail')->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}',  'resetPassword')->middleware('guest')->name('password.reset');
    Route::post('/reset-password',  'resetPasswordUpdate')->middleware('guest')->name('password.update');
});

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});




Route::middleware(['auth', 'UserBanned', 'CompleteProfile'])->group(function () {

    Route::get('/', [PublishController::class, 'index'])->name('home');
    Route::get('publish', [PublishController::class, 'publish'])->name('publish');
    Route::post('publishStore', [PublishController::class, 'publishStore'])->name('publishStore');

    Route::get('/showPublish/{publish}', [PublishController::class, 'show'])->name('show');

    Route::get('publishEdit/{publish}', [PublishController::class, 'publishEdit']);
    Route::post('UpdatedPublish/{publish}', [PublishController::class, 'UpdatedPublish']);
    Route::get('deletePublish/{publish}', [PublishController::class, 'deletePublish']);
    Route::post('replicate/{publish}', [PublishController::class, 'replicate']);

    //Route::get('/ville/{ville}', [FilterController::class, 'FilterVille'])->name('ville.filter');

    Route::get('/livreur', [LivreurController::class, 'livreurView'])->name('livreurView');
    Route::post('/AddLivreur', [LivreurController::class, 'AddLivreur'])->name('AddLivreur');
    //dashbord

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile', 'update')->name('profile.update');
    });

    Route::controller(UtilisateursController::class)->group(function () {

        Route::get('/user',   'index')->name('user');
        Route::get('/ban/{user}',  'ban')->name('ban');
        Route::get('/unban/{user}', 'unban')->name('unban');
    });



    ///////
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/livreurShow', [DashboardController::class, 'livreurShow'])->name('livreurShow');
    Route::get('/bailleur', [DashboardController::class, 'bailleur'])->name('bailleur');
    Route::get('/locataire', [DashboardController::class, 'locataire'])->name('locataire');
    Route::get('/livryShow', [DashboardController::class, 'livryShow'])->name('livryShow');

    //le status de la livraison 

    Route::post('/livryShow/{livry}/livré', [LivryController::class, 'livrer'])->name('livrer');
    Route::post('/livryShow/{livry}/annulé', [LivryController::class, 'annuler'])->name('annuler');

    //accepter une livraison

    Route::post('/livryAccept/{livrie_id}', [AcceptLivraisonController::class, 'Accepter'])

        ->middleware('throttle:3,1')

        ->name('Accepter');

    Route::delete('/LivryAnnuler/{livrie_id}', [AcceptLivraisonController::class, 'destroy'])

        ->middleware('throttle:3,1')

        ->name('destroy');


    Route::get('/notif/{id}', [NotifController::class, 'markAsread'])->name('markAsread');
    //contact

    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

    //paydunya

    Route::get('payment/{publish}', [PaymentController::class, 'paymentLink'])->name('paymentLink');

    Route::post('/payInit/{publish}', [PayDunyaController::class, 'createInvoice'])->name('paydunya.pay');

    Route::get('/pay/success', [PayDunyaController::class, 'paymentSuccess'])->name('paydunya.success');
    Route::get('/pay/cancel/{publish}', [PayDunyaController::class, 'paymentCancel'])->name('paydunya.cancel');


    Route::get('dunyaPdf/{payment}', [PdfController::class, 'facture']);
    Route::get('paymentDunya', [PdfController::class, 'paymentDunya'])->name('paymentDunya');
    //FedaPayController

    Route::post('/fedapay/{publish}', [FedaPayController::class, 'FedaPay'])->name('FedaPay.pay');


    Route::get('fonctionnement', [RulesController::class, 'fonctionnement'])->name('fonctionnement');
    Route::get('cgu', [RulesController::class, 'cgu'])->name('cgu');

    Route::get('confidentialite', [RulesController::class, 'confidentialite'])->name('confidentialite');
    Route::get('qui', [RulesController::class, 'qui'])->name('qui');
    Route::get('legale', [RulesController::class, 'legale'])->name('legale');
    Route::get('help', [RulesController::class, 'help'])->name('help');
});
Route::fallback(function () {
    return response()->view('error.404');
});
Route::post('pay/callback', [PayDunyaController::class, 'handleIpn'])->name('paydunya.callback');
Route::post('fedapay/webhook', [FedaPayController::class, 'webhook'])->name('fedapay.webhook');

Route::get('fedapay/callback', [FedaPayController::class, 'callback'])->name('fedapay.callback');
