/**
 * VALIDACIÓN DE FORMULARIO Y FUNCIONALIDADES
 * - Valida campos con expresiones regulares actualizadas
 * - Integra validación de Bootstrap
 * - Muestra notificaciones con SweetAlert
 * - Controla la carga del mapa
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('pasteleriaForm');
    const inputs = {
        nombre: document.getElementById('nombre'),
        email: document.getElementById('email'),
        telefono: document.getElementById('telefono'),
        mensaje: document.getElementById('mensaje')
    };
    const accentColor = getComputedStyle(document.documentElement)
        .getPropertyValue('--fixed-accent').trim();

    // Expresiones regulares mejoradas
    const regex = {
        nombre: /^[A-Za-zÁ-úñÑ\s']{3,40}$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        telefono: /^[67]\d{8}$/ // 9 dígitos comenzando con 6 o 7
    };

    // Sistema debounce para validación en tiempo real
    const createDebouncedValidation = (input) => {
        let timeout;
        return () => {
            clearTimeout(timeout);
            timeout = setTimeout(() => validateField(input, false), 300);
        };
    };

    // Configurar validación en tiempo real para todos los campos
    Object.entries(inputs).forEach(([key, input]) => {
        const debouncedValidation = createDebouncedValidation(input);
        input.addEventListener('input', () => {
            input.classList.remove('is-valid', 'is-invalid');
            debouncedValidation();
        });
        input.addEventListener('blur', () => validateField(input, true));
    });

    // Evento submit mejorado
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        resetValidationStates();

        let isFormValid = true;
        Object.values(inputs).forEach(input => {
            if (!validateField(input, true)) isFormValid = false;
        });

        if (isFormValid) {
            showSuccessAlert();
            form.reset();
            Object.values(inputs).forEach(input => input.classList.remove('is-valid'));
        } else {
            form.classList.add('was-validated');
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'Por favor corrige los campos marcados',
                confirmButtonColor: accentColor,
                background: 'var(--white)',
                color: 'var(--dark-text)',
                customClass: {
                    container: 'sweet-container',
                    popup: 'sweet-popup'
                }
            });
        }
    });

    // Función principal de validación mejorada
    function validateField(input, isSubmit = false) {
        const formGroup = input.closest('.mb-3, .mb-4');
        const errorSpan = formGroup.querySelector('.invalid-feedback');
        let isValid = true;
        let errorMessage = '';

        // Resetear estados
        input.classList.remove('is-valid', 'is-invalid');
        errorSpan.textContent = '';
        errorSpan.style.display = 'none';

        // Validación específica por campo
        switch (input.id) {
            case 'nombre':
                isValid = regex.nombre.test(input.value.trim());
                errorMessage = 'Solo letras y espacios (3-40 caracteres)';
                break;

            case 'email':
                isValid = regex.email.test(input.value.trim());
                errorMessage = 'Formato inválido (ej: nombre@dominio.com)';
                break;

            case 'telefono':
                const cleanNumber = input.value.replace(/\D/g, '');
                isValid = regex.telefono.test(cleanNumber);
                
                // Formatear solo durante la entrada, no en el submit
                if (!isSubmit && cleanNumber.length > 0) {
                    const formatted = cleanNumber.replace(/(\d{3})(?=\d)/g, '$1 ');
                    input.value = formatted.substring(0, 11);
                }
                
                errorMessage = 'Debe comenzar con 6/7 y tener 9 dígitos';
                break;

            case 'mensaje':
                isValid = input.value.trim().length >= 20;
                errorMessage = 'Mínimo 20 caracteres requeridos';
                break;
        }

        // Validación adicional para campos requeridos
        if (input.required && !input.value.trim()) {
            errorMessage = 'Este campo es obligatorio';
            isValid = false;
        }

        // Manejar estado de validación
        if (!isValid) {
            input.classList.add('is-invalid');
            errorSpan.textContent = errorMessage;
            errorSpan.style.display = 'block';
            return false;
        } else {
            // Solo mostrar válido si pasa todas las validaciones
            input.classList.add('is-valid');
            return true;
        }
    }

    // Reiniciar estados de validación
    function resetValidationStates() {
        Object.values(inputs).forEach(input => {
            input.classList.remove('is-valid', 'is-invalid');
        });
        form.classList.remove('was-validated');
    }

    // Mostrar alerta de éxito
    function showSuccessAlert() {
        Swal.fire({
            title: '¡Dulce éxito! 🎂',
            text: 'Tu mensaje ha sido enviado correctamente',
            icon: 'success',
            confirmButtonColor: accentColor,
            background: 'var(--white)',
            color: 'var(--dark-text)',
            customClass: {
                container: 'sweet-container',
                popup: 'sweet-popup'
            }
        });
    }

    // Carga diferida del mapa
    const mapObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                console.log('Cargar mapa interactivo...');
                mapObserver.disconnect();
            }
        });
    });
    mapObserver.observe(document.querySelector('.map-container'));

    /**
    * ANIMACIONES ADICIONALES
    * - Efecto hover en tarjetas
    * - Rotación de iconos
    */
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-10px) scale(1.02)');
        card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0) scale(1)');
    });

    document.querySelectorAll('.social-media i').forEach(icon => {
        icon.addEventListener('mouseenter', () => icon.style.transform = 'rotate(360deg)');
        icon.addEventListener('mouseleave', () => icon.style.transform = 'rotate(0deg)');
    });

    // Newsletter Validation
    const newsletterForm = document.getElementById('newsletterForm');
    const newsletterEmail = document.getElementById('newsletterEmail');
    const newsletterFeedback = document.querySelector('.invalid-feedback-newsletter');

    // Reutilizamos la misma regex del formulario principal
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Validación en tiempo real
    newsletterEmail.addEventListener('input', validateNewsletterEmail);
    newsletterEmail.addEventListener('blur', validateNewsletterEmail);

    // Submit handler
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const isValid = validateNewsletterEmail();

        if (isValid) {
            Swal.fire({
                title: '¡Dulce suscripción! 🧁',
                text: 'Ahora recibirás nuestras novedades por email',
                icon: 'success',
                confirmButtonColor: accentColor,
                background: 'var(--white)',
                color: 'var(--dark-text)',
                customClass: {
                    popup: 'sweet-popup-newsletter'
                }
            });
            newsletterForm.reset();
            newsletterEmail.classList.remove('is-valid');
        }
    });

    function validateNewsletterEmail() {
        const isValid = emailRegex.test(newsletterEmail.value);

        newsletterEmail.classList.remove('is-invalid', 'is-valid');
        newsletterFeedback.style.display = 'none';

        if (!isValid && newsletterEmail.value.length > 0) {
            newsletterEmail.classList.add('is-invalid');
            newsletterFeedback.textContent = 'Por favor ingresa un email válido (ej: nombre@dominio.com)';
            newsletterFeedback.style.display = 'block';
            return false;
        } else if (isValid) {
            newsletterEmail.classList.add('is-valid');
            return true;
        }

        return false;
    }

    // Validar campos iniciales si están pre-llenados
    Object.values(inputs).forEach(input => {
        if (input.value) validateField(input, true);
    });
});