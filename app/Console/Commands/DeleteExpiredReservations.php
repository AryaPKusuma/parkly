<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;


class DeleteExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:delete-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    protected $signature = 'reservations:delete-expired';
    protected $description = 'Delete expired reservations';

    public function handle()
    {
        $expiredReservations = Reservation::where('status', 0)
            ->where('created_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->delete();
        }

        $this->info('Expired reservations have been deleted.');
    }
}
