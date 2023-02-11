<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;

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

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    Route::get('/about', function () {
    return view('about');
    })->name('about');


    Route::middleware(['auth'])->group(function () {
        Route::controller(PatientController::class)->group(function () {
            Route::get('patients/', 'index')->name('patient.index');
            Route::get('patient/create', 'create')->name('patient.create');
            Route::post('patient/store', 'store')->name('patient.store');
            Route::get('patient/show/{id}', 'show')->name('patient.show');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(ConsultationController::class)->group(function () {
            Route::get('consultation/create', 'create')->name('consultation.create');
            Route::get('consultation/create_consultation/{id}', 'create_consultation')->name('create.consultation');
            Route::post('consultation/store', 'store')->name('consultation.store');
        
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(TreatmentController::class)->group(function () {
            Route::get('treatment/', 'index')->name('treatment.index');
            Route::get('treatment/create', 'create')->name('treatment.create');
            Route::get('treatment/create_treatment/{id}', 'create_treatment')->name('create.treatment');
            Route::post('treatment/store', 'store')->name('treatment.store');
                // Route::get('patients/show/{id}', 'show')->name('patient.show');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(PastTreatmentConsultationController::class)->group(function () {
            Route::get('past-treatment-consultation/index', 'index')->name('past_treatment_consultation.index');
            Route::get('past-treatment-consultation/show/{id}', 'show')->name('past_treatment_consultation.show');
        });
    });

        
    Route::middleware(['auth'])->group(function () {
        Route::controller(MedicineController::class)->group(function () {
            Route::get('medicine/', 'index')->name('medicine.index');
            Route::get('medicine/create', 'create')->name('medicine.create');
            Route::post('medicine/store', 'store')->name('medicine.store');
            // Route::get('medicine/create_medicine/{id}', 'create_medicine')->name('create.medicine');
                // Route::get('patients/show/{id}', 'show')->name('patient.show');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(MedicineCategoryController::class)->group(function () {
            Route::get('medicine-category/', 'create')->name('medicine_category.create');
            Route::post('medicine-category/store', 'store')->name('medicine_category.store');
           
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(MedicineDosageController::class)->group(function () {
            Route::get('medicine-dosage/', 'create')->name('medicine_dosage.create');
            Route::post('medicine-dosage/store', 'store')->name('medicine_dosage.store');
           
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AnalyticsController::class)->group(function () {
            Route::get('analytics/', 'index')->name('analytics.index');
           
        });
    });