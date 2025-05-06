document.addEventListener("DOMContentLoaded", function() {
    const pattern = {
        full_name: /^[а-яА-ЯёЁ\s]+$/,
        phone: /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    }

    function validateField(input, pattern, emptyMessage, invalidMessage) {
        const value = input.input.value;
        const isValid = pattern.test(value);
        input.error.textContent = !isValid ? (value.length > 0 ? invalidMessage : emptyMessage) : '';
        input.error.classList.toggle('show', !isValid);
        input.input.classList.toggle('invalid', !isValid);
        return isValid;
    }

    const inputs = {
        surname: {
            input: document.getElementById('photographerSurname'),
            error: document.getElementById('photographerSurname').nextElementSibling,
            validate: function() {
                return validateField(
                    this,
                    pattern.full_name, 
                    'Поле "Фамилия" не может быть пустым', 
                    'Поле "Фамилия" должно содержать только русские буквы'
                );
            }
        },
        name: {
            input: document.getElementById('photographerName'),
            error: document.getElementById('photographerName').nextElementSibling,
            validate: function() {                
                return validateField(
                    this,
                    pattern.full_name,
                    'Поле "Имя" не может быть пустым',
                    'Поле "Имя" должно содержать только русские буквы'
                );
            }
        },
        patronymic: {
            input: document.getElementById('photographerPatronymic'),
            error: document.getElementById('photographerPatronymic').nextElementSibling,
            validate: function() {
                return validateField(
                    this,
                    pattern.full_name,
                    'Поле "Отчество" не может быть пустым',
                    'Поле "Отчество" должно содержать только русские буквы'
                );
            }
        },
        phone: {
            input: document.getElementById('photographerPhone'),
            error: document.getElementById('photographerPhone').nextElementSibling,
            validate: function() {
                const value = this.input.value.replace(/\D/g, '');
                const isValid = pattern.phone.test(this.input.value) && value.length === 11;
                this.error.textContent = !isValid ? (value.length > 0
                    ? 'Телефон должен содержать 11 цифр и иметь формат +7 (___) ___-__-__'
                    : 'Телефон не может быть пустым') : '';

                this.error.classList.toggle('show', !isValid);
                this.input.classList.toggle('invalid', !isValid);

                return isValid;
            }
        },
        email: {
            input: document.getElementById('photographerEmail'),
            error: document.getElementById('photographerEmail').nextElementSibling,
            validate: function() {
                return validateField(
                    this,
                    pattern.email,
                    'Поле "Email" не может быть пустым',
                    'Поле "Email" должно содержать корректный email'
                );
            }
        },
        specialization: {
            input: document.getElementById('protogragpherSpecialization'),
            error: document.getElementById('protogragpherSpecialization').nextElementSibling,
            validate: function() {
                const value = this.input.value;
                const isValid = value.length > 0;
                this.error.textContent = !isValid ? 'Поле "Специализация" не может быть пустым' : '';
                this.error.classList.toggle('show', !isValid);
                this.input.classList.toggle('invalid', !isValid);
                return isValid;
            }
        }
    };

    // Создаем отдельную функцию для обработки маски телефона
    function handlePhoneMask(event) {
        const mask = "+7 (___) ___-__-__";
        let i = 0;
        let val = this.value.replace(/\D/g, "");
    
        if (val.startsWith("8") || val.startsWith("9")) {
            val = "7" + val.slice(1);
        }
    
        this.value = mask.replace(/./g, a => /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a);
    }
    
    // Применяем обработчик ко всем событиям
    ['input', 'focus', 'blur'].forEach(event => 
        document.getElementById('photographerPhone').addEventListener(event, handlePhoneMask, false)
    );

    Object.values(inputs).forEach(input => {
        input.input.addEventListener('input', function() {
            input.validate();
        });
    })

    // Создаем функцию для обработки успешного ответа
    function handleSuccess(data) {
        console.log(data);
        // Здесь можно добавить отображение успешного сообщения
    }
    
    // Создаем функцию для обработки ошибок
    function handleError(error) {
        console.error('Ошибка:', error);
        // Здесь можно добавить отображение сообщения об ошибке
    }
    
    // // Оптимизируем обработчик отправки формы
    // document.getElementById('addPhotographerForm').addEventListener('submit', async function(e) {
    //     e.preventDefault();
        
    //     if (!Object.values(inputs).every(input => input.validate())) return;
    
    //     try {
    //         const formData = new FormData(this);
    //         const response = await fetch('add_photographer.php', {
    //             method: 'POST',
    //             body: JSON.stringify(Object.fromEntries(
    //                 Object.entries(inputs).map(([key, input]) => [key, input.input.value])
    //             ))
    //         });
            
    //         if (!response.ok) throw new Error('Ошибка сети');
    //         handleSuccess(await response.json());
    //     } catch (error) {
    //         handleError(error);
    //     }
    // });
});