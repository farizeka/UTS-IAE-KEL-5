<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

// Enrollment CRUD operations
Route::apiResource('enrollments', EnrollmentController::class);

// Get enrollments by user
Route::get('users/{userId}/enrollments', [EnrollmentController::class, 'getUserEnrollments']);

// Get enrollments by course
Route::get('courses/{courseId}/enrollments', [EnrollmentController::class, 'getCourseEnrollments']);

// Get enrollment statistics
Route::get('enrollments/statistics/summary', [EnrollmentController::class, 'getStatistics']);

// Bulk update enrollment status
Route::post('enrollments/bulk/update-status', [EnrollmentController::class, 'bulkUpdateStatus']);
