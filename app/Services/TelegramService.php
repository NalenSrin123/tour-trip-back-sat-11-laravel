<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    /**
     * Send a message to the configured Telegram chat using the Bot API.
     *
     * @param string $message The message text to send.
     * @return bool True if Telegram accepted the message, false otherwise.
     */
    public function sendMessage(string $message): bool
    {
        $token = config('services.telegram_bot_token');
        $chatId = config('services.telegram_chat_id');

        // Do not attempt a request if the env values are missing.
        if (empty($token) || empty($chatId)) {
            return false;
        }

        $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        return $response->successful();
    }

    /**
     * Build and send the admin login OTP message to Telegram.
     *
     * @param string $otp The 6-digit OTP to send.
     * @return bool True if sent successfully.
     */
    public function sendOtp(string $otp): bool
    {
        $message = "Your Admin Login OTP is: {$otp}\n\nThis OTP will expire in 5 minutes.";

        return $this->sendMessage($message);
    }
}
