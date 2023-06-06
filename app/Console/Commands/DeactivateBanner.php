<?php

namespace App\Console\Commands;

use App\Models\Banner;
use Illuminate\Console\Command;

class DeactivateBanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banner:deactivate {id}';

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
        $bannerID = $this->argument('id');
        $banner = Banner::find($bannerID);
        if (!$bannerID){
            throw new \Exception("Banner not found");
        }
        $banner->active = false;
        $banner->save();
        $this->info('Banner with id ' . $bannerID . ' is deactivated');
    }
}
