<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketOrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\HorizonController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

use App\Models\Chat;
use App\Models\Horizon;
use App\Models\TicketOrder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/index', function () {
    return view('welcome');
});

Route::get('/regis', [AuthController::class, 'tampilRegistrasi'])->name('registrasi');
Route::post('/regis/sub', [AuthController::class, 'submitRegistrasi'])->name('submit.registrasi');

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login.tampil');
Route::post('/login/sub', [AuthController::class, 'submitLogin'])->name('submit.login');

// Route untuk menampilkan halaman beranda (dengan card event)
Route::get('/home', [HomeController::class, 'tampilHome'])->middleware('auth')->name('home.tampil');
Route::get('/', [HorizonController::class, 'tampillending'])->name('lending');



Route::get('/riwayat-transaksi', [HomeController::class, 'tampilriwayat'])->name('riwayat.index');

Route::get('/riwayat-transaksi1', [TicketOrderController::class, 'indext'])->name('riwayat.indext');



Route::get('/signup', function () {
    return view('signup');
});

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::get('/verif', function () {
    return view('verif');
});

Route::get('/verifc', function () {
    return view('verifc');
});

Route::get('/info1', function () {
    return view('user.info1');
});


Route::get('/info2', function () {
    return view('user.info2');
});

Route::get('/info3/{event_id}', [HomeController::class, 'tampilInfo3'])->name('info3');


Route::get('/info4', function () {
    return view('promotor.info4');
});
Route::get('/eticket', [HomeController::class, 'tampilETicket'])->name('user.eticket');


Route::get('/myticket', function () {
    return view('user.myticket');
})->name('user.myticket');
// web.php

Route::middleware('auth')->group(function () {
    Route::get('/live-chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/get-chats', [ChatController::class, 'fetch']);
    Route::post('/send-chat', [ChatController::class, 'store']);

});

Route::get('/admin/livechat', [LiveChatController::class, 'adminView'])->name('admin.livechat');
Route::post('/admin/livechat/send', [LiveChatController::class, 'adminSend'])->name('admin.livechat.send');

Route::get('/get-chats', [ChatController::class, 'getChats']);








Route::get('/promotorawal', function () {
    return view('promotor.promotorawal');
});
Route::get('/promotorawal1', function () {
    return view('promotorawal1');
});

Route::get('/mysales', [HomeController::class, 'mysales'])->name('promotor.mysales');

Route::get('/mysales1', function () {
    return view('promotor.mysales1');
});
Route::get('/mysales2', function () {
    return view('promotor.mysales2');
});
Route::get('/mysales3', function () {
    return view('promotor.mysales3');
});
Route::get('/mysales4', function () {
    return view('promotor.mysales4');
});
Route::get('/mysales5', function () {
    return view('promotor.mysales5');
});
Route::get('/arsipevent', function () {
    return view('promotor.arsipevent');
});

Route::get('/riwayattransaksi', function () {
    return view('promotor.riwayattransaksi');
});




Route::get('/faq', function () {
    return view('promotor.faq');
});
Route::get('/faq1', function () {
    return view('user.faq1');
});
Route::get('/faq2', function () {
    return view('admin.faq2');
});
Route::get('/review', function () {
    return view('promotor.review');
});


Route::post('/review1', [ReviewController::class, 'store'])->name('review.store');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/review1', [ReviewController::class, 'index'])->name('user.review1');

Route::get('/notif', function () {
    return view('promotor.notif');
});
Route::get('/notif1', function () {
    return view('notif1');
});

Route::get('/notif2', function () {
    return view('notif2');
});

Route::get('/notif3', function () {
    return view('notif3');
});
Route::get('/notif4', function () {
    return view('admin.notif4');
});
Route::get('/livechat', function () {
    return view('user.livechat');
})->name('livechat');


Route::get('/editprofile', function () {
    return view('user.editprofile');
})->name('user.editprofile');



Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

Route::get('/contoh', function () {
    return view('contoh');
});
Route::get('livechat1', function () {
    return view('promotor.livechat1');
});

Route::get('haladmin', function () {
    return view('admin.haladmin');
});
Route::get('editprofile1', function () {
    return view('promotor.editprofile1');
});
Route::get('editprofile3', function () {
    return view('promotor.editprofile3');
});
Route::get('/seating', function () {
    return view('seating');
});
Route::get('/tambahticket', function () {
    return view('promotor.tambahticket');
});
Route::get('/validasikonser', function () {
    return view('promotor.validasikonser');
});

Route::get('/dashboard/{dashboard}/edit', [HomeController::class, 'edit'])->name('dashboard.edit');



Route::get('/validasikonser1', function () {
    return view('promotor.validasikonser1');
});
// Route untuk menampilkan halaman dashboard
//Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

// Dashboard CRUD routes (menggunakan HomeController)
Route::resource('dashboard', HomeController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.haladmin');
    });
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

});

Route::middleware(['auth', 'role:promotor'])->group(function () {
    Route::get('/promotor/dashboard', [HomeController::class, 'Jumlahtampil'])->name('dashboard.promotor');
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });
});



Route::prefix('dashboard/horizon')->name('horizon.')->group(function () {
    Route::get('/', [HorizonController::class, 'index'])->name('index'); // tampilkan semua data
    Route::get('/create', [HorizonController::class, 'create'])->name('create'); // form create
    Route::post('/', [HorizonController::class, 'store'])->name('store'); // simpan data baru
    Route::get('/{id}/edit', [HorizonController::class, 'edit'])->name('edit'); // form edit
    Route::put('/{id}', [HorizonController::class, 'update'])->name('update'); // simpan update
    Route::delete('/{id}', [HorizonController::class, 'destroy'])->name('destroy'); // hapus data
});
Route::get('/dashboard/moment/create', [MomentController::class, 'create'])->name('moment.create');
Route::post('/dashboard/moment', [MomentController::class, 'store'])->name('moment.store');

Route::get('/dashboard/moment/{moment}/edit', [MomentController::class, 'edit'])->name('moment.edit');
Route::put('/dashboard/moment/{moment}', [MomentController::class, 'update'])->name('moment.update');

Route::delete('/dashboard/moment/{moment}', [MomentController::class, 'destroy'])->name('moment.destroy');

Route::get('/get-ticket-id', function (Request $request) {
    $ticket = \App\Models\TicketType::where([
        ['home_id', '=', $request->home_id],
        ['zone', '=', $request->zone],
    ])->first();

    return response()->json(['ticket_id' => $ticket?->id]);
});

use App\Http\Controllers\TicketAjaxController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Untuk tampil form pilih tempat (dengan parameter event_id)
Route::get('/pilihtempat/{event_id}', [HomeController::class, 'pilihTempat'])->name('pilih.tempat');

// Untuk tampil daftar semua event (tanpa pilih kursi)
Route::get('/pilihtempat', [HomeController::class, 'tampilPilihTempat'])->name('pilih.tempat.index');

// Simpan hasil pilih tempat
Route::post('/pilihtempat', [HomeController::class, 'simpanPilihTempat'])->name('pilih.tempat.submit');

Route::get('/shopping-basket', [HomeController::class, 'tampilShoppingBasket'])
    ->middleware('auth')
    ->name('user.shoppingbasket');

Route::post('/logout', function (Request $request) {
    Auth::logout();                         // Logout user
    $request->session()->invalidate();     // Invalidate session
    $request->session()->regenerateToken(); // Amankan CSRF token baru

    return redirect('/signin'); // Ganti '/signin' dengan halaman login kamu
})->name('logout');



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/payment-confirmation', [TicketOrderController::class, 'paymentConfirmation'])->name('admin.payment.confirmation');
    Route::post('/payment/accept/{id}', [TicketOrderController::class, 'acceptPayment'])->name('admin.payment.accept');
    Route::post('/payment/reject/{id}', [TicketOrderController::class, 'rejectPayment'])->name('admin.payment.reject');
});

Route::get('/info2/{event_id}', [HorizonController::class, 'tampilInfo2'])->name('info2');
Route::get('/ticket/download/{order_id}', [HomeController::class, 'downloadTicket'])->name('download.ticket');

Route::get('/ticket/download/{order_id}', [HomeController::class, 'downloadTicket'])->name('ticket.download');



Route::get('/faq1', [FaqController::class, 'index'])->name('user.faq1');


Route::get('/faq2', [FaqController::class, 'manage'])->name('faq.manage');
Route::get('/faq2/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
Route::post('/faq2/update/{id}', [FaqController::class, 'update'])->name('faq.update');
Route::delete('/faq2/delete/{id}', [FaqController::class, 'destroy'])->name('faq.delete');

// routes/web.php
Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('faq.create');
Route::post('/admin/faq/store', [FaqController::class, 'storee'])->name('faq.store');


use App\Http\Controllers\Auth\OtpController;

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');


Route::post('/register-with-otp', [OtpController::class, 'register'])->name('register.with.otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Route untuk halaman admin review
Route::get('/admin/review3', [ReviewController::class, 'indexw'])->name('admin.review3');
// Route delete review
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');




Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/search/artist', [HomeController::class, 'searchArtist'])->name('search.artist');

