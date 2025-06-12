<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

// Admin Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CollaborateController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MetaProfileController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\LaboratoryController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\StructureOrganizationController;
use App\Http\Controllers\Admin\StudentActivityController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\StudentAchievementController;

// Frontend Controllers
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\AchievementController as FrontendAchievementController;
use App\Http\Controllers\Frontend\MetaProfileController as FrontendMetaProfileController;
use App\Http\Controllers\Frontend\FacilityController as FrontendFacilityController;
use App\Http\Controllers\Frontend\LaboratoryController as FrontendLaboratoryController;
use App\Http\Controllers\Frontend\StructureOrganizationController as FrontendStructureOrganizationController;
use App\Http\Controllers\Frontend\StudentActivityController as FrontendStudentActivityController;
use App\Http\Controllers\Frontend\LecturerController as FrontendLecturerController;
use App\Http\Controllers\Frontend\CurriculumController as FrontendCurriculumController;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Untuk Pengunjung)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// News Routes
Route::get('/news', [FrontendNewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [FrontendNewsController::class, 'show'])->name('newsdetail');
Route::get('/news/search', [FrontendNewsController::class, 'search'])->name('news.search');

// Achievement Routes
Route::get('/prestasi', [FrontendAchievementController::class, 'index'])->name('prestasi');
Route::get('/achievements/publication', [FrontendAchievementController::class, 'publication'])->name('achievements.publication');
Route::get('/achievements/research', [FrontendAchievementController::class, 'research'])->name('achievements.research');
Route::get('/achievements/achievement', [FrontendAchievementController::class, 'achievement'])->name('achievements.achievement');

// Profile & Academic Routes
Route::get('/metaprofile', [FrontendMetaProfileController::class, 'index'])->name('metaprofile');
Route::get('/curriculum', [FrontendCurriculumController::class, 'index'])->name('curriculum');
Route::get('/lecturer', [FrontendLecturerController::class, 'index'])->name('lecturer');

// Facility & Laboratory Routes
Route::get('/facility', [FrontendFacilityController::class, 'index'])->name('facility');
Route::get('/laboratory', [FrontendLaboratoryController::class, 'index'])->name('laboratory');

// Student Activity Routes
Route::prefix('student_activity')->name('student_activity.')->group(function () {
    Route::get('/activity', [FrontendStudentActivityController::class, 'index'])->name('activity');
    Route::get('/program', [FrontendStudentActivityController::class, 'program'])->name('program');
    Route::get('/club', [FrontendStudentActivityController::class, 'club'])->name('club');
});

// Organization Structure
Route::get('/structureorganization', [FrontendStructureOrganizationController::class, 'index'])
    ->name('structureorganization');

// Search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search', [SearchController::class, 'search'])->name('search.post');

// Not Found Route
Route::get('/not-found', function () {
    return view('not-found');
})->name('not-found');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // --- Rute untuk Tamu (Guest) ---
    Route::middleware('guest:admin')->group(function () {
        // Login Routes
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

        // Forgot Password Routes
        Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [AdminForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/update', [AdminForgotPasswordController::class, 'reset'])->name('password.update');
    });

    // --- Rute yang Dilindungi (Harus Login) ---
    Route::middleware('auth:admin')->group(function () {
        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.alt');

        // News Management
        Route::get('/news', [AdminNewsController::class, 'index'])->name('news.index');
        Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');
        Route::post('/news', [AdminNewsController::class, 'store'])->name('news.store');
        Route::get('/news/{id}', [AdminNewsController::class, 'show'])->name('news.show');
        Route::get('/news/{id}/edit', [AdminNewsController::class, 'edit'])->name('news.edit');
        Route::put('/news/{id}', [AdminNewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [AdminNewsController::class, 'destroy'])->name('news.destroy');

        // Collaborate Management
        Route::get('/collaborate', [CollaborateController::class, 'index'])->name('collaborate.index');
        Route::get('/collaborate/create', [CollaborateController::class, 'create'])->name('collaborate.create');
        Route::post('/collaborate', [CollaborateController::class, 'store'])->name('collaborate.store');
        Route::get('/collaborate/{id}', [CollaborateController::class, 'show'])->name('collaborate.show');
        Route::get('/collaborate/{id}/edit', [CollaborateController::class, 'edit'])->name('collaborate.edit');
        Route::put('/collaborate/{id}', [CollaborateController::class, 'update'])->name('collaborate.update');
        Route::delete('/collaborate/{id}', [CollaborateController::class, 'destroy'])->name('collaborate.destroy');

        // Testimonial Management
        Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::get('/testimonial/{id}', [TestimonialController::class, 'show'])->name('testimonial.show');
        Route::get('/testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

        // Meta Profile Management
        Route::get('/metaprofile', [MetaProfileController::class, 'index'])->name('metaprofile.index');
        Route::get('/metaprofile/create', [MetaProfileController::class, 'create'])->name('metaprofile.create');
        Route::post('/metaprofile', [MetaProfileController::class, 'store'])->name('metaprofile.store');
        Route::get('/metaprofile/{id}', [MetaProfileController::class, 'show'])->name('metaprofile.show');
        Route::get('/metaprofile/{id}/edit', [MetaProfileController::class, 'edit'])->name('metaprofile.edit');
        Route::put('/metaprofile/{id}', [MetaProfileController::class, 'update'])->name('metaprofile.update');
        Route::delete('/metaprofile/{id}', [MetaProfileController::class, 'destroy'])->name('metaprofile.destroy');

        // Curriculum Management
        Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
        Route::get('/curriculum/create', [CurriculumController::class, 'create'])->name('curriculum.create');
        Route::post('/curriculum', [CurriculumController::class, 'store'])->name('curriculum.store');
        Route::get('/curriculum/{id}', [CurriculumController::class, 'show'])->name('curriculum.show');
        Route::get('/curriculum/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
        Route::put('/curriculum/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');
        Route::delete('/curriculum/{id}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');

        // Achievement Management
        Route::get('/achievement', [AchievementController::class, 'index'])->name('achievement.index');
        Route::get('/achievement/create', [AchievementController::class, 'create'])->name('achievement.create');
        Route::post('/achievement', [AchievementController::class, 'store'])->name('achievement.store');
        Route::get('/achievement/{id}', [AchievementController::class, 'show'])->name('achievement.show');
        Route::get('/achievement/{id}/edit', [AchievementController::class, 'edit'])->name('achievement.edit');
        Route::put('/achievement/{id}', [AchievementController::class, 'update'])->name('achievement.update');
        Route::delete('/achievement/{id}', [AchievementController::class, 'destroy'])->name('achievement.destroy');

        // Facility Management
        Route::get('/facility', [FacilityController::class, 'index'])->name('facility.index');
        Route::get('/facility/create', [FacilityController::class, 'create'])->name('facility.create');
        Route::post('/facility', [FacilityController::class, 'store'])->name('facility.store');
        Route::get('/facility/{id}', [FacilityController::class, 'show'])->name('facility.show');
        Route::get('/facility/{id}/edit', [FacilityController::class, 'edit'])->name('facility.edit');
        Route::put('/facility/{id}', [FacilityController::class, 'update'])->name('facility.update');
        Route::delete('/facility/{id}', [FacilityController::class, 'destroy'])->name('facility.destroy');

        // Laboratory Management
        Route::get('/laboratory', [LaboratoryController::class, 'index'])->name('laboratory.index');
        Route::get('/laboratory/create', [LaboratoryController::class, 'create'])->name('laboratory.create');
        Route::post('/laboratory', [LaboratoryController::class, 'store'])->name('laboratory.store');
        Route::get('/laboratory/{id}', [LaboratoryController::class, 'show'])->name('laboratory.show');
        Route::get('/laboratory/{id}/edit', [LaboratoryController::class, 'edit'])->name('laboratory.edit');
        Route::put('/laboratory/{id}', [LaboratoryController::class, 'update'])->name('laboratory.update');
        Route::delete('/laboratory/{id}', [LaboratoryController::class, 'destroy'])->name('laboratory.destroy');

        // Lecturer Management
        Route::get('/lecturer', [LecturerController::class, 'index'])->name('lecturer.index');
        Route::get('/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
        Route::post('/lecturer', [LecturerController::class, 'store'])->name('lecturer.store');
        Route::get('/lecturer/{id}', [LecturerController::class, 'show'])->name('lecturer.show');
        Route::get('/lecturer/{id}/edit', [LecturerController::class, 'edit'])->name('lecturer.edit');
        Route::put('/lecturer/{id}', [LecturerController::class, 'update'])->name('lecturer.update');
        Route::delete('/lecturer/{id}', [LecturerController::class, 'destroy'])->name('lecturer.destroy');
        Route::put('/lecturer/{lecturer}/toggle-status', [LecturerController::class, 'toggleStatus'])
            ->name('lecturer.toggle-status');

        // Structure Organization Management
        Route::get('/structure_organization', [StructureOrganizationController::class, 'index'])->name('structure_organization.index');
        Route::get('/structure_organization/create', [StructureOrganizationController::class, 'create'])->name('structure_organization.create');
        Route::post('/structure_organization', [StructureOrganizationController::class, 'store'])->name('structure_organization.store');
        Route::get('/structure_organization/{id}', [StructureOrganizationController::class, 'show'])->name('structure_organization.show');
        Route::get('/structure_organization/{id}/edit', [StructureOrganizationController::class, 'edit'])->name('structure_organization.edit');
        Route::put('/structure_organization/{id}', [StructureOrganizationController::class, 'update'])->name('structure_organization.update');
        Route::delete('/structure_organization/{id}', [StructureOrganizationController::class, 'destroy'])->name('structure_organization.destroy');

        // Student Activity Management
        Route::get('/studentactivities', [StudentActivityController::class, 'index'])->name('studentactivity.index');
        Route::get('/studentactivities/create', [StudentActivityController::class, 'create'])->name('studentactivity.create');
        Route::post('/studentactivities', [StudentActivityController::class, 'store'])->name('studentactivity.store');
        Route::get('/studentactivities/{studentActivity}', [StudentActivityController::class, 'show'])->name('studentactivity.show');
        Route::get('/studentactivities/{studentActivity}/edit', [StudentActivityController::class, 'edit'])->name('studentactivity.edit');
        Route::put('/studentactivities/{studentActivity}', [StudentActivityController::class, 'update'])->name('studentactivity.update');
        Route::delete('/studentactivities/{studentActivity}', [StudentActivityController::class, 'destroy'])->name('studentactivity.destroy');

        // User Inquiry Management
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::post('/inquiries/{inquiry}/respond', [InquiryController::class, 'respond'])->name('inquiries.respond');
        Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Student Achievement Management
        Route::get('/student_achievements', [StudentAchievementController::class, 'index'])->name('student_achievement.index');
        Route::get('/student_achievements/create', [StudentAchievementController::class, 'create'])->name('student_achievement.create');
        Route::post('/student_achievements', [StudentAchievementController::class, 'store'])->name('student_achievement.store');
        Route::get('/student_achievements/{id}', [StudentAchievementController::class, 'show'])->name('student_achievement.show');
        Route::get('/student_achievements/{id}/edit', [StudentAchievementController::class, 'edit'])->name('student_achievement.edit');
        Route::put('/student_achievements/{id}', [StudentAchievementController::class, 'update'])->name('student_achievement.update');
        Route::delete('/student_achievements/{id}', [StudentAchievementController::class, 'destroy'])->name('student_achievement.destroy');
    });
});
