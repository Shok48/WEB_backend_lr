<?php

session_start();
require 'db.php';

function valudateFullName($value) {
    return preg_match('/^[a-zA-Zа-яА-ЯёЁ]+$/u', $value);
}

function validatePhone($value) {
    $phone = preg_replace('/\D/', '', $value);
    if (strlen($phone) === 11 && $phone[0] === '7') {
        $phone = '+' . $phone;
    }
    return preg_match_all('/^\+7\d{10}$/', $phone);
}

function validateEmail($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'surname' => $_POST['photographerSurname'],
        'name' => $_POST['photographerName'] ?? '',
        'patronymic' => $_POST['photographerPatronymic'] ?? '',
        'phone' => $_POST['photographerPhone'] ?? '',
        'email' => $_POST['photographerEmail'] ?? '',
        'specialization' => $_POST['protogragpherSpecialization'] ?? ''
    ];

    // foreach ($formData as $key => $value) {
    //     echo ucfirst($key) . ": " . htmlspecialchars($value) . "<br>";
    // }

    $validationRules = [
        'surname' => [
            'empty' => 'Фамилия обязательна',
            'validate' => ['func' => 'validateFullName', 'msg' => 'Фамилия должна содержать только буквы']
        ],
        'name' => [
            'empty' => 'Имя обязательно',
            'validate' => ['func' => 'valudateFullName', 'msg' => 'Имя должна содержать только буквы']
        ],
        'patronymic' => [
            'empty' => 'Отчество обязательно',
            'validate' => ['func' => 'valudateFullName', 'msg' => 'Отчество должно содержать только буквы']
        ],
        'phone' => [
            'empty' => 'Телефон обязателен',
            'validate' => ['func' => 'validatePhone', 'msg' => 'Неверный формат телефона']
        ],
        'email' => [
            'empty' => 'Email обязателен',
            'validate' => ['func' => 'validateEmail', 'msg' => 'Неверный формат email']
        ],
        'specialization' => [
            'empty' => 'Специализация обазательна'
        ]
    ];

    foreach ($validationRules as $field => $rules) {
        if (empty($formData[$field])) {
            $errors[$field] = [$rules['empty']];
        } elseif (
            isset($rules['validate'])
            && function_exists($rules['validate']['func'])
        ) {
            if (!$rules['validate']['func']($formData[$field])) {
                $errors[$field] = $rules['validate']['msg'];
            }
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO Photographers (surname, name, patronymic, phone, email, specialization) VALUES (:surname, :name, :patronymic, :phone, :email, :specialization)");
        $stmt->execute($formData);
        
        // $dataFile = 'photographers.csv';
        
        // if (($file = fopen($dataFile, 'a')) !== false) {
        //     fputcsv($file, $formData);
        //     fclose($file);
        // }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;
    }

    header('Location: index.php');
    exit;
}

?>