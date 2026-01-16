<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Event Browsing & Transactions
    Route::get('/events', [UserEventController::class, 'index'])->name('user.events.index');
    Route::get('/events/{event}', [UserEventController::class, 'show'])->name('user.events.show');
    Route::get('/events/{event}/purchase', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/my-transactions', [TransactionController::class, 'history'])->name('transactions.history');
    Route::get('/transactions/{transaction}/download', [TransactionController::class, 'downloadTicket'])->name('transactions.download');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/events', EventController::class);
    Route::resource('/admin/tickets', TicketTypeController::class);
    
    // Reports
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/admin/reports/pdf', [ReportController::class, 'exportPDF'])->name('reports.pdf');
    Route::get('/admin/reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
});

require __DIR__.'/auth.php';
