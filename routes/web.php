<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemOptionController;
use App\Http\Controllers\UserController;





Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::patch('users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggleRole');
});





Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('food-items', FoodItemController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('item-options', ItemOptionController::class)->except('show');
});




Route::middleware(['auth'])->group(function () {
    Route::resource('restaurants', RestaurantController::class)->except('show');
});

// الصفحة الرئيسية العامة
Route::get('/', fn() => view('landing'))->name('landing');

// عرض نموذج تسجيل الدخول والتسجيل
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');

// إرسال بيانات التسجيل وتسجيل الدخول
Route::post('/register', [AuthController::class, 'registerWeb']);
Route::post('/login', [AuthController::class, 'loginWeb']);
Route::post('/logout', [AuthController::class, 'logoutWeb'])->middleware('auth')->name('logout');

// صفحة لوحة المستخدم بعد الدخول
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (in_array($user->role, ['Admin', 'SuperAdmin'])) {
        return view('dashboard', ['role' => 'admin']);
    } elseif ($user->role === 'Client') {
        return view('dashboard', ['role' => 'client']);
    } elseif ($user->role === 'Delivery') {
        return view('dashboard', ['role' => 'delivery']);
    }

    abort(403); // صلاحية غير كافية
})->middleware('auth')->name('dashboard');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('food-items', FoodItemController::class)->except('show');
});
