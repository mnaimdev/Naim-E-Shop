<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
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


// ---------------------------- Frontend --------------------------------------- //

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/getSize', [FrontendController::class, 'getSize']);



// Customer Login/Register
Route::get('/customer/login', [CustomerRegisterController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerRegisterController::class, 'customer_register'])->name('customer.register');

Route::get('/customer/logout', [CustomerRegisterController::class, 'customer_logout'])->name('customer.logout');

Route::post('/login/store', [CustomerRegisterController::class, 'login_store'])->name('login.store');
Route::post('/register/store', [CustomerRegisterController::class, 'register_store'])->name('register.store');


// Password reset
Route::get('/pass/reset', [CustomerRegisterController::class, 'pass_reset'])->name('pass.reset');
Route::post('/pass/reset/req', [CustomerRegisterController::class, 'pass_reset_req'])->name('pass.reset.req');
Route::get('/pass/reset/form/{token}', [CustomerRegisterController::class, 'pass_reset_form']);
Route::post('/pass/reset/complete', [CustomerRegisterController::class, 'pass_reset_complete'])->name('pass.reset.complete');


// EmailVerify
Route::get('/customer/email/verify/{token}', [CustomerRegisterController::class, 'email_verify']);



// Login with Github
Route::get('/github/redirect', [GithubController::class, 'github_redirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');

// Login with Google
Route::get('/google/redirect', [GoogleController::class, 'google_redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');


// Customer Info
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');

Route::post('/customer/profile/update', [CustomerController::class, 'customer_profile_update'])->name('customer.profile.update');
Route::get('/customer/order/', [CustomerController::class, 'customer_order'])->name('customer.order');



// Cart
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');

Route::get('/cart/clear/item/{cart_id}', [CartController::class, 'clear_cart_item'])->name('cart.clear.item');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');


// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity', [CheckoutController::class, 'get_city']);
Route::post('/checkout/store', [CheckoutController::class, 'checkout_store'])->name('checkout.store');

Route::get('/order/complete', [CheckoutController::class, 'order_complete'])->name('order.complete');


// Wishlist
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'wishlist_remove'])->name('wishlist.remove');



// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/review/store', [FrontendController::class, 'review_store'])->name('review.store');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


// Stripe
Route::get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
// end stripe


// ---------------------------------- End Frontend ---------------------------- //

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// ---------------------------- Backend -------------------------------------- //


// User
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/profile/update', [UserController::class, 'profile_update'])->name('profile.update');
Route::post('/profile/photo', [UserController::class, 'profile_photo'])->name('profile.photo');

Route::get('/user', [UserController::class, 'user'])->name('user');
Route::get('/delete/user/{user_id}', [UserController::class, 'delete_user'])->name('user.delete');


// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');

Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');


// Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');

Route::get('/edit/subcategory/{subcategory_id}', [SubcategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
Route::get('/delete/subcategory/{subcategory_id}', [SubcategoryController::class, 'delete_subcategory'])->name('delete.subcategory');
Route::post('/subcategory/update', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');


// Role Manager
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::get('/remove/role/{role_id}', [RoleController::class, 'remove_role'])->name('remove.role');

Route::get('/edit/role/{role_id}', [RoleController::class, 'edit_role'])->name('edit.role');
Route::post('/role/update', [RoleController::class, 'role_update'])->name('role.update');

Route::get('/role/assign', [RoleController::class, 'role_assign'])->name('role.assign');
Route::post('/assign/user/role', [RoleController::class, 'assign_user_role'])->name('assign.user.role');

Route::get('/delete/user/permission/{user_id}', [RoleController::class, 'delete_user_permission'])->name('delete.user.permission');
Route::get('/edit/user/permission/{user_id}', [RoleController::class, 'edit_user_permission'])->name('edit.user.permission');
Route::post('/update/user/permission}', [RoleController::class, 'update_user_permission'])->name('update.user.permission');


// Product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');

Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete');


// Product Inventory
Route::get('/product/inventory/{product_id}', [ProductController::class, 'product_inventory'])->name('product.inventory');
Route::post('/inventory/store', [ProductController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{inventory_id}', [ProductController::class, 'inventory_delete'])->name('delete.inventory');



// Brands
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/remove/{brand_id}', [BrandController::class, 'brand_remove'])->name('brand.remove');


// Product Variation
Route::get("/product/variation", [ProductVariationController::class, "product_variation"])->name("product.variation");

Route::post("/color/store", [ProductVariationController::class, "color_store"])->name("color.store");
Route::post("/size/store", [ProductVariationController::class, "size_store"])->name("size.store");

Route::get("/color/delete/{color_id}", [ProductVariationController::class, "color_delete"])->name("color.delete");
Route::get("/size/delete/{size_id}", [ProductVariationController::class, "size_delete"])->name("size.delete");



// Coupon
Route::get("/coupon", [CouponController::class, "coupon"])->name("coupon");
Route::post("/coupon/store", [CouponController::class, "coupon_store"])->name("coupon.store");
Route::get("/coupon/delete/{coupon_id}", [CouponController::class, "coupon_delete"])->name("coupon.delete");


// Order
Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::post('/order/status', [OrderController::class, 'order_status'])->name('order.status');
Route::get('/invoice/download/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');
