<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;
use function PHPUnit\Framework\logicalOr;

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
    public function webhook(Request $request): \Illuminate\Http\JsonResponse
    {
//        $webhook = $this->botsManager->bot()->commandsHandler(true);
        $webhook = Telegram::commandsHandler(true);

        if ($webhook->isType('callback_query')) {
            $data = $webhook->getRawResponse();
            $message = $webhook->getMessage();
            Log::error($message);

        }

        return response()->json(['status' => 'success']);
    }
}
