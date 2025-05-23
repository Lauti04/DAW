<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro – EventFlow</title>
  <link href="../assets/css/tailwind.css" rel="stylesheet">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />
</head>
<body class="bg-secondary text-text-dark dark:bg-[var(--dark)] dark:text-text-light font-body">
  <?php include __DIR__ . '/partials/header_auth.php'; ?>

  <main class="pt-24 flex items-center justify-center p-4 min-h-[calc(100vh-6rem)]">
    <div class="w-full max-w-md bg-card p-6 rounded-lg shadow-md space-y-6">
      <h2 class="text-2xl font-heading text-center">Crear cuenta</h2>
      <form id="form-register" class="space-y-4">
        <input type="text" name="nombre" placeholder="Nombre completo" required
               class="w-full px-3 py-2 rounded border" />
        <input type="email" name="email" placeholder="Correo electrónico" required
               class="w-full px-3 py-2 rounded border" />
        <input type="password" name="password" placeholder="Contraseña" required
               class="w-full px-3 py-2 rounded border" />
        <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required
               class="w-full px-3 py-2 rounded border" />
        <button type="submit" class="w-full btn-primary py-2">Registrarse</button>
      </form>
      <p id="msg-register" class="text-center text-sm mt-2 text-red-500"></p>
      <p class="text-center text-sm">
        ¿Ya tienes cuenta?
        <a href="login_view.php" class="text-primary dark:text-accent font-semibold">Inicia sesión</a>
      </p>
    </div>
  </main>

  <?php include __DIR__ . '/partials/footer_auth.php'; ?>

  <script>
    document.getElementById('form-register')
      .addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = new FormData(this);
        const res  = await fetch('../backend/auth/register.php', {
          method: 'POST',
          body: form
        });

        let data;
        try {
          data = await res.json();
        } catch (err) {
          // usamos clone() para leer el body por segunda vez
          const text = await res.clone().text();
          console.error('Respuesta no JSON:', text);
          return;
        }

        const msg = document.getElementById('msg-register');
        if (data.success) {
          window.location.href = data.redirect;
        } else {
          msg.textContent = data.message;
        }
      });
  </script>
</body>
</html>