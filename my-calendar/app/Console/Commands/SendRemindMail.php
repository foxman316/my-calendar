<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class SendRemindMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールを送ります';

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
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i:00');
        $reminds = Event::where('start','=', $now)->get();
        

        foreach($reminds as $remind){
            $calendar = Calendar::where('id','=', $remind->calendar_id)->get();
            $user = User::where('id','=', $calendar->user_id)->first();

            Log::info(
                Mail::raw($remind->description, function($message) use($remind, $user) {
                    $message->to($user->email)
                        ->from('mail_from@example.com', 'メール送信元')
                        ->subject("We Reminder. You recall.");
                })
            );
        }
    }
}