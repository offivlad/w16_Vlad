<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Универсальный метод валидации с обработкой ошибок
     */
    protected function validateRequest(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return null;
    }

    // Получить список всех пользователей (только админ)
    public function users()
    {
        $users = User::all(['id', 'telegram_id', 'name', 'balance', 'is_admin']);
        return response()->json($users);
    }

    // Изменить баланс пользователя (только админ)
    public function updateBalance(Request $request, $id)
    {
        $errorResponse = $this->validateRequest($request, [
            'balance' => 'required|integer|min:0',
        ]);
        if ($errorResponse) {
            return $errorResponse;
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->balance = $request->balance;
        $user->save();

        return response()->json($user);
    }

    // Создать пользователя (только админ)
    public function createUser(Request $request)
    {
        $errorResponse = $this->validateRequest($request, [
            'telegram_id' => 'required|string|unique:users,telegram_id',
            'name' => 'required|string',
            'balance' => 'integer|min:0',
            'is_admin' => 'boolean',
        ]);
        if ($errorResponse) {
            return $errorResponse;
        }

        $user = User::create([
            'telegram_id' => $request->telegram_id,
            'name' => $request->name,
            'balance' => $request->balance ?? 0,
            'is_admin' => $request->is_admin ?? false,
        ]);

        return response()->json($user, 201);
    }

    // Обновить данные пользователя (только админ)
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $errorResponse = $this->validateRequest($request, [
            'telegram_id' => 'string|unique:users,telegram_id,' . $id,
            'name' => 'string',
            'balance' => 'integer|min:0',
            'is_admin' => 'boolean',
        ]);
        if ($errorResponse) {
            return $errorResponse;
        }

        $user->update($request->only(['telegram_id', 'name', 'balance', 'is_admin']));

        return response()->json($user);
    }
}
