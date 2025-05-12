<?php
echo "<b>Lesson 13</b><br><br>";

function sayHello() {
    echo "Привет!<br>";
}
sayHello();

function sum($a, $b) {
    return $a + $b;
}

$result = sum(5, 3);
echo $result;
var_dump($result);
function greet($name = "Гость") {
    echo "Привет, $name!";
}

greet();
greet("Влад");

$anonist = function ($a) {
    return $a * 2;
};

echo $anonist(2);

$anonistFn = fn($a) => $a * 2;

echo $anonistFn(2);

echo "<br><br>";

$data = [
    "user" => [
        "name" => "Влад",
        "contacts" => [
            "email" => "vlad@example.com",
            "phone" => "123-456"
        ]
    ],
    "roles" => ["admin", "editor"],
    "active" => true
];

function recursivePrint($array, $level = 0) {
    foreach ($array as $key => $value) {
        echo str_repeat("  ", $level); // отступ для читаемости
        if (is_array($value)) {
            echo "$key:\n";
            recursivePrint($value, $level + 1);
        } else {
            echo "$key: $value\n";
        }
    }
}

// Вызов функции
recursivePrint($data);
print_r ($data);

function myrecuseve($array) {
    foreach ($array as $key => $value) {

        if (is_array($value)){
            echo "$key:\n";
            myrecuseve($value);
        }else {
            echo "$key: $value\n";
        }

    }

}


myrecuseve($data);

$numbers = [1, 2, 3, 4, 5];
$arrayRes = array_map(function ($number) {
    return $number + 1;
}, $numbers);

print_r($arrayRes);

echo "<br><br>";

$text = "Привет, мир!";

// mb_strlen — правильная длина строки с UTF-8
echo "Длина строки: " . mb_strlen($text, 'UTF-8') . "\n";

// mb_strtoupper — перевод в верхний регистр (UTF-8)
echo "Верхний регистр: " . mb_strtoupper($text, 'UTF-8') . "\n";

// mb_strtolower — перевод в нижний регистр (UTF-8)
echo "Нижний регистр: " . mb_strtolower($text, 'UTF-8') . "\n";

echo "<br><br>";

$fruits = ["яблоко", "банан"];

// array_push — добавляет элемент(ы) в конец массива
array_push($fruits, "груша", "апельсин");
print_r($fruits); // ["яблоко", "банан", "груша", "апельсин"]

// array_pop — удаляет последний элемент массива
$last = array_pop($fruits);
echo "Удалённый элемент: $last\n"; // апельсин
print_r($fruits); // ["яблоко", "банан", "груша"]

// array_merge — объединяет два массива
$vegetables = ["морковь", "огурец"];
$merged = array_merge($fruits, $vegetables);
print_r($merged); // ["яблоко", "банан", "груша", "морковь", "огурец"]

echo "<br><br>";

$data = [
    "Привет",
    123,
    45.67,
    ["a", "b"],
    true
];


foreach ($data as $item) {
    if (is_string($item)) {
        echo "Строка: $item\n";
    } elseif (is_numeric($item)) {
        echo "Число: $item\n";
    } elseif (is_array($item)) {
        echo "Массив: ";
        print_r($item);
    } else {
        echo "Другой тип: ";
        var_dump($item);
    }
}

echo "<br><br>";

$number = -7.8;

echo "abs(): " . abs($number) . "<br>";         // Абсолютное значение: 7.8
echo "sqrt(): " . sqrt(16) . "<br>";            // Квадратный корень: 4
echo "round(): " . round($number) . "<br>";     // Округление по математическим правилам: -8
echo "ceil(): " . ceil($number) . "<br>";       // Округление вверх: -7
echo "floor(): " . floor($number) . "<br>";     // Округление вниз: -8

// Генерация случайных чисел
echo "rand(1, 100): " . rand(1, 100) . "<br>";       // Случайное число от 1 до 100 (менее надёжное)
echo "mt_rand(1, 100): " . mt_rand(1, 100) . "<br>"; // Более надёжное случайное число от 1 до 100

echo "<br><br>";

echo "Текущая дата: " . date("d.m.Y") . "<br>";           // 13.05.2025
echo "Текущая дата (другой формат): " . date("Y-m-d") . "<br>"; // 2025-05-13
echo "Текущее время: " . date("H:i:s") . "<br>";          // 14:23:45
echo "День недели: " . date("l") . "<br>";                // Tuesday
echo "Дата и время полностью: " . date("d.m.Y H:i:s") . "<br>"; // 13.05.2025 14:23:45