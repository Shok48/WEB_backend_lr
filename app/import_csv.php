<?php

require 'db.php';

$file = fopen("photographers.csv", "r");

fgetcsv($file);

while (($data = fgetcsv($file, 1000, ",")) !== false) {
    $stmt = $pdo->prepare("INSERT INTO Photographers (surname, name, patronymic, phone, email, specialization) values (?, ?, ?, ?, ?, ?)");

    $stmt->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5]]);
}

fclose($file);

?>