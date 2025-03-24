<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB_LR</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Форма записи пользователя на съемку</h1>
    <form action="register.php" method="post">
        <div class="form-container">
            <article>
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
            </article>
        </div>

        <button type="submit">Отправить</button>
    </form>
    <script src="script.js"></script>
</body>
</html>