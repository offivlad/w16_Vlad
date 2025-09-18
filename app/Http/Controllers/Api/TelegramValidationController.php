<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TelegramValidationController extends Controller
{
    private $botToken = '8125359027:AAFdnVzBSX8AHiqnVM-9hHc-sRCz60gciwA';

    public function validateInitData(Request $request)
    {
        $initData = $request->input('init_data');
        if (!$initData) {
            return response()->json(['valid' => false, 'error' => 'init_data отсутствует']);
        }

        parse_str($initData, $dataArray);
        if (!isset($dataArray['hash'])) {
            return response()->json(['valid' => false, 'error' => 'hash отсутствует']);
        }

        $hash = $dataArray['hash'];
        unset($dataArray['hash']);

        ksort($dataArray);

        $dataCheckString = '';
        foreach ($dataArray as $key => $value) {
            $dataCheckString .= $key . '=' . $value . "\n";
        }
        $dataCheckString = rtrim($dataCheckString, "\n");

        $secretKey = hash_hmac('sha256', 'WebAppData', $this->botToken, true);
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        if (!hash_equals($calculatedHash, $hash)) {
            return response()->json(['valid' => false, 'error' => 'Неверная подпись']);
        }

        if (isset($dataArray['auth_date']) && (time() - intval($dataArray['auth_date'])) > 86400) {
            return response()->json(['valid' => false, 'error' => 'Данные устарели']);
        }

        $user = isset($dataArray['user']) ? json_decode($dataArray['user'], true) : null;
        if (!$user) {
            return response()->json(['valid' => false, 'error' => 'Данные пользователя отсутствуют']);
        }

        return response()->json(['valid' => true, 'user' => $user]);
    }
}
