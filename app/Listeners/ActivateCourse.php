<?php

namespace App\Listeners;

use App\Events\InvoicePaid;
use App\Models\Earning;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateCourse
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InvoicePaid $event): void
    {
        $invoice = $event->invoice;
        $user = $invoice->user;
        $course = $invoice->course;
        UserCourse::updateOrCreate(['user_id' => $user->id, 'course_id' => $course->id], [
            "user_id" => $user->id,
            "course_id" => $course->id,
            "status" => "active",
            "date_activated" => now()
        ]);

        $config = app('settings');
        if ($course->id == $config['registration_course'])
        {
            $ref = User::where('id', $user->ref_id)->first();
            if ($ref) {
                $ref_com = $this->percentage($course->amount, $config['referral_commission']);
                if ($config['referral_type'] == 'fixed')
                {
                    $ref_com = $config['referral_commission'];
                }
                Earning::updateOrCreate([
                    'user_id' => $ref->id,
                    'course_id' => $user->id,
                    'amount' => $ref_com,
                    'type' => 'referral_commission',
                ],[
                    'user_id' => $ref->id,
                    'course_id' => $user->id,
                    'amount' => $ref_com,
                    'type' => 'referral_commission',
                    'day' => date('Y-m-d'),
                ]);

                $upper_ref = $ref->ref_id;
                if (!is_null($upper_ref))
                {
                    $sub_ref_com = $this->percentage($course->amount, $config['sub_referral_commission']);
                    if ($config['referral_type'] == 'fixed')
                    {
                        $sub_ref_com = $config['sub_referral_commission'];
                    }
                    Earning::updateOrCreate([
                        'user_id' => $upper_ref,
                        'course_id' => $ref->id,
                        'amount' => $sub_ref_com,
                        'type' => 'referral_commission',
                    ],[
                        'user_id' => $upper_ref,
                        'course_id' => $ref->id,
                        'amount' => $sub_ref_com,
                        'type' => 'referral_commission',
                        'day' => date('Y-m-d'),
                    ]);
                }
            }

            if ($config['allow_cashback'] == 'true')
            {
                $cashback = $this->percentage($course->amount, $config['cashback_amount']);
                if ($config['cashback_type'] == "fixed")
                {
                    $cashback = $config['cashback_amount'];
                }
                Earning::updateOrCreate(['user_id' => $user->id, "course_id" => $course->id],[
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'amount' => $cashback,
                    "type" => 'task_commission',
                    "day" => date("Y-m-d")
                ]);
            }
        }
    }

    protected function percentage($amount, $num)
    {
        return $num/100 * $amount;
    }
}
