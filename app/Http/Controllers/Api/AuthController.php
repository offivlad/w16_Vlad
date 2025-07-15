<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function telegram(Request $request)
    {
        $data = $request->validate([
            'telegram_id' => 'required|string',
            'name' => 'required|string',
        ]);

        // Список telegram_id админов — замени на свои реальные ID
        $adminIds = ['123456789', '987654321'];

        $user = User::updateOrCreate(
            ['telegram_id' => $data['telegram_id']],
            [
                'name' => $data['name'],
                'is_admin' => in_array($data['telegram_id'], $adminIds),
            ]
        );

        return response()->json([
            'id' => $user->id,
            'telegram_id' => $user->telegram_id,
            'name' => $user->name,
            'balance' => $user->balance,
            'is_admin' => $user->is_admin,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }
}
