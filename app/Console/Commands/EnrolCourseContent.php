<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\PackageItem;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Console\Command;
use App\Repositories\LMSRepository;

class EnrolCourseContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 
     */

    protected $signature = 'create:enrol-course-content';

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
        $subscriptions = Subscription::where('enrolment_date','!=',null)->where('is_enrolled', true)->limit(1000)->get();
        $token = LMSRepository::getToken();
        foreach ($subscriptions as $subscription) {
            $student = User::find($subscription->student_id);
            $package = Package::where('class_id', $subscription->class_id)->first();
            $contents = PackageItem::where('package_id',$package->id)->where('lms_id','!=',null)->get();
            foreach ($contents as $content) {
                $response = LMSRepository::enrolToCourseContent($token, $student, $subscription, $content);
            }
        }
        $this->info("Student enrol successfully.");
    }
}
