<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class SyncNationalBank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:national-bank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load exchange rates from national bank';

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
        try {
            $response = Http::get('https://nationalbank.kz/rss/rates_all.xml');
            $XMLResponse = new \SimpleXMLElement($response);
            foreach($XMLResponse->channel->item as $item) {
                ExchangeRate::updateOrCreate(
                    ['title' => $item->title],
                    ['value' => $item->description]
                );
            }
        } catch(\HttpResponseException $e) {
            echo $e->getMessage();
            return 1;
        }
        echo 'success';
        return 0;

    }
}
