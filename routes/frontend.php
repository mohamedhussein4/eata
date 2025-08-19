<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\VolunteerController;
use App\Http\Controllers\Frontend\BeneficiaryController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\FoodDonationController;
use App\Http\Controllers\Frontend\DigitalCurrencyDonationController;
use App\Http\Controllers\Frontend\SmsDonationController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\BeneficiaryStoryController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\Frontend\BankAccountController;
use App\Http\Controllers\Frontend\EWalletController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\PageController;

/*
|--------------------------------------------------------------------------
| Frontend Routes - الواجهة الأمامية
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [FrontEndController::class, 'index'])->name('home');

// المشاريع
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [FrontEndController::class, 'showProject'])->name('projects.show');

// آراء العملاء
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// اتصل بنا
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// التطوع
Route::get('/volunteers', [VolunteerController::class, 'index'])->name('volunteers.index');
Route::post('/volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');

// المستفيدين

// الملف الشخصي وتحديث البيانات
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UsersController::class, 'update'])->name('profile.update');
});
Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');

// التبرعات العامة
Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::get('/donations/success', [DonationController::class, 'success'])->name('donations.success');
Route::get('/donations/cancel', [DonationController::class, 'cancel'])->name('donations.cancel');
Route::get('/donations/bank-details/{id}', [DonationController::class, 'getBankDetails'])->name('donations.bank-details');
Route::get('/donations/wallet-details/{id}', [DonationController::class, 'getWalletDetails'])->name('donations.wallet-details');

// تبرعات الطعام
Route::get('/food-donations', [FoodDonationController::class, 'index'])->name('food-donations.index');
Route::post('/food-donations', [FoodDonationController::class, 'store'])->name('food-donations.store');

// تبرعات العملات الرقمية
Route::get('/digital-currency-donations', [DigitalCurrencyDonationController::class, 'index'])->name('digital-currency-donations.index');
Route::post('/digital-currency-donations', [DigitalCurrencyDonationController::class, 'store'])->name('digital-currency-donations.store');
Route::get('/digital-currency-donations/bank-details/{id}', [DigitalCurrencyDonationController::class, 'getBankDetails'])->name('digital-currency-donations.bank-details');
Route::get('/digital-currency-donations/wallet-details/{id}', [DigitalCurrencyDonationController::class, 'getWalletDetails'])->name('digital-currency-donations.wallet-details');
Route::post('/digital-currency-donations', [DigitalCurrencyDonationController::class, 'store'])->name('digital-currency-donations.store');

// تبرعات SMS
Route::get('/sms-donations', [SmsDonationController::class, 'index'])->name('sms-donations.index');
Route::post('/sms-donations', [SmsDonationController::class, 'store'])->name('sms-donations.store');
Route::post('/sms-donations/store-record', [SmsDonationController::class, 'storeRecord'])->name('sms-donations.store-record');

// السلة
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// قصص المستفيدين
Route::get('/stories', [BeneficiaryStoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [BeneficiaryStoryController::class, 'show'])->name('stories.show');

// التذاكر والدعم الفني
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

// الحسابات المصرفية
Route::get('/bank-accounts', [BankAccountController::class, 'index'])->name('bank-accounts.index');
Route::get('/bank-accounts/{id}/details', [DonationController::class, 'getBankDetails'])->name('bank-accounts.details');

// المحافظ الإلكترونية
Route::get('/e-wallets', [EWalletController::class, 'index'])->name('e-wallets.index');
Route::get('/e-wallets/{id}/details', [DonationController::class, 'getWalletDetails'])->name('e-wallets.details');

// المدفوعات
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');

// الرسائل
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');

// الإشعارات
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

// الصفحات الثابتة
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

// المسارات المحمية (تتطلب تسجيل دخول)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UsersController::class, 'profile'])->name('users.profile');
    Route::post('/profile', [UsersController::class, 'updateProfile'])->name('users.update-profile');

    Route::get('/history', [UsersController::class, 'history'])->name('users.history');
    Route::get('/history/donations', [UsersController::class, 'donationHistory'])->name('users.donation-history');
    Route::get('/history/volunteers', [UsersController::class, 'volunteerHistory'])->name('users.volunteer-history');

    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations/process', [DonationController::class, 'process'])->name('donations.process');

    Route::get('/stories/create', [BeneficiaryStoryController::class, 'create'])->name('stories.create');
    Route::post('/stories', [BeneficiaryStoryController::class, 'store'])->name('stories.store');
    Route::get('/stories/my', [BeneficiaryStoryController::class, 'myStories'])->name('stories.my-stories');
    Route::get('/stories/{story}/edit', [BeneficiaryStoryController::class, 'edit'])->name('stories.edit');
    Route::put('/stories/{story}', [BeneficiaryStoryController::class, 'update'])->name('stories.update');
    Route::delete('/stories/{story}', [BeneficiaryStoryController::class, 'destroy'])->name('stories.destroy');
});
