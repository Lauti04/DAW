<?php
  // demo.php
  session_start();
  $isLogged = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Demo EventFlow</title>
  <!-- Tailwind CSS (usa CDN para prototipo; en producción apunta a tu CSS compilado) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.js"></script>
</head>
<body class="bg-secondary dark:bg-dark text-text-dark dark:text-text-light">
  <?php include 'header.php'; ?>

  <main class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl md:text-4xl font-heading mb-6 text-center">
        Prueba interactiva: Calendario EventFlow
      </h2>
      <div id="calendar" class="bg-white dark:bg-secondary rounded-2xl shadow-lg p-4"></div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        navLinks: true,
        editable: true,
        selectable: true,
        dayMaxEvents: true,
        events: [
          {
            title: 'Reunión de equipo',
            start: '2025-05-14'
          },
          {
            title: 'Planificación MVP',
            start: '2025-05-17T10:00:00',
            end: '2025-05-17T12:00:00',
            color: 'var(--accent)'
          },
          {
            title: 'Entrega de informe',
            start: '2025-05-20'
          }
        ]
      });
      calendar.render();
    });
  </script>
</body>
</html>