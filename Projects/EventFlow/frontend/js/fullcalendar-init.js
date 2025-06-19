document.addEventListener('DOMContentLoaded', async function () {
  // ─────────────────────────────────────────────────────
  //  1) Cargar categorías (id_categoria → color) desde el endpoint
  // ─────────────────────────────────────────────────────
  const categoriaColors = {};
  try {
    const resCats = await fetch('../backend/api/categorias.php');
    const jsonCats = await resCats.json();
    if (jsonCats.success) {
      jsonCats.data.forEach((cat) => {
        categoriaColors[cat.id_categoria] = cat.color;
      });
    } else {
      console.error('Error al listar categorías:', jsonCats.error);
    }
  } catch (err) {
    console.error('Error de red al cargar categorías:', err);
  }

  // ─────────────────────────────────────────────────────
  //  2) Estilos personalizados para mobile / botón activo
  // ─────────────────────────────────────────────────────
  const styleEl = document.createElement('style');
  styleEl.textContent = `
    /* Ejemplo: ajustes Tailwind para FullCalendar en móvil */
    /* … tu código previo para mobile & botón activo … */
  `;
  document.head.appendChild(styleEl);

  const calendarEl = document.getElementById('calendar');
  // tras calendar.render():
  // document.querySelectorAll('.fc-daygrid-day-frame').forEach(function (cell) {
  //   cell.addEventListener('touchstart', function (e) {
  //     // evita que el tap cierre inmediatamente el modal,
  //     // pero no interfiere en el toolbar
  //     e.preventDefault();
  //     e.stopPropagation();
  //   });
  // });

  // ─────────────────────────────────────────────────────
  //  2.1) FUNCIONES DE RENDERIZADO DE EVENTOS (PRIORIDAD)
  // ─────────────────────────────────────────────────────
  // Render estándar (con circulito de prioridad para tareas)
  function eventContentDefault(arg) {
    let hora = arg.timeText || '';
    if (hora && !hora.includes(':')) {
      hora = hora + ':00';
    }
    if (hora) {
      hora = hora + ' hs';
    }

    // Detecta si es una tarea para el circulito de prioridad
    let circulito = '';
    if (arg.event.extendedProps && arg.event.extendedProps.tipo === 'tarea') {
      const prioridad = arg.event.extendedProps.prioridad;
      let color = '';
      if (prioridad === 'alta') color = 'bg-red-500';
      else if (prioridad === 'media') color = 'bg-yellow-400';
      else color = 'bg-green-500';
      circulito = `<span class="inline-block w-3 h-3 rounded-full mr-2 border border-gray-300 ${color}"></span>`;
    }

    return {
      html: `
        <div class="fc-event-time text-xs font-medium">${hora}</div>
        <div class="fc-event-title text-sm font-semibold">
          ${circulito}${arg.event.title}
        </div>
      `,
    };
  }

  // Render personalizado para la vista de AGENDA (texto prioridad)
  function eventContentAgenda(arg) {
    // Sin hora (agenda la pone sola)
    let html = `<span class="fc-event-title text-sm font-semibold">${arg.event.title}</span>`;

    if (arg.event.extendedProps && arg.event.extendedProps.tipo === 'tarea') {
      let prioridad = arg.event.extendedProps.prioridad;
      let label = '',
        color = '';
      if (prioridad === 'alta') {
        label = 'Alta';
        color = 'text-red-500 font-semibold';
      } else if (prioridad === 'media') {
        label = 'Media';
        color = 'text-yellow-500 font-semibold';
      } else {
        label = 'Baja';
        color = 'text-green-600 font-semibold';
      }
      html += `<span class="ml-2 ${color} text-xs align-middle rounded px-2 py-0.5 border border-gray-200">${label}</span>`;
    }

    return { html };
  }

  // ───────────────────────────────────────────────────────────────────────────
  //    3) Inicialización de FullCalendar
  // ───────────────────────────────────────────────────────────────────────────
  // Detectar móvil vs escritorio
  const isMobile = window.innerWidth < 640;
  var calendar = new FullCalendar.Calendar(calendarEl, {
    timeZone: 'local',
    locale: 'es',
    buttonText: {
      today: 'Hoy',
      month: 'Mes',
      week: 'Semana',
      day: 'Día',
      listWeek: 'Agenda',
    },
    initialView: 'dayGridMonth',
    // ─── Ajuste de tamaño y comportamiento de eventos ───
    // Borra todo lo que tuvieras de `height: …`, `contentHeight: …`, `aspectRatio`…
    height: isMobile ? 'auto' : window.innerHeight - 96,
    dayMaxEventRows: 2, // 2 filas de eventos
    dayMaxEvents: true, // “+X más”
    moreLinkClick: 'popover',
    moreLinkContent: function (arg) {
      return '+' + arg.num + ' más';
    },
    // ───────── Vista-específicas ─────────
    views: {
      dayGridMonth: {
        fixedWeekCount: true,
        contentHeight: () => {
          const rows = 6;
          const headerH = 40;
          const cellH = Math.floor((window.innerHeight - headerH) / rows);
          return headerH + cellH * rows;
        },
        eventContent: eventContentDefault,
      },
      timeGridWeek: {
        contentHeight: 'auto',
        eventContent: eventContentDefault,
      },
      timeGridDay: {
        contentHeight: 'auto',
        eventContent: eventContentDefault,
      },
      listWeek: {
        eventContent: eventContentAgenda,
      },
      listDay: {
        eventContent: eventContentAgenda,
      },
    },
    eventContent: eventContentDefault,
    eventDisplay: 'block',
    // ────────────────────────────────────────────────────────────────────────
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek',
    },
    editable: true,
    eventLongPressDelay: 200, // ms antes de comenzar el drag en móvil
    selectable: true,

    // ─────────────────────────────────────────────────────────
    //  (A) Mostrar todos los eventos como “bloques” (no dots)
    // ─────────────────────────────────────────────────────────
    eventDisplay: 'block',

    // ─────────────────────────────────────────────────────────
    //  (C) Fuentes: EVENTOS, TAREAS y RECORDATORIOS con colores dinámicos
    // ─────────────────────────────────────────────────────────
    eventSources: [
      // ====================================================
      //  1) FUENTE DE “EVENTOS”
      // ====================================================
      {
        events: function (fetchInfo, successCallback, failureCallback) {
          fetch('../backend/api/eventos.php')
            .then((res) => res.json())
            .then((json) => {
              if (!json.success) {
                console.error('Error al cargar eventos:', json.error);
                return failureCallback(json.error);
              }

              const mapped = json.data.map((ev) => {
                // Cadena ISO-local para start/end (reemplazando ' ' por 'T')
                const startStr = ev.start.slice(0, 16).replace(' ', 'T');
                const endStr = ev.end ? ev.end.replace(' ', 'T') : null;

                // Color según categoría
                const colorCat =
                  ev.categoryId === 1
                    ? 'var(--primary)'
                    : categoriaColors[ev.categoryId] || 'var(--primary)';

                return {
                  id: ev.id,
                  title: ev.title,
                  start: startStr, // e.g. "2025-06-08T07:00:00"
                  end: endStr, // e.g. "2025-06-10T10:00:00" o null
                  backgroundColor: colorCat,
                  borderColor: colorCat,
                  textColor: '#ffffff',
                  extendedProps: {
                    tipo: 'evento',
                    descripcion: ev.descripcion,
                    ubicacion: ev.ubicacion,
                    categoryId: ev.categoryId,
                  },
                };
              });

              // console.log(
              //   '→ Eventos mapeados (start/end):',
              //   mapped.map((e) => [e.id, e.start, e.end])
              // );
              successCallback(mapped);
            })
            .catch((err) => {
              console.error('Error en fetch eventos:', err);
              failureCallback(err);
            });
        },
      },

      // ====================================================
      //  2) FUENTE DE “TAREAS”
      // ====================================================
      {
        events: function (fetchInfo, successCallback, failureCallback) {
          fetch('../backend/api/tareas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'listar' }),
          })
            .then((res) => res.json())
            .then((json) => {
              if (json.success) {
                const mapped = json.data.map((t) => {
                  // Aquí también forzamos --primary si es categoría “Trabajo” (ID=1)
                  const colorCat =
                    t.id_categoria === 1
                      ? 'var(--primary)'
                      : categoriaColors[t.id_categoria] || 'var(--secondary)';

                  return {
                    id: 'tarea-' + t.id,
                    title: t.titulo,
                    start: t.fecha_vencimiento,
                    backgroundColor: colorCat,
                    borderColor: colorCat,
                    textColor: '#ffffff',
                    extendedProps: {
                      tipo: 'tarea',
                      descripcion: t.descripcion,
                      estado: t.estado,
                      prioridad: t.prioridad,
                      id_categoria: t.id_categoria,
                      id_evento_fk: t.id_evento_fk,
                    },
                  };
                });
                successCallback(mapped);
              } else {
                console.error('Error al cargar tareas:', json.error);
                failureCallback(json.error);
              }
            })
            .catch((err) => {
              console.error('Error en fetch tareas:', err);
              failureCallback(err);
            });
        },
      },

      // ====================================================
      //  3) FUENTE DE “RECORDATORIOS”
      // ====================================================
      {
        events: function (fetchInfo, successCallback, failureCallback) {
          fetch('../backend/api/recordatorios.php')
            .then((res) => res.json())
            .then((json) => {
              if (json.success) {
                const mapped = json.data.map((r) => {
                  // Los recordatorios usan siempre --accent
                  const colorCat = 'var(--accent)';
                  return {
                    id: 'rem-' + r.id_recordatorio,
                    title: r.mensaje,
                    start: r.dateTime,
                    backgroundColor: colorCat,
                    borderColor: colorCat,
                    textColor: '#ffffff',
                    extendedProps: {
                      tipo: 'recordatorio',
                    },
                  };
                });
                successCallback(mapped);
              } else {
                console.error('Error al cargar recordatorios:', json.error);
                failureCallback(json.error);
              }
            })
            .catch((err) => {
              console.error('Error en fetch recordatorios:', err);
              failureCallback(err);
            });
        },
      },
    ], // fin de eventSources

    // ─────────────────────────────────────────────────────────
    //  (D) dateClick: abrir modal de creación
    // ─────────────────────────────────────────────────────────
    dateClick: function (info) {
      if (info.jsEvent) {
        info.jsEvent.preventDefault();
        info.jsEvent.stopPropagation();
      }
      setTimeout(function () {
        window.dispatchEvent(new CustomEvent('openModal', { detail: { dateStr: info.dateStr } }));
      }, 0);
    },

    // ─────────────────────────────────────────────────────────
    //  (E) eventClick: abrir modal de edición según tipo
    // ─────────────────────────────────────────────────────────
    eventClick: function (info) {
      const ev = info.event;
      const tipo = ev.extendedProps.tipo;
      if (tipo === 'evento') {
        const existingEvent = {
          id: ev.id,
          title: ev.title,
          fecha_inicio: ev.startStr,
          fecha_fin: ev.endStr,
          descripcion: ev.extendedProps.descripcion,
          ubicacion: ev.extendedProps.ubicacion,
          id_categoria: ev.extendedProps.categoryId,
        };
        window.dispatchEvent(new CustomEvent('openModalEditarEvento', { detail: existingEvent }));
      } else if (tipo === 'tarea') {
        const existingTask = {
          id: ev.id.replace('tarea-', ''),
          titulo: ev.title,
          descripcion: ev.extendedProps.descripcion,
          fecha_vencimiento: ev.startStr,
          estado: ev.extendedProps.estado,
          prioridad: ev.extendedProps.prioridad,
          id_categoria_fk: ev.extendedProps.id_categoria,
          id_evento_fk: ev.extendedProps.id_evento_fk,
        };
        window.dispatchEvent(new CustomEvent('openModalEditarTarea', { detail: existingTask }));
      } else if (tipo === 'recordatorio') {
        const existingRem = {
          id_recordatorio: ev.id.replace('rem-', ''),
          mensaje: ev.title,
          fecha_hora: ev.startStr,
        };
        window.dispatchEvent(
          new CustomEvent('openModalEditarRecordatorio', { detail: existingRem })
        );
      }
    },

    eventDrop: function (info) {
      // 1. Obtener los datos relevantes
      const ev = info.event;
      const tipo = ev.extendedProps.tipo;
      let url = '';
      let body = {};

      // 2. Preparar request según tipo
      if (tipo === 'evento') {
        url = '../backend/api/eventos.php';
        body = {
          action: 'editar',
          id_evento: ev.id,
          fecha_inicio: ev.startStr.replace('T', ' '), // Formato YYYY-MM-DD HH:mm
          fecha_fin: ev.endStr ? ev.endStr.replace('T', ' ') : null,
        };
      } else if (tipo === 'tarea') {
        url = '../backend/api/tareas.php';
        body = {
          action: 'editar',
          id_tarea: ev.id.replace('tarea-', ''),
          fecha_vencimiento: ev.startStr.replace('T', ' '),
        };
      } else if (tipo === 'recordatorio') {
        url = '../backend/api/recordatorios.php';
        body = {
          action: 'editar',
          id_recordatorio: ev.id.replace('rem-', ''),
          fecha_hora: ev.startStr.replace('T', ' '),
        };
      }

      // 3. Hacer el fetch (POST)
      fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body),
      })
        .then((res) => res.json())
        .then((json) => {
          if (!json.success) {
            alert('Error al actualizar. Se revertirá el cambio.');
            info.revert(); // Revierte el movimiento en el cliente si hay error
          } else {
            // Opcional: muestra notificación de éxito
            // Y recarga los eventos (por si hay cambios secundarios)
            window.dispatchEvent(new CustomEvent(tipo + 'sActualizados'));
          }
        })
        .catch((err) => {
          alert('Error de red. Se revierte el cambio.');
          info.revert();
        });
    },

    // ─────────────────────────────────────────────────────────
    //  (X) Aquí añadimos datesSet
    // ─────────────────────────────────────────────────────────
    datesSet: function (info) {
      window.dispatchEvent(
        new CustomEvent('fcViewChanged', {
          detail: info.view.type,
        })
      );
    },
  });

  // ─────────────────────────────────────────────────────────
  // Interceptar touchstart en celdas vacías para evitar
  // que el mismo tap que abre el modal lo cierre inmediatamente
  // ─────────────────────────────────────────────────────────
  calendarEl.addEventListener('touchstart', function (e) {
    // Si tocó un botón de toolbar o dentro de un evento, no interferir
    if (
      e.target.closest('.fc-toolbar') ||
      e.target.closest('.fc-button') ||
      e.target.closest('.fc-event') ||
      e.target.closest('.fc-more-link') ||
      e.target.closest('.fc-popover-close')
    ) {
      return;
    }
    // Sólo en celdas vacías (día vacío), bloqueamos la propagación
    e.preventDefault();
    e.stopPropagation();
  });

  // Exponer la instancia globalmente para poder cambiar vista desde el sidebar
  window.calendar = calendar;

  // ─────────────────────────────────────────────────────────
  //  4) Renderizamos el calendario
  // ─────────────────────────────────────────────────────────
  calendar.render();

  // ─────────────────────────────────────────────────────────
  //  5) Suscribirse a eventos globales para recargar automáticamente
  //     (sin necesidad de recargar la página completa)
  // ─────────────────────────────────────────────────────────
  window.addEventListener('eventosActualizados', function () {
    calendar.refetchEvents();
  });
  window.addEventListener('tareasActualizadas', function () {
    calendar.refetchEvents();
  });
  window.addEventListener('recordatoriosActualizados', function () {
    calendar.refetchEvents();
  });

  // ─────────────────────────────────────────────────────────
  //  6) Aquí incluimos tu bloque que colorea los botones de FullCalendar
  //      ¡tal cual pediste, sin quitarlo!
  // ─────────────────────────────────────────────────────────
  // document.querySelectorAll('.fc .fc-button').forEach(function (btn) {
  //   btn.style.setProperty('background-color', 'var(--primary)', 'important');
  //   btn.style.setProperty('color', '#ffffff', 'important');
  //   btn.style.setProperty('border', 'none', 'important');
  // });

  // ─────────────────────────────────────────────────────────
  //  7) (Opcional) Resto de tu lógica: toggles de sidebar,
  //     listeners en dashboard-scripts.js, etc.
  // ─────────────────────────────────────────────────────────
});
