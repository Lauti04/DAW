<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" 
        content="width=device-width, initial-scale=1">
  <title>Iniciar sesión – EventFlow</title>
  <link href="../assets/css/tailwind.css" rel="stylesheet">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />
  <link rel="icon" type="image/png" sizes="64x64" href="../assets/img/logos/CalendarWeb.png">
</head>
<body class="bg-secondary text-text-dark dark:bg-[var(--dark)] dark:text-text-light font-body">
  <?php include __DIR__ . '/partials/header_auth.php'; ?>

  <main class="pt-24 flex items-center justify-center p-4 min-h-[calc(100vh-6rem)]">
    <div class="w-full max-w-md bg-card p-6 rounded-lg shadow-md space-y-6">
      <h2 class="text-2xl font-heading text-center">Iniciar sesión</h2>
      <form id="form-login" class="space-y-4">
        <div class="relative">
          <input
            type="email"
            id="login-email"
            name="email"
            placeholder="Correo electrónico"
            required
            class="w-full px-3 py-2 rounded border pr-10"
            autocomplete="username"
          />
          <span class="status-icon absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"></span>
          <small class="help-msg block mt-1 text-xs"></small>
        </div>
        <div class="relative">
          <input
            type="password"
            id="login-password"
            name="password"
            placeholder="Contraseña"
            required
            class="w-full px-3 py-2 rounded border pr-10"
            autocomplete="current-password"
          />
          <span class="status-icon absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"></span>
          <small class="help-msg block mt-1 text-xs"></small>
        </div>
        <button type="submit" class="w-full btn-primary py-2">
          Entrar
        </button>
      </form>
      <p id="msg-login" class="text-center text-sm mt-2 text-red-500"></p>
      <p class="text-center text-sm">
        ¿No tienes cuenta?
        <a href="register_view.php"
           class="text-primary dark:text-accent font-semibold">
           Regístrate
        </a>
      </p>
    </div>
  </main>

  <?php include __DIR__ . '/partials/footer_auth.php'; ?>

  <script>
    document.getElementById('form-login')
      .addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = new FormData(this);
        const res  = await fetch('../backend/auth/login.php', {
          method: 'POST',
          body: form
        });

        let data;
        try {
          data = await res.json();
        } catch (err) {
          const text = await res.clone().text();
          console.error('Respuesta no JSON:', text);
          return;
        }

        const msg = document.getElementById('msg-login');
        if (data.success) {
          window.location.href = data.redirect;
        } else {
          msg.textContent = data.message;
        }
      });
  </script>
  <script src="js/form-validate.js"></script>
</body>
</html>