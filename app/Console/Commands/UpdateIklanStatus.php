<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengiklanModel;
use Carbon\Carbon;

class UpdateIklanStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:iklanstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of Iklan based on the tanggal_keluar';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pengiklanSelesai = PengiklanModel::where('tanggal_keluar', '<', Carbon::today())
                                        ->where('status', '!=', 'selesai')
                                        ->update(['status' => 'selesai']);

        $pengiklanBerjalan = PengiklanModel::where('tanggal_masuk', '=', Carbon::today())
                                        ->where('status', '=', 'menunggu')
                                        ->update(['status' => 'berjalan']);

        if ($pengiklanSelesai || $pengiklanBerjalan) {
            $this->info('The pengiklan statuses have been updated successfully.');
        } else {
            $this->error('No pengiklan status updated.');
        }

    }

}
