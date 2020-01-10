<?php

namespace App\Console\Commands;

use App\Holiday;
use App\Mail\emailHRHolidayRequestsSubmitted;
use Illuminate\Console\Command;
use App\Traits\MakeTime;
use Illuminate\Support\Facades\Mail;

class sendEmailToHR extends Command
{
    use MakeTime;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:HR';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email HR if somebody has put in a holiday request';

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

        // get holiday requests added within the last 15 minutes
        $holidays = Holiday::whereIn('booked', ['Request sent', 'Half Request sent'])
            ->where('created_at', '<=', \Carbon\Carbon::now()->subMinutes(15)->toDateTimeString())
            ->whereNull('stage')
            ->get();
        if (count($holidays) > 0) {
            Mail::to('humanres321@gmail.com')->send(new emailHRHolidayRequestsSubmitted());
            $x++;
        }

        $this->info('Sent out: ' . $x);
        $this->comment('Sent in ' . $this->makeTime($time_start));
    }
}
