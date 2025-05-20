<?php
echo "<b>Lesson 15</b><br><br>";


echo "<h3>1. array_map – увеличить каждое число на 10</h3>";
$numbers = [5, 10, 15, 20];
$increased = array_map(function($num) {
    return $num + 10;
}, $numbers);
print_r($increased);


echo "<h3>2. array_filter – оставить только четные числа</h3>";
$filtered = array_filter($numbers, function($num) {
    return $num % 2 === 0;
});
print_r($filtered);


echo "<h3>3. array_chunk – разбить массив на части</h3>";
$letters = ['a', 'b', 'c', 'd', 'e', 'f'];
$chunks = array_chunk($letters, 2);
print_r($chunks);


echo "<h3>4. in_array – проверка наличия элемента</h3>";
$fruits = ['apple', 'banana', 'orange'];
if (in_array('banana', $fruits)) {
    echo "Банан найден! 🍌";
} else {
    echo "Банан не найден!";
}


echo "<h3>5. foreach – вывод имени и фамилии студентов</h3>";
$students = [
    ['name' => 'Иван', 'surname' => 'Иванов', 'age' => 20],
    ['name' => 'Мария', 'surname' => 'Петрова', 'age' => 22],
    ['name' => 'Алексей', 'surname' => 'Сидоров', 'age' => 19],
];

foreach ($students as $student) {
    echo $student['name'] . ' ' . $student['surname'] . "<br>";
}


echo "<h3>6. Фильтрация студентов по возрасту (>= 21)</h3>";
$adultStudents = array_filter($students, function($student) {
    return $student['age'] >= 21;
});
print_r($adultStudents[1]);


echo "<h3>7. implode и explode</h3>";
$langs = ['PHP', 'JavaScript', 'Python'];
$str = implode(', ', $langs);
echo "Строка: $str<br>";

$newLangs = explode(', ', $str);
print_r($newLangs);


echo "<h3>8. json_encode и json_decode</h3>";
$data = [
    'title' => 'Сайт под ключ',
    'price' => 1200,
    'features' => ['адаптивность', 'скорость', 'SEO']
];

$json = json_encode($data, JSON_UNESCAPED_UNICODE);
echo "JSON: $json<br>";

$decoded = json_decode($json, true);
print_r($decoded);


echo "<h3>*. сортировка пузырьком</h3>";
function bubbleSort(array $arr): array {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        // Флаг для проверки, были ли перестановки в текущей итерации
        $swapped = false;
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                // Меняем элементы местами
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $swapped = true;
            }
        }
        // Если за проход не было ни одной перестановки — массив отсортирован
        if (!$swapped) {
            break;
        }
    }
    return $arr;
}

// Пример использования:
$array = [64, 34, 25, 12, 22, 11, 90];
$sorted = bubbleSort($array);
print_r($array);
echo ('<br>Стало <br>');
print_r($sorted);
echo ('<br>Перевернули <br>');
$reverse_sort = array_reverse($sorted);
print_r($reverse_sort);