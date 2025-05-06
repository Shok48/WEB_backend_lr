<?php
session_start();
$errors = [];
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB_LR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Форма добавления фотографа</h1>
    <form action="add_photographer.php" method="post" id="addPhotographerForm">
        <div class="form-container">
            <!-- <article>
                <h2>Персональные данные</h2>
                <section>
                    <label for="userSurname">Фамилия пользователя: </label>
                    <input type="text" name="userSurname" id="userSurname" required>
                    <p class="error">Фамилия должна содержать только буквы</p>
                </section>
                <section>
                    <label for="userName">Имя пользователя: </label>
                    <input type="text" name="userName" id="userName" required>
                    <p class="error">Имя пользователя должно содержать только буквы</p>
                </section>
                <section>
                    <label for="userPatronymic">Отчество пользователя: </label>
                    <input type="text" name="userPatronymic" id="userPatronymic" required>
                    <p class="error">Отчество пользователя должно содержать только буквы</p>
                </section>
            </article>

            <article>
                <h2>Контактные данные</h2>
                <section>
                    <label for="userPhone">Телефон пользователя: </label>
                    <input type="tel" name="userPhone" id="userPhone" placeholder="+7 (___) ___-__-__" required>
                    <p class="error">Телефон должен содержать только цифры</p>
                </section>
                <section>
                    <label for="userEmail">Email пользователя: </label>
                    <input type="email" name="userEmail" id="userEmail" placeholder="example@mail.ru" required>
                    <p class="error">Email должен содержать символ @</p>
                </section>
            </article>

            <article>
                <h2>Детали фотосессии</h2>
                <section>
                    <label for="photoType">Тип фотосессии:</label>
                    <select name="photoType" id="photoType" required>
                        <option value="">Выберите тип съемки</option>
                        <option value="portrait">Портретная</option>
                        <option value="family">Семейная</option>
                        <option value="wedding">Свадебная</option>
                        <option value="studio">Студийная</option>
                        <option value="outdoor">На природе</option>
                    </select>
                </section>
                <section>
                    <label for="photoDate">Дата съемки:</label>
                    <input type="date" name="photoDate" id="photoDate" required>
                    <p class="error">Выберите желаемую дату</p>
                </section>
                <section>
                    <label for="photoTime">Время съемки:</label>
                    <input type="time" name="photoTime" id="photoTime" required>
                    <p class="error">Выберите удобное время</p>
                </section>
                <section>
                    <label for="comments">Дополнительные пожелания:</label>
                    <textarea name="comments" id="comments" rows="4" placeholder="Опишите ваши пожелания к фотосессии"></textarea>
                </section>
            </article> -->

            <article>
                <h2>Персональные данные фотографа</h2>
                <section>
                    <label for="photographerSurname">Фамилия фотографа: </label>
                    <input type="text" name="photographerSurname" id="photographerSurname" require>
                    <p class="error">Фамилия фотографа должна содержать только буквы</p>
                </section>
                <section>
                    <label for="photographerName">Имя фотографа: </label>
                    <input type="text" name="photographerName" id="photographerName" require>
                    <p class="error">Имя фотографа должно содержать только буквы</p>
                </section>
                <section>
                    <label for="photographerPatronymic">Отчетсво фотографа (при наличии): </label>
                    <input type="text" name="photographerPatronymic" id="photographerPatronymic" require>
                    <p class="error">Отчетсвво фотографа должно содержать только буквы</p>
                </section>
            </article>

            <article>
                <h2>Контактные данные</h2>
                <section>
                    <label for="photographerPhone">Телефон пользователя: </label>
                    <input type="tel" name="photographerPhone" id="photographerPhone" placeholder="+7 (___) ___-__-__" required>
                    <p class="error">Телефон должен содержать только цифры</p>
                </section>
                <section>
                    <label for="photographerEmail">Email пользователя: </label>
                    <input type="email" name="photographerEmail" id="photographerEmail" placeholder="example@mail.ru" required>
                    <p class="error">Email должен содержать символ @</p>
                </section>
            </article>

            <article>
                <h2>Дополнительная информация</h2>
                <section>
                    <label for="protogragpherSpecialization">Специализация фотографа</label>
                    <select name="protogragpherSpecialization" id="protogragpherSpecialization" require style="width: 300px;">
                        <option value="">Выберите специализацию фотографа</option>
                        <option value="wedding">Свадебные фото</option>
                        <option value="portrait">Портретные фото</option>
                        <option value="business">Фотографии для бизнеса</option>
                        <option value="fashion">Модное фото</option>
                        <option value="landscape">Пейзажное фото</option>
                        <option value="childrens">Детская фотография</option>
                        <option value="animal">Фотографии животных</option>
                    </select>
                    <p class="error"></p>
                </section>
            </article>
        </div>

        <button type="submit">Отправить</button>
    </form>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li class="error"><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <script src="add_photographer.js"></script>
</body>
</html>