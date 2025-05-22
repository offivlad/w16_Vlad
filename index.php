<?php
echo '<pre>';
/* Диапозоны
[a-z]   // Любая буква от 'a' до 'z'
[а-я]   // Любая буква от 'А' до 'Я'
[0-9]   // Любая цифра от '0' до '9'
[A-Za-zа-яА-ЯЁё0-9] // Любая буква или цифра
*/

/* Квантификаторы
* Ноль или более повторений подряд
a+b - + Одно и более повторений подряд
? Ноль или более повторений подряд
\d{3} точное колличество повторений - три раза
\d{3,} - минимум 3 раза
\d{6, 7} - от 3 до 7 раз
*/

/* Исключения в диапозонах
[^a-z]   // Любая буква кроме от 'a' до 'z'
[^0-9]   // Любая цифра кроме от '0' до '9'
*/

/* Якоря
^ - начало строки
$ - конец строк
\b - Граница слова
\B - Не граница слова

/Hello/
/^Hello/
/World$/
/\bworld\b/
*/

/* Модификаторы
i - игнорирование регистра
m - многострочный режим
s - Точка соответствует всем символам
x - Разрешенны комментарии и пробелы

/Hello/i
*/

/* Условия
/(hello)+/i
/(hello){1, 3}/i*/
$url = 'https://catalog.onliner.by/';
$matches = [];
preg_match('/(https:\/\/)?(catalog\..+)/', $url, $matches);
var_dump($matches);



/* Жадный и не жадный поиск
'<.+>' - Жадный
'<.+?>' - не жадный
*/

//preg_match
$text = "Hello world";
if (preg_match('/world/', $text)) {
    echo "Совпадение найдено!";
}

//preg_match_all
$text = "apple banana apple orange";
preg_match_all('/apple/', $text, $matches);
print_r($matches);

//preg_replace
$product_name = 'Телефон Iphone';
$description = 'Солидный, презентабельный, стильный, эксклюзивный. #NAME#';
var_dump(preg_replace('/#NAME#/', $product_name, $description));

//preg_split
$text = "apple, banana, orange";
$result = preg_split('/,\s*/', $text);
print_r($result);

function validateEmail(string $email): bool
{
    return (bool)preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/', $email);
}

function validateEmail2(string $email): bool
{
    return (bool)preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
}


var_dump(validateEmail('test@test.com'));
echo '<br>';
var_dump(validateEmail('test_test_test'));


$array = [[1,3], [9,10], [2,7]];

print_r($array);

function Otrzok( array $otrez_array) : array
{

    if (empty($otrez_array)) {
        return [];
    }

    usort($otrez_array, function ($a, $b) {
        return $a <=> $b;
    });

    $newarray = [];
    $first = $otrez_array[0];

    foreach ($otrez_array as $item) {
        if ($item[0] <= $first[1]) {
            $first[1] = max($first[1], $item[1]);
        } else {
        $newarray[] = $first;
        $first = $item;

        }
    }

    $newarray[] = $first;
    return $newarray;
}

print_r(Otrzok($array));