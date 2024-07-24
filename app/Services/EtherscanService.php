<?php

namespace App\Services;

use GuzzleHttp\Client;

class EtherscanService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.etherscan.io/api']);
        $this->apiKey = env('ETHERSCAN_API_KEY');
    }

    public function getRecentTransactions($address)
    {
        $response = $this->client->get('', [
            'query' => [
                'module' => 'account',
                'action' => 'txlist',
                'address' => $address,
                'startblock' => 0,
                'endblock' => 99999999,
                'sort' => 'desc',
                'apikey' => $this->apiKey,
            ]
        ]);

        $transactions = json_decode($response->getBody()->getContents(), true);

        return $transactions['result'];
    }

    public function getRecentTransactionsLast15Minutes($address): array
    {
        $allTransactions = $this->getRecentTransactions($address);
        $recentTransactions = [];
        $fifteenMinutesAgo = time() - 900;
        foreach ($allTransactions as $transaction) {
            if ($transaction['timeStamp'] >= $fifteenMinutesAgo) {
                $recentTransactions[] = $transaction;
            }
        }

        return $recentTransactions;
    }
}
