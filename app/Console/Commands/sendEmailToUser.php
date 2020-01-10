<?php

namespace App\Console\Commands;

use App\Holiday;
use App\User;
use App\Mail\emailUserHolidayRequestsUpdated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Traits\MakeTime;
use Carbon\Carbon;

class sendEmailToUser extends Command
{
    use MakeTime;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email user if their holiday request/s has been accepted/declined in the last 15 minutes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '6024M');
        $time_start = microtime(true);
        $x = 0;

        // get holiday requests updated within the last 15 minutes
        $holidays = Holiday::whereIn('stage', ['Accepted', 'Declined'])
            ->where('updated_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())
            ->get();

        if (count($holidays) > 0) {
             // get unique users
            $userIds = $holidays->pluck('user_id')->unique();
            foreach ($userIds as $userId) {
                // find user
                $user = User::findOrFail($userId);
                Mail::to($user->email)->send(new emailUserHolidayRequestsUpdated());
                $x++;
            }
            $this->info('Sent out: ' . $x);
            $this->comment('Sent in ' . $this->makeTime($time_start));
        } else {
            $this->comment('No holiday requests updated in the last 15 minutes');
        }
    }
}
