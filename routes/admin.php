<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\BeneficiaryController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\BeneficiaryStoryController;
use App\Http\Controllers\Admin\FoodDonationController;
use App\Http\Controllers\Admin\DigitalCurrencyDonationController;
use App\Http\Controllers\Admin\SmsDonationController;
use App\Http\Controllers\Admin\SmsDonationRecordController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\EWalletController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\FinancialController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TranslationController;

/*
|--------------------------------------------------------------------------
| Admin Routes - لوحة التحكم
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // لوحة التحكم الرئيسية
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // إدارة المشاريع
    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/feature', [ProjectController::class, 'toggleFeatured'])->name('projects.feature');
    Route::post('projects/{project}/approve', [ProjectController::class, 'approve'])->name('projects.approve');

    // إدارة آراء العملاء
    Route::resource('testimonials', TestimonialController::class);
    Route::get('testimonials/pending/list', [TestimonialController::class, 'pending'])->name('testimonials.pending');
    Route::post('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::post('testimonials/{testimonial}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');
    Route::post('testimonials/{testimonial}/feature', [TestimonialController::class, 'toggleFeatured'])->name('testimonials.feature');

    // إدارة المستخدمين
    Route::resource('users', UserController::class);
    Route::post('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

    // إدارة المتطوعين
    Route::resource('volunteers', VolunteerController::class);
    Route::post('volunteers/{volunteer}/approve', [VolunteerController::class, 'approve'])->name('volunteers.approve');

    // إدارة المستفيدين
    Route::resource('beneficiaries', BeneficiaryController::class);
    Route::post('beneficiaries/{beneficiary}/approve', [BeneficiaryController::class, 'approve'])->name('beneficiaries.approve');

    // إدارة التبرعات
    Route::resource('donations', DonationController::class);
    Route::put('donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('donations.update-status');
    Route::post('donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve');
    Route::post('donations/{donation}/reject', [DonationController::class, 'reject'])->name('donations.reject');

    // إدارة قصص المستفيدين
    Route::resource('stories', BeneficiaryStoryController::class);
    Route::get('stories/pending/list', [BeneficiaryStoryController::class, 'pending'])->name('stories.pending');
    Route::post('stories/{story}/approve', [BeneficiaryStoryController::class, 'approve'])->name('stories.approve');
    Route::post('stories/{story}/reject', [BeneficiaryStoryController::class, 'reject'])->name('stories.reject');
    Route::post('stories/{story}/unapprove', [BeneficiaryStoryController::class, 'unapprove'])->name('stories.unapprove');
    Route::post('stories/{story}/feature', [BeneficiaryStoryController::class, 'toggleFeatured'])->name('stories.feature');

    // إدارة تبرعات الطعام
    Route::resource('food-donations', FoodDonationController::class);
    Route::put('food-donations/{id}/status', [FoodDonationController::class, 'updateStatus'])->name('food-donations.update-status');

    // إدارة تبرعات العملات الرقمية
    Route::resource('digital-currency-donations', DigitalCurrencyDonationController::class);
    Route::put('digital-currency-donations/{id}/status', [DigitalCurrencyDonationController::class, 'updateStatus'])->name('digital-currency-donations.update-status');

    // إدارة تبرعات SMS
    Route::resource('sms-donations', SmsDonationController::class);
    Route::put('sms-donations/{id}/status', [SmsDonationController::class, 'updateStatus'])->name('sms-donations.update-status');

    // إدارة سجلات تبرعات SMS
    Route::resource('sms-donation-records', SmsDonationRecordController::class);
    Route::put('sms-donation-records/{id}/status', [SmsDonationRecordController::class, 'updateStatus'])->name('sms-donation-records.update-status');

    // إدارة الأدوار
    Route::resource('roles', RoleController::class);
    Route::post('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions');

    // إدارة الطلبات
    Route::resource('orders', OrderController::class);
    Route::put('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // إدارة الحسابات المصرفية
    Route::resource('bank-accounts', BankAccountController::class);
    Route::post('bank-accounts/{bankAccount}/activate', [BankAccountController::class, 'activate'])->name('bank-accounts.activate');
    Route::post('bank-accounts/{bankAccount}/deactivate', [BankAccountController::class, 'deactivate'])->name('bank-accounts.deactivate');

    // إدارة المحافظ الإلكترونية
    Route::resource('e-wallets', EWalletController::class);
    Route::post('e-wallets/{eWallet}/activate', [EWalletController::class, 'activate'])->name('e-wallets.activate');
    Route::post('e-wallets/{eWallet}/deactivate', [EWalletController::class, 'deactivate'])->name('e-wallets.deactivate');

    // إدارة المدفوعات
    Route::resource('payments', PaymentController::class);
    Route::post('payments/{payment}/approve', [PaymentController::class, 'approve'])->name('payments.approve');
    Route::post('payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');

    // النظام المالي
    Route::prefix('financial')->name('financial.')->group(function () {
        Route::get('/', [FinancialController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [FinancialController::class, 'reports'])->name('reports');
        Route::get('/transactions', [FinancialController::class, 'transactions'])->name('transactions');
        Route::get('/analytics', [FinancialController::class, 'analytics'])->name('analytics');
        Route::post('/export', [FinancialController::class, 'export'])->name('export');
    });

    // نظام الدعم الفني
    Route::prefix('support')->name('support.')->group(function () {
        Route::get('/tickets', [SupportController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [SupportController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/close', [SupportController::class, 'close'])->name('tickets.close');
        Route::post('/tickets/{ticket}/reopen', [SupportController::class, 'reopen'])->name('tickets.reopen');
        Route::post('/tickets/{ticket}/reply', [SupportController::class, 'reply'])->name('tickets.reply');
    });

    // إدارة الاتصال
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('contacts/mark-all-read', [ContactController::class, 'markAllAsRead'])->name('contacts.mark-all-read');

    // الإعدادات العامة
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // إدارة الصفحات الثابتة
    Route::resource('pages', PageController::class);
    Route::post('pages/{page}/publish', [PageController::class, 'publish'])->name('pages.publish');
    Route::post('pages/{page}/unpublish', [PageController::class, 'unpublish'])->name('pages.unpublish');

    // إدارة الترجمات
    Route::prefix('translations')->name('translations.')->group(function () {
        Route::get('/', [TranslationController::class, 'index'])->name('index');
        Route::get('/create', [TranslationController::class, 'create'])->name('create');
        Route::post('/', [TranslationController::class, 'store'])->name('store');
        Route::get('/{key}/edit', [TranslationController::class, 'edit'])->name('edit');
        Route::put('/{key}', [TranslationController::class, 'update'])->name('update');
        Route::delete('/{key}', [TranslationController::class, 'destroy'])->name('destroy');
        Route::post('/sync', [TranslationController::class, 'sync'])->name('sync');
        Route::post('/import', [TranslationController::class, 'import'])->name('import');
        Route::get('/export', [TranslationController::class, 'export'])->name('export');

        // ترجمة المشاريع
        Route::get('/projects', [TranslationController::class, 'projects'])->name('projects');
        Route::get('/projects/{project}/edit', [TranslationController::class, 'editProject'])->name('projects.edit');
        Route::put('/projects/{project}', [TranslationController::class, 'updateProject'])->name('projects.update');

        // ترجمة الصفحات
        Route::get('/pages', [TranslationController::class, 'pages'])->name('pages');
        Route::get('/pages/{page}/edit', [TranslationController::class, 'editPage'])->name('pages.edit');
        Route::put('/pages/{page}', [TranslationController::class, 'updatePage'])->name('pages.update');

        // ترجمة آراء العملاء
        Route::get('/testimonials', [TranslationController::class, 'testimonials'])->name('testimonials');
        Route::get('/testimonials/{testimonial}/edit', [TranslationController::class, 'editTestimonial'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}', [TranslationController::class, 'updateTestimonial'])->name('testimonials.update');

        // ترجمة القصص
        Route::get('/stories', [TranslationController::class, 'stories'])->name('stories');
        Route::get('/stories/{story}/edit', [TranslationController::class, 'editStory'])->name('stories.edit');
        Route::put('/stories/{story}', [TranslationController::class, 'updateStory'])->name('stories.update');

        // إحصائيات الترجمات
        Route::get('/statistics', [TranslationController::class, 'statistics'])->name('statistics');
    });

    // إدارة الإشعارات
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('unread-count');
        Route::post('/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('mark-read');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::delete('/clear-read', [NotificationController::class, 'clearRead'])->name('clear-read');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    // إدارة الرسائل
    Route::resource('messages', MessageController::class);
    Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::post('messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
    Route::post('messages/mark-all-read', [MessageController::class, 'markAllAsRead'])->name('messages.mark-all-read');

});
