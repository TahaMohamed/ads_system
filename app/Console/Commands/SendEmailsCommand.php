<?php

namespace App\Console\Commands;

use App\Mail\ReminderAdMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailsCommand extends Command
{
    protected $signature = 'mail:send';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()
            ->whereHas('ads', fn($q) => $q->whereDate('ads.start_at',now()->addDay()->format('Y-m-d')))
            ->with(['ads' => fn($q) => $q->whereDate('ads.start_at',now()->addDay()->format('Y-m-d'))])
            ->chunk(200,function ($users){
                foreach ($users as $user) {
                    Mail::to($user)->send(new ReminderAdMail($user, $user->ads));
                }
            });
    }
}
