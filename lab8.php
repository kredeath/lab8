<?php
// URL запиту
$url = "http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd";

// Отримання даних
$jsonData = file_get_contents($url);

// Перевірка отримання даних
if ($jsonData === FALSE) {
    die("Не вдалося отримати дані з API.");
}

// Перетворення JSON у PHP-масив
$data = json_decode($jsonData, true);

// Перевірка на коректність JSON
if ($data === NULL) {
    die("Помилка перетворення JSON.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дані персонажів</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Таблиця персонажів</h1>
    <table>
        <thead>
            <tr>
                <th>Ім'я</th>
                <th>Приналежність</th>
                <th>Звання</th>
                <th>Розташування</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Генерація рядків таблиці
            foreach ($data as $group) { // Переглядаємо групи (alliance, empire)
                foreach ($group as $characters) { // Переглядаємо кожного персонажа
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($characters['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($characters['affiliation']) . "</td>";
                    echo "<td>" . htmlspecialchars($characters['rank']) . "</td>";
                    echo "<td>" . htmlspecialchars($characters['location']) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
