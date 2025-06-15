document.addEventListener('DOMContentLoaded', () => {
  // Iconos SVG
  const icons = {
    ok: `<svg viewBox="0 0 20 20" fill="none" width="20" height="20"><circle cx="10" cy="10" r="10" fill="#22c55e"/><path d="M6 10.5l3 3 5-6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
    error: `<svg viewBox="0 0 20 20" fill="none" width="20" height="20"><circle cx="10" cy="10" r="10" fill="#ef4444"/><path d="M7 7l6 6M13 7l-6 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>`,
  };

  // === LOGIN ===
  const loginForm = document.getElementById('form-login');
  if (loginForm) {
    setupValidation(loginForm, [
      {
        id: 'login-email',
        regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        ok: 'Email válido',
        error: 'Introduce un email válido.',
      },
      {
        id: 'login-password',
        regex: /^.{8,}$/,
        ok: 'Contraseña válida',
        error: 'Al menos 8 caracteres.',
      },
    ]);
  }

  // === REGISTRO ===
  const registerForm = document.getElementById('form-register');
  if (registerForm) {
    setupValidation(registerForm, [
      {
        id: 'register-nombre',
        regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{3,}$/,
        ok: 'Nombre válido',
        error: 'Mínimo 3 letras, solo texto.',
      },
      {
        id: 'register-email',
        regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        ok: 'Email válido',
        error: 'Introduce un email válido.',
      },
      {
        id: 'register-password',
        regex: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
        ok: 'Contraseña válida',
        error: 'Mínimo 8 caracteres, 1 letra y 1 número.',
      },
      {
        id: 'register-confirm',
        matchWith: 'register-password',
        ok: 'Las contraseñas coinciden',
        error: 'Las contraseñas no coinciden.',
      },
    ]);
  }

  function setupValidation(form, fieldsConfig) {
    const fields = fieldsConfig.map((f) => ({
      ...f,
      el: form.querySelector(`#${f.id}`),
      icon: form.querySelector(`#${f.id} + .status-icon`),
      help: form.querySelector(`#${f.id} ~ .help-msg`),
    }));

    function validateAll() {
      let allValid = true;
      fields.forEach((f) => {
        let valid = false;
        const value = f.el.value.trim();

        if (f.regex) valid = f.regex.test(value);
        if (f.matchWith) {
          const matchVal = form.querySelector(`#${f.matchWith}`).value;
          valid = value && value === matchVal;
        }

        // Solo border color, sin cambiar fondo
        f.el.classList.toggle('input-ok', valid);
        f.el.classList.toggle('input-error', !valid && value !== '');
        if (f.icon) f.icon.innerHTML = value ? (valid ? icons.ok : icons.error) : '';
        if (f.help) {
          f.help.textContent = !valid && value ? f.error : '';
          f.help.style.color = '#ef4444';
        }
        if (!valid) allValid = false;
      });

      const submitBtn = form.querySelector('[type="submit"]');
      if (submitBtn) submitBtn.disabled = !allValid;
    }

    fields.forEach((f) => {
      f.el.addEventListener('input', validateAll);
      if (f.matchWith) {
        form.querySelector(`#${f.matchWith}`).addEventListener('input', validateAll);
      }
    });

    form.addEventListener('submit', (e) => {
      validateAll();
      if (form.querySelector('.input-error')) e.preventDefault();
    });

    validateAll();
  }
});
