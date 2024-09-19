<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OrderController; // Add this if you have an OrderController
use App\Http\Controllers\StaffOrderController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication and Verification Routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified','role:staff,admin'])
    ->name('dashboard');






// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {

        ///ecommerce 
 Route::get('/ecommerce', [EcommerceController::class, 'index'])->name('ecommerce.index');
 Route::get('cart', [CartController::class, 'cart'])->name('cart');
 Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
 Route::patch('/update-cart', [CartController::class, 'update'])->name('update_cart');
 Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');
//  Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
 // PaymentController for handling the callback after payment
// Route to handle the checkout process
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Route for Chapa payment callback
Route::get('/payment/callback/{reference}', [CartController::class, 'callback'])->name('cart.callback');
Route::post('/payment/callback/{reference}', [CartController::class, 'callback'])->name('cart.callback');
// Route::get('/payment/success', [CartController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/success/{reference}', [CartController::class, 'paymentSuccess'])->name('cart.payment.success');
Route::get('/receipt/{orderCode}', [PaymentController::class, 'downloadReceipt'])->name('cart.payment.receipt');

// Route::get('/payment/callback/{reference}', [PaymentController::class, 'callback'])->name('payment.callback');
// Route::post('/payment/callback/{reference}', [PaymentController::class, 'callback'])->name('payment.callback.post');

   


// Medicine Routes
  
    Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

    // Supplier Routes
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Category Routes
    
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Staff Routes
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
   
    //doctors route
 

    Route::resource('doctors', DoctorController::class);


    // Analytics and Charts
    Route::get('/charts', [ChartController::class, 'index'])->name('charts.index');
});
Route::middleware(['role:doctor'])->group(function () {
       //orders doctor
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    //   Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

});
// Authenticated Routes
Route::middleware(['role:staff,admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
      Route::get('/medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring_soon');
    Route::get('/medicines/expired', [MedicineController::class, 'expiredMedicines'])->name('medicines.expired');


////staf orders
     Route::get('/staff/orders', [StaffOrderController::class, 'index'])->name('staff.orders.index');
    Route::put('/staff/orders/{order_code}', [StaffOrderController::class, 'update'])->name('staff.orders.update');
    Route::get('/staff/orders/{order_code}', [StaffOrderController::class, 'show'])->name('staff.orders.show');
     Route::delete('/staff/orders/{order_code}', [StaffOrderController::class, 'destroy'])->name('staff.orders.destroy');
    // Medicine Routes
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/medicines/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/detail/{category}', [CategoryController::class, 'detail'])->name('categories.detail');
  
    // Supplier Routes
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');

    // Sale Routes
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    
    Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
     Route::get('sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::post('sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');
   Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');

    Route::patch('/sales/{sale}/approve', [SaleController::class, 'approve'])->name('sales.approve');
    Route::get('invoices/{invoice}', [SaleController::class, 'showInvoice'])->name('invoices.show');

    // Purchase Routes
    Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
});

// // Order Routes (for doctors and staff)
// Route::middleware(['auth', 'role:doctor|staff'])->group(function () {
//     Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
//     Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
//     Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
//     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
//     Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
//     Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
// });

require __DIR__.'/auth.php';
