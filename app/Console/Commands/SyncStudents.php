<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Repositories\LMSRepository;

class SyncStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 
     */
    
    protected $signature = 'create:create-students';

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
        $students = User::where('role','student')->where('lms_user_id', null)->where('status','pending')->get();
        $token = LMSRepository::getToken();
    
        foreach ($students as $student) {     
             $lms_id = LMSRepository::createUser($token, $student);
             $student->lms_user_id = $lms_id;
             $student->status = 'approved';
             $student->update();
        }
        $this->info("Student updated successfully.");
    }
}
