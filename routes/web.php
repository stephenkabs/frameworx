<?php

use App\Exports\PayslipBankExport;
use App\Exports\PayslipMobileExport;
use App\Exports\PayslipNormalExport;
use App\Exports\PayslipsExport;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\MicrosoftAuthController;
use App\Http\Controllers\BackgroundController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DatabaseExportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GarnishController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NavigateController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\PdfMergeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PricingPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallpaperController;
use App\Http\Controllers\WazaController;
use App\Http\Controllers\WorkerController;
use App\Mail\WelcomeEmail;

use App\Models\Clearance;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Maatwebsite\Excel\Facades\Excel;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::group(['middleware' => ['role:admin|user']], function () {
//  Route::group(['middleware' => ['isAdmin']], function () {
    Route::middleware(['auth', 'check.active'])->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::get('role/{roleId}/add-permission', [RoleController::class, 'addPermissionToRole']);
    Route::put('role/{roleId}/add-permission', [RoleController::class, 'givePermissionToRole']);
    Route::resource('dashboard', AdminController::class);
    Route::post('/dashboard/logout', [AdminController::class, 'logout'])->name('dashboard.logout');
    Route::resource('setting', SettingController::class);
    // Route::resource('about_us', AboutController::class);
        Route::resource('doc', DocController::class);
Route::resource('documents', DocumentController::class);
Route::resource('assign', AssignController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('comments', CommentController::class);
Route::resource('garnish', GarnishController::class);

Route::resource('clearances', ClearanceController::class);

Route::resource('asset', AssetController::class);




Route::get('/clearances/{slug}/export-to-pdf', [ClearanceController::class, 'exportToPDF'])->name('clearances.exportToPDF');

//  Route::get('/my_documents', [AssignController::class, 'myDocuments'])->name('assign.myDocuments');
    Route::get('/currency_form', [CurrencyController::class, 'showForm'])->name('currency.form');
    Route::post('/currency-process', [CurrencyController::class, 'process'])->name('currencies.process');
    Route::post('/currency/update', [CurrencyController::class, 'update'])->name('currency.update');

    Route::get('/my_documents', [DocumentController::class, 'myDocuments'])->name('documents.my_documents');
Route::resource('background', BackgroundController::class);
Route::resource('menu', MenuController::class);
Route::resource('heros', HeroController::class);
Route::resource('solutions', SolutionController::class);

// Route for Payment Success

Route::get('/pdf/merge', [PdfMergeController::class, 'showForm'])->name('pdf.merge.form');
Route::post('/pdf/merge', [PdfMergeController::class, 'mergePdfs'])->name('pdf.merge');
    Route::post('/run-terminal', [TerminalController::class, 'runCommand'])->name('run.terminal');
    Route::get('/terminal/form', [TerminalController::class, 'showForm'])->name('terminal.form')->middleware(['auth', 'pricing_feature:terminal']);

    // Route::get('/terminal/form', [TerminalController::class, 'showForm'])->name('terminal.form')->middleware(['auth', 'pricing_feature:terminal']);
        Route::get('/terminal/form', [TerminalController::class, 'showForm'])->name('terminal.form');


Route::get('/merge', function () {
    return view('merge');
})->name('merge.form');

    // Route::resource('suppliers',SupplierController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('worker', WorkerController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('customs', CustomController::class);
    Route::resource('leave', LeaveController::class);
    Route::resource('quotations', QuotationController::class);

    Route::get('/quotations/{slug}/send', [QuotationController::class, 'sendEmail'])->name('quotations.sendEmail');

    Route::resource('client', ClientController::class);
    Route::resource('payslip', PayslipController::class);
    Route::get('/payslip/{slug}/export-to-pdf', [PayslipController::class, 'exportToPDF'])->name('payslip.exportToPDF');
    Route::resource('profit', ProfitController::class);
    Route::resource('programs', ProgramController::class);
    // Route::post('/get-worker', function(Request $request) {
    //     $worker = \App\Models\Worker::with('attendances')
    //         ->where('tracking_code', $request->tracking_code) // <- updated this line
    //         ->where('user_id', auth()->id())
    //         ->first();

    //     return response()->json($worker);
    // })->middleware('auth');


Route::post('/get-worker', function(Request $request) {
    $worker = \App\Models\Worker::with('attendances')
        ->where('tracking_code', $request->tracking_code)
        ->first(); // Removed user_id restriction for non-logged-in users

    return response()->json($worker);
});

Route::get('/test-html-email', function () {
    Mail::to('test@example.com')->send(new WelcomeEmail());
    return 'HTML email sent!';
});

// Route::get('/test-email', function () {
//     Mail::raw('Hello Stephen from Mailpit!', function ($message) {
//         $message->to('test@example.com')
//                 ->subject('Test Email');
//     });

//     return 'Email sent!';
// });


  // Email to Env File
    Route::get('/email-config', function () {
        return view('email-config');
    })->name('email.config');

    Route::post('/email-config', [EmailController::class, 'store'])->name('email.store');
    //  End here



Route::post('/ask', [AIController::class, 'ask']);
Route::get('/ask', [AIController::class, 'showForm']);


    // Route for showing the password form
    Route::get('/accounts/password', [AccountController::class, 'showPasswordForm'])->name('accounts.password');

    // Route for verifying the password
    Route::post('/accounts/verifyPassword', [AccountController::class, 'verifyPassword'])->name('accounts.verifyPassword');

    // Resource route for the accounts (index, show, create, store, etc.)
    Route::resource('accounts', AccountController::class);
        Route::resource('money', MoneyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('pricingPlan', PricingPlanController::class);
    Route::resource('waza', WazaController::class);
    Route::post('/waza/import', [WazaController::class, 'importExcel'])->name('waza.import');
    Route::delete('/waza/bulk-delete', [WazaController::class, 'bulkDelete'])->name('waza.bulkDelete');
    Route::delete('/waza/delete-all', [WazaController::class, 'deleteAll'])->name('waza.deleteAll');

        Route::get('/accounts/password', [AccountController::class, 'showPasswordForm'])->name('accounts.password');

    // Route for verifying the password
    Route::post('/accounts/verifyPassword', [AccountController::class, 'verifyPassword'])->name('accounts.verifyPassword');

    // Resource route for the accounts (index, show, create, store, etc.)
    Route::resource('accounts', AccountController::class);


    Route::get('/waza/delete-test', function () {
        return 'Route works!';
    });

    // Route::put('/pricing-plan/update', [PricingPlanController::class, 'update'])->name('pricingPlan.update');

    // Route::post('/user/update-pricing-plan', [UserController::class, 'updatePricingPlan'])->name('user.updatePricingPlan');


    // Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
    // Route::get('/subscriptions/form', [SubscriptionController::class, 'showForm'])->name('subscriptions.form');
    // Route::post('/subscribe', [SubscriptionController::class, 'processSubscription'])->name('subscriptions.process');
    Route::post('/user/{slug}/update-pricing-plan', [UserController::class, 'updatePricingPlan'])->name('user.updatePricingPlan');


   // Add a custom route for toggling user status
   Route::patch('user/{user}/status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
   Route::post('/user/{slug}/update-pricing-plan', [UserController::class, 'updatePricingPlan'])->name('user.updatePricingPlan');
   Route::resource('user', UserController::class);

   Route::get('/custom-user/{user}/edit', [UserController::class, 'edit'])->name('custom-user.edit');
   Route::put('/custom-user/{user}', [UserController::class, 'update'])->name('custom-user.update');
   Route::get('/user/{slug}/export-to-pdf', [UserController::class, 'user'])->name('user.exportToPDF');

    Route::get('/wallpaper-selection', [WallpaperController::class, 'showWallpaperSelection'])
    ->name('wallpaper.selection'); // Name this route for easier reference

// Route to handle wallpaper update
Route::post('/wallpaper-update', [WallpaperController::class, 'updateWallpaper'])
    ->name('wallpaper.update'); // Name this route for easier reference


    // Route::get('/', [ProgramsController::class, 'index']);
    // Route::get('/get-programs', [ProgramsController::class, 'getPrograms']);
    // Route::post('/add-program', [ProgramsController::class, 'addProgram']);


    Route::controller(NavigateController::class)->group(function () {
        Route::get('/reports/advanced', 'reports')->name('reports.advanced');
        Route::get('/windows/traffic', 'traffic')->name('windows.traffic');
        Route::get('/reports/reported_days', 'days')->name('reports.reported_days');
        Route::get('/reports/days/export/excel', 'exportDaysToExcel')->name('reports.days.exportToExcel');
        Route::get('/windows/no_pricing_plan', 'no_pricing_plan')->name('windows.no_pricing_plan');
        Route::get('/windows/feature_restricted', 'feature_restricted')->name('windows.feature_restricted');
        Route::get('/restricted/contact-admin', 'contact')->name('restricted.contact-admin');
        Route::get('/apps/menu', 'apps')->name('apps.menu');
        Route::get('windows/developer_dashboard', [NavigateController::class, 'developer_dashboard'])->name('windows.developer_dashboard');

    });
    Route::resource('stores', StoreController::class);
    Route::post('/stores/install', [StoreController::class, 'install'])->name('stores.install');

    Route::get('restricted/password', [NavigateController::class, 'showPasswordForm'])->name('restricted.show_password_form');
    Route::post('restricted/password', [NavigateController::class, 'verifyPassword'])->name('restricted.verify_password');
    Route::get('restricted/developer_dashboard', [NavigateController::class, 'developer_dashboard'])->name('restricted.developer_dashboard');


    // Route::controller(NavigateController::class)->group(function () {
    //     // Route::get('/', 'index')->name('welcome');


    //     Route::get('/windows/apps', 'apps_table')->name('windows.apps');
    //     // Route::get('/windows/contact-admin', 'contact')->name('windows.contact-admin');
    //     Route::get('/windows/splash', 'splash')->name('windows.splash');
    //     Route::get('/windows/billing_products', 'billing_products')->name('windows.billing_products');
    //     Route::get('/windows/select_package', 'select_package')->name('windows.select_package');
    //     Route::get('/windows/terminal', 'terminal')->name('windows.terminal');
    //     Route::get('/windows/due_payments', 'due_payments')->name('windows.due_payments');
    //     Route::get('/windows/loan_calculator', 'loan_calculator')->name('windows.loan_calculator');
    //     Route::get('/windows/payments', 'payments')->name('windows.payments');
    //     Route::get('/windows/traffic', 'traffic')->name('windows.traffic');
    //     Route::get('/windows/personal', 'personal')->name('windows.personal');
    //     Route::get('/windows/folders', 'folders')->name('windows.folders');
    //     Route::get('/windows/lock_screen', 'lock_screen')->name('windows.lock_screen');
    //     Route::get('/windows/calculator', 'calculator')->name('windows.calculator');
    //     Route::get('/windows/bluetooth', 'bluetooth')->name('windows.bluetooth');
    //     Route::get('/windows/hard_drive', 'hard_drive')->name('windows.hard_drive')->middleware(['auth', 'pricing_feature:file_management']);
    //     Route::get('/windows/folders', 'folders')->name('windows.folders');
    //     Route::get('/windows/apps_widget', 'apps_widget')->name('windows.apps_widget');
    //     Route::get('/windows/off', 'off')->name('windows.off');
    //     Route::get('/windows/screen_recorder', 'screen')->name('windows.screen_recorder');
    //     Route::get('/windows/live_channels', 'live')->name('windows.live_channels');
    //     Route::get('/windows/settings', 'settings')->name('windows.settings');
    //     Route::get('/windows/user_profile', 'profile')->name('windows.user_profile');
    //     Route::get('/windows/business_manager', 'crm')->name('windows.business_manager')->middleware(['auth', 'pricing_feature:business_manager']);
    //     Route::get('/windows/online_tv', 'stream')->name('windows.online_tv');
    //     Route::get('/windows/user_settings', 'user_settings')->name('windows.user_settings');
    //     Route::get('/windows/coder', 'coder')->name('windows.coder');
    //     Route::get('/business/clients', 'business')->name('business.clients');
    //     Route::get('/windows/company_details', 'company_details')->name('windows.company_details');
    //     Route::get('/windows/bank', 'bank')->name('windows.bank');
    //     Route::get('/windows/setup', 'setup')->name('windows.setup');
    //     Route::get('/windows/paid_users', 'paid_users')->name('windows.paid_users');
    //     Route::get('/windows/due_subscriptions', 'due_subscriptions')->name('windows.due_subscriptions');
    //     Route::get('/windows/bank_payments', 'bank_payments')->name('windows.bank_payments');
    //     Route::get('/windows/no_pricing_plan', 'no_pricing_plan')->name('windows.no_pricing_plan');
    //     Route::get('/windows/feature_restricted', 'feature_restricted')->name('windows.feature_restricted');

    // });




    Route::get('/export-payslips', function () {
        return Excel::download(new PayslipsExport, 'payslips.xlsx');
    })->name('payslip.exportToExcel');

    // Route::get('/reports/days/export/excel', [PayslipController::class, 'exportDaysToExcel'])->name('payslip.days.exportToExcel');
    Route::get('/export-database', [DatabaseExportController::class, 'exportDatabase'])->name('export.database');



    Route::domain('{tenant}.yourapp.com')->middleware('tenant.subdomain')->group(function () {
        Route::get('/', function () {
            return view('tenant.home');
        });
    });


    // Add other routes that need to be tenant-specific





    Route::get('/normal_export-payslips', function () {
        return Excel::download(new PayslipNormalExport, 'payslips_normal.xlsx');
    })->name('payslip_normal.exportToExcel');

    Route::get('/bank_export-payslips', function () {
        return Excel::download(new PayslipBankExport, 'payslips_bank.xlsx');
    })->name('payslip_bank.exportToExcel');

    Route::get('/mobile_export-payslips', function () {
        return Excel::download(new PayslipMobileExport, 'payslips_mobile.xlsx');
    })->name('payslip_mobile.exportToExcel');



    Route::put('/quotations/{slug}/approve', [QuotationController::class, 'approve'])->name('quotations.approve');

    Route::post('/quotations/approve-delivery', [QuotationController::class, 'approveDelivery'])->name('quotations.approveDelivery');


    Route::get('/quotation/{slug}/export-to-pdf', [QuotationController::class, 'exportToPDF'])->name('quotation.exportToPDF');
    Route::get('/quotations/{slug}/export-to-pdf', [QuotationController::class, 'invoice'])->name('quotations.exportToPDF');
    Route::get('/receipts/{slug}/export-to-pdf', [QuotationController::class, 'receipts'])->name('receipts.exportToPDF');
    Route::get('/delivery/{slug}/export-to-pdf', [QuotationController::class, 'delivery'])->name('delivery.exportToPDF');

    Route::post('/attendance/clock-in/{worker_id}', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/clock-out/{worker_id}', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/attendance/clock-out/{worker_id}', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
 Route::resource('advance', AdvanceController::class);
 Route::resource('details', DetailController::class);
    });

Route::get('oauth/microsoft', [MicrosoftAuthController::class, 'redirectToMicrosoft'])->name('microsoft.login');
Route::get('oauth/microsoft/callback', [MicrosoftAuthController::class, 'handleMicrosoftCallback']);

Route::controller(NavigateController::class)->group(function () {
    Route::get('/restricted/contact-admin', 'contact')->name('restricted.contact-admin');
    Route::get('/windows/payment_done', 'payment_done')->name('windows.payment_done');
    Route::get('/windows/pay_now', 'pay_now')->name('windows.pay_now');
});
    // None Middleware

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('welcome');

        Route::get('/attendance_register', 'attendance')->name('attendance_register');
            Route::get('/about_us', 'about_us')->name('about_us');
                Route::get('/guide', 'guide')->name('guide');
    Route::get('/contact', 'contact')->name('contact');
        Route::get('/event_register', 'events')->name('event_register');
        Route::get('/laravel_easy', 'easy')->name('laravel_easy');
        Route::get('/church_projects', 'projects')->name('church_projects');
        Route::get('/contacts', 'contacts')->name('contacts');
        Route::get('/program_church', 'program_church')->name('program_church');
        Route::get('/downloads', 'downloads')->name('downloads');
        Route::get('/online_tv', 'online_tv')->name('online_tv');
        Route::get('/testimonial', 'testimonial')->name('testimonial');
        Route::get('/news_updates', 'news_updates')->name('news_updates');
        Route::get('/e_church', 'echurch')->name('e_church');
        Route::get('/give', 'give')->name('give');
        Route::get('/mobile/menu', 'menu')->name('mobile.menu');
        Route::get('/mobile/auth_menu', 'auth_menu')->name('auth_mobile.menu');

    });

    Route::controller(NavigateController::class)->group(function () {
        // Route::get('/', 'index')->name('welcome');

        Route::get('/my_tickets', 'tickets')->name('my_tickets');

    });

    Route::get('doc/public/{doc}', [DocController::class, 'public_show'])->name('doc.public_show');
Route::get('customs/public/{custom}', [CustomController::class, 'public_show'])->name('customs.public_show');



// Public route for non-authenticated users to view a specific event
Route::get('update/public/{update}', [UpdateController::class, 'public_show'])->name('update.public_show');
Route::get('doc/public/{doc}', [DocController::class, 'public_show'])->name('doc.public_show');
Route::get('event/public/{event}', [EventController::class, 'public_show'])->name('event.public_show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
