<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function telegram(Request $request)
    {
        Log::info('Telegram auth payload:', $request->all());

        $data = $request->validate([
            'id' => 'required|numeric',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'username' => 'nullable|string',
            'photo_url' => 'nullable|string',
            'auth_date' => 'required|numeric',
            'hash' => 'required|string',
        ]);

        $check_hash = $data['hash'];
        unset($data['hash']);

        // 1. Сортируем по алфавиту
        ksort($data);

        // 2. Собираем строку
        $check_string = collect($data)->map(function ($val, $key) {
            return "$key=$val";
        })->implode("\n");

        // 3. Хэшируем через HMAC-SHA256 с токеном Telegram
        $secret_key = hash('sha256', env('TELEGRAM_BOT_TOKEN'), true);
        $calculated_hash = hash_hmac('sha256', $check_string, $secret_key);

        if (!hash_equals($calculated_hash, $check_hash)) {
            Log::warning('Telegram auth failed: hash mismatch');
            return response()->json(['error' => 'Invalid Telegram data'], 403);
        }

        // 4. Пропускаем — создаём или обновляем пользователя
        $telegramId = $data['id'];
        $name = $data['first_name'] ?? 'Без имени';

        // Список админов
        $adminIds = ['123456789', '8125359027'];

        $user = User::updateOrCreate(
            ['telegram_id' => $telegramId],
            [
                'name' => $name,
                'is_admin' => in_array($telegramId, $adminIds),
            ]
        );

        return response()->json([
            'id' => $user->id,
            'telegram_id' => $user->telegram_id,
            'name' => $user->name,
            'balance' => $user->balance,
            'is_admin' => $user->is_admin,
        ]);
    }
}
