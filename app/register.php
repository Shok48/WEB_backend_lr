<?php
session_start();

function validateName($name) {
    return preg_match('/^[a-zA-Zа-яА-ЯёЁ]+$/u', $name);
}

function validatePhone($phone) {
    $phone = preg_replace('/\D/', '', $phone);
    if (strlen($phone) === 11 && $phone[0] === '7') {
        $phone = '+' . $phone;
    }
    return preg_match('/^\+7\d{10}$/', $phone);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateDate($date) {
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    return $dateObj && $dateObj >= new DateTime('tomorrow');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'userSurname' => trim($_POST['userSurname']),
        'userName' => trim($_POST['userName']),
        'userPatronymic' => trim($_POST['userPatronymic']),
        'userPhone' => trim($_POST['userPhone']),
        'userEmail' => trim($_POST['userEmail']),
        'photoType' => trim($_POST['photoType']),
        'photoDate' => trim($_POST['photoDate']),
        'photoTime' => trim($_POST['photoTime']),
        'comments' => isset($_POST['comments']) ? trim($_POST['comments']) : '',
    ];

    $validationRules = [
        'userSurname' => [
            'empty' => 'Фамилия обязательна',
            'validate' => ['func' => 'validateName', 'msg' => 'Фамилия должна содержать только буквы']
        ],
        'userName' => [
            'empty' => 'Имя обязательно',
            'validate' => ['func' => 'validateName', 'msg' => 'Имя должно содержать только буквы']
        ],
        'userPatronymic' => [
            'empty' => 'Отчество обязательно',
            'validate' => ['func' => 'validateName', 'msg' => 'Отчество должно содержать только буквы']
        ],
        'userPhone' => [
            'empty' => 'Телефон обязателен',
            'validate' => ['func' => 'validatePhone', 'msg' => 'Неверный формат телефона']
        ],
        'userEmail' => [
            'empty' => 'Email обязателен',
            'validate' => ['func' => 'validateEmail', 'msg' => 'Неверный формат email']
        ],
        'photoType' => [
            'empty' => 'Тип фото обязателен'
        ],
        'photoDate' => [
            'empty' => 'Дата фото обязательна',
            'validate' => ['func' => 'validateDate', 'msg' => 'Дата фото должна быть не раньше завтра']
        ],
        'photoTime' => [
            'empty' => 'Время фото обязательно'
        ]
    ];

    foreach ($validationRules as $field => $rules) {
        if (empty($formData[$field])) {
            $errors[$field] = $rules['empty'];
        } elseif (isset($rules['validate']) && function_exists($rules['validate']['func'])) {
            if (!$rules['validate']['func']($formData[$field])) {
                $errors[$field] = $rules['validate']['msg'];
            }
        }
    }

    if (empty($errors)) {
        $dataFile = 'data.csv';
        
        if (($file = fopen($dataFile, 'a')) !== false) {
            fputcsv($file, $formData);
            fclose($file);
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;
    }
    
    header('Location: index.php');
    exit();
}

?>