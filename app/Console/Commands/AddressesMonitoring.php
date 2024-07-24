<?php

namespace App\Console\Commands;

use App\Models\CryptoAddress;
use App\Services\EtherscanService;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Console\Command;

class AddressesMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addresses:monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitoring crypto addresses';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $addresses = CryptoAddress::all();
        foreach ($addresses as $address) {
            if ($address->currency == 'ethereum')
            {
                $transactions = (new \App\Services\EtherscanService)->getRecentTransactionsLast15Minutes($address->address);
                foreach ($transactions as $transaction)
                {
                    Telegraph::chat($address->chat_id)
                        ->message('Увага! З адреси '.$transaction['from'].' на адресу '
                            .$transaction['to'].' було вереведено '.$transaction['value']/1e18.' ETH')
                        ->send();
                }
            }
        }
    }
}
