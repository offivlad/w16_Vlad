<?php
$botToken = '8125359027:AAFdnVzBSX8AHiqnVM-9hHc-sRCz60gciwA';

function sendMessage($chatId, $text, $replyMarkup = null) {
    global $botToken;
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
    ];
    if ($replyMarkup) {
        $data['reply_markup'] = json_encode($replyMarkup);
    }

    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?" . http_build_query($data));
}

$update = json_decode(file_get_contents('php://input'), true);

if (!isset($update['message']['chat']['id'])) {
    exit;
}

$chatId = $update['message']['chat']['id'];
$text = $update['message']['text'] ?? '';

$keyboard = [
    'keyboard' => [
        [
            [
                'text' => 'Открыть игру',
                'web_app' => [
                    'url' => 'https://test.swstest.site/webapp.html'
                ]
            ]
        ]
    ],
    'resize_keyboard' => true,
    'one_time_keyboard' => false
];

if ($text === '/start') {
    sendMessage($chatId, "Добро пожаловать! Нажмите кнопку, чтобы открыть игру.", $keyboard);
} else {
    sendMessage($chatId, "Нажмите кнопку для запуска игры", $keyboard);
}
