document.addEventListener('DOMContentLoaded', function() {
    const patterns = {
        name: /^[a-zA-Zа-яА-Я]+$/,
        phone: /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        date: /^\d{2}.\d{2}.\d{4}$/,
        time: /^\d{2}:\d{2}$/,
    };

    function validateNameField(input) {
        const isValid = patterns.name.test(input.value);
        const error = input.nextElementSibling;
        const fieldName = {
            'userSurname': 'Фамилия',
            'userName': 'Имя',
            'userPatronymic': 'Отчество'
        }[input.id];

        if (!isValid) {
            error.textContent =  `${fieldName} должно содержать только русские буквы`
            error.classList.add('show');
            input.classList.add('invalid');
        } else {
            error.textContent = '';
            error.classList.remove('show');
            input.classList.remove('invalid');
        }
        return isValid;
    }
    
    const nameFields = ['userSurname', 'userName', 'userPatronymic'];
    
    nameFields.forEach(fieldId => {
        document.getElementById(fieldId).addEventListener('input', function() {
            validateNameField(this);
        });
    });

    function mask(event) {
        const matrix = "+7 (___) ___-__-__";
        let i = 0;
        let val = this.value.replace(/\D/g, "");

        if (val.startsWith("8") || val.startsWith("9")) {
            val = "7" + val.slice(1);
        }

        this.value = matrix.replace(/./g, a => /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a);
    }

    const phoneInput = document.getElementById("userPhone");
    ["input", "focus", "blur"].forEach(event => phoneInput.addEventListener(event, mask, false));

    function validatePhone(input) {
        const isValid = patterns.phone.test(input.value);
        const error = input.nextElementSibling;

        error.textContent = !isValid ? (input.value.length > 0 
            ? 'Телефон должен содержать только цифры и иметь формат +7 (___) ___-__-__' 
            : 'Телефон не может быть пустым') : '';
        error.classList.toggle('show', !isValid);
        input.classList.toggle('invalid', !isValid);

        return isValid;
    }

    phoneInput.addEventListener('input', function() {
        validatePhone(this);
    });

    function validateEmail(input) {
        const isValid = patterns.email.test(input.value);
        const error = input.nextElementSibling;

        if (!isValid) {
            error.textContent = `Email должен содержать символ @`;
            error.classList.add('show');
            input.classList.add('invalid');
        } else {
            error.textContent = '';
            error.classList.remove('show');
            input.classList.remove('invalid');
        }
        return isValid;
    }

    const emailInput = document.getElementById("userEmail");
    emailInput.addEventListener('input', function() {
        validateEmail(this);
    });

    
});