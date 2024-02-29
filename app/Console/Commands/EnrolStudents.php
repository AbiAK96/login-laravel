<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;
use App\Repositories\LMSRepository;

class EnrolStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 
     */

    protected $signature = 'create:enrol-students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = Subscription::where('enrolment_date', null)->where('is_enrolled', false)->limit(1000)->get();
        $token = LMSRepository::getToken();

        foreach ($subscriptions as $subscription) {
            $student = User::find($subscription->student_id);
            $response = LMSRepository::enrolToCourse($token, $student, $subscription);
            if ($response == null) {
                $subscription->enrolment_date = now();
                $subscription->is_enrolled = true;
                $subscription->update();
            }
        }
        $this->info("Student enrol successfully.");
    }
}
