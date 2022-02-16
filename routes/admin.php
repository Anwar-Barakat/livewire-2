<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointment\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointment\ListAppointment;
use App\Http\Livewire\Admin\Appointment\UpdateAppointmentForm;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Livewire\Admin\Settings\UpdateSettings;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',                         DashboardController::class)->name('dashboard');
Route::get('users',                             ListUsers::class)->name('users');
Route::get('appointments',                      ListAppointment::class)->name('appointments');
Route::get('appointments/create',               CreateAppointmentForm::class)->name('appointments.create');
Route::get('appointments/{appointment}/edit',   UpdateAppointmentForm::class)->name('appointments.edit');
Route::get('settings',                          UpdateSettings::class)->name('settings');