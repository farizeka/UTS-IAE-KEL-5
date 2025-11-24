<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    /**
     * Get all enrollments with pagination
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $status = $request->get('status');
        $userId = $request->get('user_id');
        $courseId = $request->get('course_id');

        $query = Enrollment::with('user');

        if ($status) {
            $query->where('status', $status);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        $enrollments = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $enrollments,
        ]);
    }

    /**
     * Get a specific enrollment
     */
    public function show(Enrollment $enrollment): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $enrollment->load('user'),
        ]);
    }

    /**
     * Create a new enrollment
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer',
            'status' => 'nullable|in:pending,active,completed,cancelled',
            'grade' => 'nullable|numeric|between:0,100',
            'notes' => 'nullable|string',
        ]);

        // Check if enrollment already exists
        $existingEnrollment = Enrollment::where('user_id', $validated['user_id'])
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existingEnrollment) {
            throw ValidationException::withMessages([
                'enrollment' => 'User is already enrolled in this course.',
            ]);
        }

        $enrollment = Enrollment::create([
            'user_id' => $validated['user_id'],
            'course_id' => $validated['course_id'],
            'status' => $validated['status'] ?? 'pending',
            'grade' => $validated['grade'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Enrollment created successfully.',
            'data' => $enrollment->load('user'),
        ], 201);
    }

    /**
     * Update an enrollment
     */
    public function update(Request $request, Enrollment $enrollment): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'nullable|in:pending,active,completed,cancelled',
            'grade' => 'nullable|numeric|between:0,100',
            'notes' => 'nullable|string',
            'completed_at' => 'nullable|date',
        ]);

        $enrollment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Enrollment updated successfully.',
            'data' => $enrollment->load('user'),
        ]);
    }

    /**
     * Delete an enrollment
     */
    public function destroy(Enrollment $enrollment): JsonResponse
    {
        $enrollment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enrollment deleted successfully.',
        ]);
    }

    /**
     * Get enrollments for a specific user
     */
    public function getUserEnrollments(Request $request, $userId): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $status = $request->get('status');

        $query = Enrollment::where('user_id', $userId);

        if ($status) {
            $query->where('status', $status);
        }

        $enrollments = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $enrollments,
        ]);
    }

    /**
     * Get enrollments for a specific course
     */
    public function getCourseEnrollments(Request $request, $courseId): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $status = $request->get('status');

        $query = Enrollment::where('course_id', $courseId);

        if ($status) {
            $query->where('status', $status);
        }

        $enrollments = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $enrollments,
        ]);
    }

    /**
     * Get enrollment statistics
     */
    public function getStatistics(): JsonResponse
    {
        $totalEnrollments = Enrollment::count();
        $activeEnrollments = Enrollment::where('status', 'active')->count();
        $completedEnrollments = Enrollment::where('status', 'completed')->count();
        $pendingEnrollments = Enrollment::where('status', 'pending')->count();
        $cancelledEnrollments = Enrollment::where('status', 'cancelled')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $totalEnrollments,
                'active' => $activeEnrollments,
                'completed' => $completedEnrollments,
                'pending' => $pendingEnrollments,
                'cancelled' => $cancelledEnrollments,
            ],
        ]);
    }

    /**
     * Bulk update enrollment status
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'enrollment_ids' => 'required|array',
            'enrollment_ids.*' => 'integer',
            'status' => 'required|in:pending,active,completed,cancelled',
        ]);

        $updated = Enrollment::whereIn('id', $validated['enrollment_ids'])
            ->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => "{$updated} enrollments updated successfully.",
            'updated_count' => $updated,
        ]);
    }
}
