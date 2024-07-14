<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class WebHookController extends Controller
{
    private BotsManager $botsManager;

    public function __construct(BotsManager $botsManager)
    {
        $this->botsManager = $botsManager;
    }

    /**
     * Handle the incoming request.
     * @throws TelegramSDKException
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
//        $webhook = $this->botsManager->bot()->commandsHandler(true);
        $update = Telegram::commandsHandler(true);
        Log::info('Webhook Status: OK');

        return response()->json(['status' => 'success']);
    }
}
