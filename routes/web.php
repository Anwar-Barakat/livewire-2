<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointment\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointment\ListAppointment;
use App\Http\Livewire\Admin\Appointment\UpdateAppointmentForm;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');

Route::get('admin/users', ListUsers::class)->name('admin.users');

Route::get('admin/appointments', ListAppointment::class)->name('admin.appointments');

Route::get('admin/appointment/create', CreateAppointmentForm::class)->name('admin.appointments.create');

Route::get('admin/appointment/{appointment}/edit', UpdateAppointmentForm::class)->name('admin.appointments.edit');
