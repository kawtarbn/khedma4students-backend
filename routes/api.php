<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompleteResetController;
use App\Http\Controllers\FinalFixController;
use App\Http\Controllers\SimpleReviewsController;
use App\Http\Controllers\StaticReviewsController;
use App\Http\Controllers\DebugValidationController;
use App\Http\Controllers\SimpleStudentController;
use App\Http\Controllers\DirectEmailController;
use App\Http\Controllers\SimpleJobController;
use App\Http\Controllers\SimpleServiceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HiringRequestController;
use App\Http\Controllers\StudentPasswordResetController;
use App\Http\Controllers\EmployerPasswordResetController;
use App\Http\Controllers\SeederController;
use App\Http\Controllers\StudentFixController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\SequenceFixController;
use App\Http\Controllers\RequestDebugController;
use App\Http\Controllers\DatabaseRecreateController;
use App\Http\Controllers\EmptyDatabaseController;
use App\Http\Controllers\DebugStudentsController;
use App\Http\Controllers\ForceClearController;
use App\Http\Controllers\OnDemandVerificationController;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\DatabaseStatusController;

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});

Route::get('/services', [SimpleServiceController::class, 'index']);
Route::get('/services/{id}', [SimpleServiceController::class, 'show']);


// Student routes
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::post('/login', [StudentController::class, 'login']);
Route::get('/students/{id}/services', [StudentController::class, 'getServices']);
Route::get('/students/{id}/applications', [StudentController::class, 'getApplications']);
Route::get('/students/{id}/service-applications', [StudentController::class, 'getServiceApplications']);

// Employer routes
Route::get('/employers', [EmployerController::class, 'index']);
Route::get('/employers/{id}', [EmployerController::class, 'show']);
Route::post('/employers', [EmployerController::class, 'store']);
Route::put('/employers/{id}', [EmployerController::class, 'update']);
Route::delete('/employers/{id}', [EmployerController::class, 'destroy']);
Route::post('/employer-login', [EmployerController::class, 'login']);
Route::get('/employers/{id}/jobs', [EmployerController::class, 'getJobs']);
Route::get('/employers/{id}/applications', [EmployerController::class, 'getApplications']);

//Job routes 
Route::get('/jobs', [SimpleJobController::class, 'index']);
Route::post('/jobs', [SimpleJobController::class, 'store']);
Route::get('/jobs/{id}', [SimpleJobController::class, 'show']);
Route::put('/jobs/{id}', [JobController::class, 'update']);
Route::delete('/jobs/{id}', [JobController::class, 'destroy']);

//Request routes
Route::get('/requests', [RequestController::class, 'index']);
Route::post('/requests', [RequestController::class, 'store']);
Route::get('/requests/{id}', [RequestController::class, 'show']);
Route::put('/requests/{id}', [RequestController::class, 'update']);
Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

Route::post('/reviews', [StaticReviewsController::class, 'store']);
Route::get('/reviews', [StaticReviewsController::class, 'index']);

Route::get('/success-stories', [SuccessStoryController::class, 'index']);

// Notifications routes
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::put('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);
Route::put('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);

// Contact form route
Route::post('/contact', [ContactController::class, 'store']);

// Hiring request routes
Route::post('/hiring-request', [HiringRequestController::class, 'store']);
Route::get('/hiring-requests/student/{studentId}', [HiringRequestController::class, 'getStudentHiringRequests']);
Route::get('/hiring-requests/employer/{employerId}', [HiringRequestController::class, 'getEmployerHiringRequests']);

// Student forgot password and email verification routes
Route::post('/forgot-password', [StudentPasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [StudentPasswordResetController::class, 'resetPassword']);
Route::post('/verify-email', [StudentPasswordResetController::class, 'verifyEmail']);
Route::post('/resend-verification', [StudentPasswordResetController::class, 'resendVerification']);

// Employer forgot password and email verification routes  
Route::post('/employer-forgot-password', [EmployerPasswordResetController::class, 'sendResetLink']);
Route::post('/employer-reset-password', [EmployerPasswordResetController::class, 'resetPassword']);
Route::post('/employer-verify-email', [EmployerPasswordResetController::class, 'verifyEmail']);
Route::post('/employer-resend-verification', [EmployerPasswordResetController::class, 'resendVerification']);

// Application routes
Route::get('/applications', [ApplicationController::class, 'index']);
Route::post('/applications', [ApplicationController::class, 'store']);
Route::get('/applications/{id}', [ApplicationController::class, 'show']);
Route::put('/applications/{id}', [ApplicationController::class, 'update']);
Route::delete('/applications/{id}', [ApplicationController::class, 'destroy']);

// Database seeding route
Route::get('/seed-production', [SeederController::class, 'seedProduction']);

// Fix student IDs route
Route::get('/fix-student-ids', [StudentFixController::class, 'fixStudentIds']);

// Public routes for any user
Route::post('/public/register-student', [PublicController::class, 'registerStudent']);
Route::post('/public/register-employer', [PublicController::class, 'registerEmployer']);
Route::post('/public/login-student', [PublicController::class, 'loginStudent']);
Route::post('/public/login-employer', [PublicController::class, 'loginEmployer']);
Route::get('/public/jobs', [PublicController::class, 'getPublicJobs']);
Route::get('/public/services', [PublicController::class, 'getPublicServices']);
Route::post('/public/apply-job', [PublicController::class, 'applyToJob']);

// Database// Final fix routes
Route::get('/test-registration', [FinalFixController::class, 'testRegistration']);
Route::get('/system-status', [FinalFixController::class, 'getSystemStatus']);

// Debug validation route
Route::post('/debug-validation', [DebugValidationController::class, 'debugValidation']);

// Simple student registration route (bypass validation)
Route::post('/simple-register', [SimpleStudentController::class, 'store']);

// Direct email test routes
Route::get('/test-direct-email', [DirectEmailController::class, 'testDirectEmail']);
Route::post('/send-verification-email', [DirectEmailController::class, 'sendVerificationEmail']);

// Verification routes
Route::get('/get-verification-code', [VerificationController::class, 'getVerificationCode']);
Route::post('/send-verification-code', [VerificationController::class, 'sendVerificationCode']);

// Sequence fix route
Route::get('/fix-sequences', [SequenceFixController::class, 'fixSequences']);

// Request debug routes
Route::post('/debug-request', [RequestDebugController::class, 'debugRequest']);
Route::get('/debug-request-info', [RequestDebugController::class, 'testRequest']);

// Database recreate route
Route::get('/recreate-database', [DatabaseRecreateController::class, 'recreateDatabase']);

// Empty database route
Route::get('/create-empty-database', [EmptyDatabaseController::class, 'createEmptyDatabase']);

// Debug students route
Route::get('/debug-students', [DebugStudentsController::class, 'debugStudents']);

// Force clear all data route
Route::get('/force-clear-all', [ForceClearController::class, 'forceClearAll']);

// On-demand verification routes
Route::post('/generate-new-verification-code', [OnDemandVerificationController::class, 'generateNewCode']);
Route::get('/get-latest-verification-code', [OnDemandVerificationController::class, 'getLatestCode']);

// Email test routes
Route::post('/test-email', [EmailTestController::class, 'testEmail']);
Route::get('/check-mail-config', [EmailTestController::class, 'checkMailConfig']);

// Database status route
Route::get('/database-status', [DatabaseStatusController::class, 'getDatabaseStatus']);
Route::put('/applications/{id}/status', [ApplicationController::class, 'updateStatus']);