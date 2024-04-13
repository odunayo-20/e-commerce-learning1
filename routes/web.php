<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/collections', 'categories')->name('frontend.categories');
    Route::get('/collections/{category_slug}', 'product')->name('frontend.product');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView')->name('frontend.product.view');

    Route::get('/new-arrivals', 'newArrival')->name('frontend.newArrival');
    Route::get('/featured-products', 'featuredProducts')->name('frontend.featuredProducts');
    Route::get('/search-products', 'searchProducts')->name('frontend.searchProducts');
});
// Route::get('/categories', [App\Http\Controllers\Frontend\FrontendController::class, 'categories'])->name('frontend.categories');
Route::middleware(['auth'])->group(function () {

    Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist');
    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');
    Route::get('/orders', [App\Http\Controllers\Frontend\OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\Frontend\OrderController::class, 'show'])->name('orders.view');
    Route::get('/thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankYou'])->name('frontend.thank-you');
    Route::get('/profile', [App\Http\Controllers\Frontend\UserController::class, 'index'])->name('frontend.profile');
    Route::post('/profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails'])->name('frontend.profile.store');
    Route::get('/change-password', [App\Http\Controllers\Frontend\UserController::class, 'passwordCreate'])->name('frontend.password');
    Route::post('/change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword'])->name('frontend.password.store');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('admin.category');
        Route::get('category/create', 'create')->name('admin.category.create');
        Route::post('category/create', 'store')->name('admin.category.store');
        Route::get('category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('category/{category}/edit', 'update')->name('admin.category.update');
    });

    Route::get('brand', App\Livewire\Admin\Brand\Index::class)->name('admin.brand');
    Route::get('color', App\Livewire\Admin\Color\Index::class)->name('admin.color');
    Route::get('slider', App\Livewire\Admin\Slider\Index::class)->name('admin.slider');
    Route::get('users', App\Livewire\Admin\Users\Index::class)->name('admin.users');

    Route::controller(ProductController::class)->group(function () {
        Route::get('product', 'index')->name('admin.product');
        Route::get('product/create', 'create')->name('admin.product.create');
        Route::post('product/create', 'store')->name('admin.product.store');
        Route::get('product/{product}/edit', 'edit')->name('admin.product.edit');
        Route::put('product/{product}/edit', 'update')->name('admin.product.update');
        Route::get('product/{image}/remove', 'removeImage')->name('admin.product.delete.image');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index')->name('admin.order');
        Route::get('orders/{orderId}', 'show')->name('admin.order.view');
        Route::put('orders/{orderId}', 'updateOrderStatus')->name('admin.order.updateStatus');
        Route::get('orders/{orderId}/view', 'viewInvoice')->name('admin.order.viewInvoice');
        Route::get('orders/{orderId}/generate', 'generateInvoice')->name('admin.order.generateInvoice');
        Route::get('orders/{orderId}/mail', 'mailInvoice')->name('admin.order.mail');

    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index')->name('admin.setting');
        Route::post('settings', 'store')->name('admin.setting.store');
    });
});
