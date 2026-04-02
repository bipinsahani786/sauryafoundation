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
     * Distribute commissions for a given quiz enrollment.
     */
    public function distribute(QuizEnrollment $enrollment)
    {
        $student = $enrollment->student;
        $quiz = $enrollment->quiz;
        $paidAmount = $enrollment->paid_amount;

        if ($paidAmount <= 0) return;

        DB::transaction(function () use ($student, $quiz, $paidAmount, $enrollment) {
            // 1. Teacher Commission
            // Logic: Quiz belongs to a teacher (the one who created it)
            $teacher = $quiz->user; // Assuming Quiz has a user_id for the creator

            if ($teacher && $teacher->isTeacher() && $teacher->commission_percent > 0) {
                $teacherAmount = ($paidAmount * $teacher->commission_percent) / 100;
                
                if ($teacherAmount > 0) {
                    $teacher->deposit(
                        $teacherAmount, 
                        QuizEnrollment::class, 
                        $enrollment->id, 
                        "Commission for Student: {$student->name} | Quiz: {$quiz->title}"
                    );

                    Commission::create([
                        'user_id' => $teacher->id,
                        'student_id' => $student->id,
                        'quiz_enrollment_id' => $enrollment->id,
                        'quiz_price' => $paidAmount,
                        'commission_percent' => $teacher->commission_percent,
                        'amount' => $teacherAmount,
                        'type' => 'teacher',
                        'description' => "Teacher Payout: {$teacher->commission_percent}% of ₹{$paidAmount}"
                    ]);

                    // 2. Sales Agent Commission (if Teacher was referred by one)
                    $salesAgent = $teacher->referrer;
                    if ($salesAgent && $salesAgent->isSalesAgent() && $salesAgent->commission_percent > 0) {
                        $agentAmount = ($paidAmount * $salesAgent->commission_percent) / 100;

                        if ($agentAmount > 0) {
                            $salesAgent->deposit(
                                $agentAmount, 
                                QuizEnrollment::class, 
                                $enrollment->id, 
                                "Sub-Commission | Teacher: {$teacher->name} | Student: {$student->name}"
                            );

                            Commission::create([
                                'user_id' => $salesAgent->id,
                                'student_id' => $student->id,
                                'quiz_enrollment_id' => $enrollment->id,
                                'quiz_price' => $paidAmount,
                                'commission_percent' => $salesAgent->commission_percent,
                                'amount' => $agentAmount,
                                'type' => 'sales_agent',
                                'description' => "Agent Payout: {$salesAgent->commission_percent}% of ₹{$paidAmount} (Teacher Referral)"
                            ]);
                        }
                    }
                }
            }
        });
    }
}
