<?php

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
    ];

    if (empty($formData['userSurname'])) {
        $errors['userSurname'] = 'Фамилия обязательна';
    }
    elseif (!validateName($formData['userSurname'])) {
        $errors['userSurname'] = 'Фамилия должна содержать только буквы';
    }
    
    if (empty($formData['userName'])) {
        $errors['userName'] = 'Имя обязательно';
    }
    elseif (!validateName($formData['userName'])) {
        $errors['userName'] = 'Имя должно содержать только буквы';
    }

    if (empty($formData['userPatronymic'])) {
        $errors['userPatronymic'] = 'Отчество обязательно';
    }
    elseif (!validateName($formData['userPatronymic'])) {
        $errors['userPatronymic'] = 'Отчество должно содержать только буквы';
    }

    if (empty($formData['userPhone'])) {
        $errors['userPhone'] = 'Телефон обязателен';
    }
    elseif (!validatePhone($formData['userPhone'])) {
        $errors['userPhone'] = 'Неверный формат телефона';
    }

    if (empty($formData['userEmail'])) {
        $errors['userEmail'] = 'Email обязателен';
    }
    elseif (!validateEmail($formData['userEmail'])) {
        $errors['userEmail'] = 'Неверный формат email';
    }
    
    if (empty($formData['photoType'])) {
        $errors['photoType'] = 'Тип фото обязателен';
    }

    if (empty($formData['photoDate'])) {
        $errors['photoDate'] = 'Дата фото обязательна';
    }
    elseif (!validateDate($formData['photoDate'])) {
        $errors['photoDate'] = 'Дата фото должна быть не раньше завтра';
    }

    if (empty($formData['photoTime'])) {
        $errors['photoTime'] = 'Время фото обязательно';
    }

    if (empty($errors)) {
        $dataFile = 'data.csv';
        
        if (($file = fopen($dataFile, 'a')) !== false) {
            fputcsv($file, $formData);
            fclose($file);
            $message = 'Заявка успешно отправлена!';
        }
        else {
            $message = 'Ошибка при отправке заявки!';
        }
    }

    header('Location: index.php');
    exit();
}

?>