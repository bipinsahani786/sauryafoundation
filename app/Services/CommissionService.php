<?php

namespace App\Services;

use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizEnrollment;
use App\Models\Commission;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    /**
     * Distribute commissions for a given enrollment (Quiz or Course).
     */
    public function distribute($enrollment, string $type = 'quiz', ?User $student = null)
    {
        if ($type === 'quiz') {
            $student = $enrollment->student;
            $asset = $enrollment->quiz;
            $paidAmount = $enrollment->paid_amount;
            $quizEnrollmentId = $enrollment->id;
            $courseId = null;
            $assetTitle = $asset->title;
            $assetTypeLabel = "Quiz";
        } else {
            // For Courses, $enrollment is the Course model
            $student = $student ?? auth()->user();
            $asset = $enrollment; // The Course object
            $paidAmount = $asset->price;
            $quizEnrollmentId = null;
            $courseId = $asset->id;
            $assetTitle = $asset->title;
            $assetTypeLabel = "Course";
        }

        if ($paidAmount <= 0 || !$student) return;

        DB::transaction(function () use ($student, $asset, $paidAmount, $quizEnrollmentId, $courseId, $assetTitle, $assetTypeLabel) {
            $teacher = $student->teacher; // The student's assigned teacher (NOT the content creator)
            $superadmin = User::where('role', 'superadmin')->first();
            
            $remainingAmount = $paidAmount;

            // 1. Teacher Commission (Direct assigned teacher)
            if ($teacher && $teacher->isTeacher()) {
                $teacherPercent = $teacher->commission_percent ?? 0;
                $teacherAmount = ($paidAmount * $teacherPercent) / 100;
                
                if ($teacherAmount > 0) {
                    $teacher->deposit(
                        $teacherAmount, 
                        $quizEnrollmentId ? QuizEnrollment::class : \App\Models\Course::class, 
                        $quizEnrollmentId ?? $courseId, 
                        "Commission for Student: {$student->name} | {$assetTypeLabel}: {$assetTitle}"
                    );

                    Commission::create([
                        'user_id' => $teacher->id,
                        'student_id' => $student->id,
                        'quiz_enrollment_id' => $quizEnrollmentId,
                        'course_id' => $courseId,
                        'total_amount' => $paidAmount,
                        'commission_percent' => $teacherPercent,
                        'amount' => $teacherAmount,
                        'type' => 'teacher',
                        'description' => "Teacher Payout: {$teacherPercent}% of ₹{$paidAmount} for {$assetTypeLabel}"
                    ]);

                    $remainingAmount -= $teacherAmount;
                }

                // 2. Sales Agent Commission (Referrer of the Teacher)
                $salesAgent = $teacher->referrer;
                if ($salesAgent && $salesAgent->isSalesAgent()) {
                    $agentPercent = $salesAgent->commission_percent ?? 0;
                    $agentAmount = ($paidAmount * $agentPercent) / 100;

                    if ($agentAmount > 0) {
                        $salesAgent->deposit(
                            $agentAmount, 
                            $quizEnrollmentId ? QuizEnrollment::class : \App\Models\Course::class, 
                            $quizEnrollmentId ?? $courseId, 
                            "Sub-Commission | Teacher: {$teacher->name} | Student: {$student->name}"
                        );

                        Commission::create([
                            'user_id' => $salesAgent->id,
                            'student_id' => $student->id,
                            'quiz_enrollment_id' => $quizEnrollmentId,
                            'course_id' => $courseId,
                            'total_amount' => $paidAmount,
                            'commission_percent' => $agentPercent,
                            'amount' => $agentAmount,
                            'type' => 'sales_agent',
                            'description' => "Agent Payout: {$agentPercent}% of ₹{$paidAmount} (Teacher Referral: {$teacher->name})"
                        ]);

                        $remainingAmount -= $agentAmount;
                    }
                }
            }

            // 3. Admin Remainder (Platform Revenue)
            if ($superadmin && $remainingAmount > 0) {
                $superadmin->deposit(
                    $remainingAmount,
                    $quizEnrollmentId ? QuizEnrollment::class : \App\Models\Course::class,
                    $quizEnrollmentId ?? $courseId,
                    "Admin Net Profit | Student: {$student->name} | {$assetTypeLabel}: {$assetTitle}"
                );

                Commission::create([
                    'user_id' => $superadmin->id,
                    'student_id' => $student->id,
                    'quiz_enrollment_id' => $quizEnrollmentId,
                    'course_id' => $courseId,
                    'total_amount' => $paidAmount,
                    'commission_percent' => 0, // Remainder logic
                    'amount' => $remainingAmount,
                    'type' => 'admin',
                    'description' => "Admin Revenue: Net ₹{$remainingAmount} after Teacher/Agent payouts"
                ]);
            }
        });
    }
}
