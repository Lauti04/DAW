/** frontend/js/react-modals.jsx **/

const { useState, useEffect } = React;

// Icon mapping for modal headers and buttons
const ICONS = {
  evento: 'fas fa-calendar-alt',
  tarea: 'fas fa-tasks',
  recordatorio: 'fas fa-bell',
};

// Initial chooser modal: select type or get help
function ChooserModal({ onSelect, onHelp, onClose }) {
  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.7)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg
                  w-full max-w-md mx-4 sm:mx-auto
                  max-h-[calc(100vh-4rem)] overflow-y-auto
                  animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light mb-4 text-center">
          Crear Nuevo
        </h2>
        <div className="grid gap-3">
          <button
            onClick={() => onSelect('evento')}
            className="btn-primary flex items-center justify-center space-x-2"
          >
            <i className="fas fa-calendar-alt" />
            <span>Evento</span>
          </button>
          <button
            onClick={() => onSelect('tarea')}
            className="btn-primary flex items-center justify-center space-x-2"
          >
            <i className="fas fa-tasks" />
            <span>Tarea</span>
          </button>
          <button
            onClick={() => onSelect('recordatorio')}
            className="btn-primary flex items-center justify-center space-x-2"
          >
            <i className="fas fa-bell" />
            <span>Recordatorio</span>
          </button>
        </div>
        <div className="mt-4 text-center text-sm text-primary hover:underline cursor-pointer">
          <span onClick={onHelp}>¿No sabes cuál elegir?</span>
        </div>
      </div>
    </div>
  );
}

// Reusable modal header with switch buttons
function ModalHeader({ title, type, onSwitch }) {
  return (
    <div className="flex justify-between items-center mb-4">
      <div className="flex items-center space-x-2">
        <i className={`${ICONS[type]} text-xl`} />
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light">{title}</h2>
      </div>
      <div className="space-x-2">
        {['evento', 'tarea', 'recordatorio'].map(
          (t) =>
            t !== type && (
              <button
                key={t}
                onClick={() => onSwitch(t)}
                className="text-text-dark dark:text-text-light hover:text-primary"
                title={`Crear ${t}`}
              >
                <i className={ICONS[t]} />
              </button>
            )
        )}
      </div>
    </div>
  );
}

// Help modal explaining differences
function HelpModal({ onBack, onClose }) {
  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.7)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg
                 w-full max-w-md mx-4 sm:mx-auto
                 max-h-[calc(100vh-4rem)] overflow-y-auto
                 animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light mb-4">
          ¿Qué diferencia hay?
        </h2>
        <ul className="space-y-4 text-text-dark dark:text-text-light">
          <li>
            <strong>Evento</strong> <i className="fas fa-calendar-alt ml-1" />:<br />
            Registra reuniones, citas o acontecimientos con rango de tiempo.
            <br />
            <em className="block text-sm">Ejemplo: "Reunión equipo" 10:00–11:00.</em>
          </li>
          <li>
            <strong>Tarea</strong> <i className="fas fa-tasks ml-1" />:<br />
            Actividades puntuales con fecha límite.
            <br />
            <em className="block text-sm">Ejemplo: "Enviar informe" antes del 25/06.</em>
          </li>
          <li>
            <strong>Recordatorio</strong> <i className="fas fa-bell ml-1" />:<br />
            Mensajes breves para no olvidar algo en un momento concreto.
            <br />
            <em className="block text-sm">Ejemplo: "Llamar al cliente" a las 15:00.</em>
          </li>
        </ul>
        <div className="flex justify-end mt-6">
          <button onClick={onBack} className="btn-primary">
            Entendido, crear…
          </button>
        </div>
      </div>
    </div>
  );
}

function EventModal({ initialDate, onClose, onSwitch, categorias }) {
  const [fechaInicio, setFechaInicio] = React.useState(initialDate || '');
  const [fechaFin, setFechaFin] = React.useState('');
  const [dateError, setDateError] = React.useState(false);
  const [submitError, setSubmitError] = React.useState('');
  const refInicio = React.useRef(null);
  const refFin = React.useRef(null);

  // Valida las fechas SIEMPRE que cambian
  React.useEffect(() => {
    if (fechaInicio && fechaFin) {
      const startDate = new Date(fechaInicio.replace(' ', 'T'));
      const endDate = new Date(fechaFin.replace(' ', 'T'));
      setDateError(startDate > endDate);
    } else {
      setDateError(false);
    }
  }, [fechaInicio, fechaFin]);

  // Inicializa Flatpickr SOLO aquí, con botón OK
  React.useEffect(() => {
    if (refInicio.current) {
      flatpickr(refInicio.current, {
        dateFormat: 'Y-m-d H:i',
        enableTime: true,
        defaultDate: fechaInicio,
        allowInput: false,
        plugins: [new confirmDatePlugin({ confirmText: 'OK' })],
        onChange: ([sel]) => {
          if (!sel) return setFechaInicio('');
          const pad = (n) => String(n).padStart(2, '0');
          const y = sel.getFullYear(),
            M = pad(sel.getMonth() + 1),
            d = pad(sel.getDate()),
            h = pad(sel.getHours()),
            m = pad(sel.getMinutes());
          setFechaInicio(`${y}-${M}-${d} ${h}:${m}`);
        },
      });
    }
    if (refFin.current) {
      flatpickr(refFin.current, {
        dateFormat: 'Y-m-d H:i',
        enableTime: true,
        defaultDate: fechaFin,
        allowInput: false,
        plugins: [new confirmDatePlugin({ confirmText: 'OK' })],
        onChange: ([sel]) => {
          if (!sel) return setFechaFin('');
          const pad = (n) => String(n).padStart(2, '0');
          const y = sel.getFullYear(),
            M = pad(sel.getMonth() + 1),
            d = pad(sel.getDate()),
            h = pad(sel.getHours()),
            m = pad(sel.getMinutes());
          setFechaFin(`${y}-${M}-${d} ${h}:${m}`);
        },
      });
    }
  }, []); // SOLO al montar

  // Maneja el submit, ahora sí robusto
  async function handleSubmit(e) {
    e.preventDefault();
    setSubmitError('');
    // Verifica que haya fecha de inicio y no error de fechas
    if (!fechaInicio) {
      setSubmitError('Selecciona la fecha de inicio.');
      return;
    }
    if (fechaFin && dateError) {
      setSubmitError('La fecha de inicio no puede ser mayor que la de fin.');
      return;
    }
    const form = e.target;
    const data = {
      action: 'crear',
      titulo: form.elements['titulo'].value,
      descripcion: form.elements['descripcion'].value,
      fecha_inicio: fechaInicio,
      fecha_fin: fechaFin,
      ubicacion: form.elements['ubicacion'].value,
      id_categoria: form.elements['id_categoria'].value,
    };
    try {
      const res = await fetch('../backend/api/eventos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('eventosActualizados'));
        onClose();
      } else {
        setSubmitError(json.error || 'Error al crear evento');
        console.error('Error al crear evento:', json.error);
      }
    } catch (err) {
      setSubmitError('Error en fetch evento');
      console.error('Error en fetch evento:', err);
    }
  }

  // Render modal y formulario
  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.7)] dark:bg-[rgba(255,255,255,0.2)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg w-full max-w-md mx-4 sm:mx-auto max-h-[calc(100vh-4rem)] overflow-y-auto animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <ModalHeader title="Crear Evento" type="evento" onSwitch={onSwitch} />
        <form className="space-y-4" onSubmit={handleSubmit} autoComplete="off">
          {/* Título */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Título</label>
            <input
              name="titulo"
              type="text"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Nombre del evento"
              required
            />
          </div>
          {/* Descripción */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Descripción</label>
            <textarea
              name="descripcion"
              className="w-full max-h-40 resize-y overflow-auto p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Detalles…"
            />
          </div>
          {/* Fechas */}
          <div className="grid grid-cols-1 gap-4">
            {/* Fecha inicio */}
            <div>
              <label className="block text-text-dark dark:text-text-light mb-1">Fecha inicio</label>
              <div className="relative">
                <input
                  ref={refInicio}
                  name="fecha_inicio"
                  type="text"
                  readOnly
                  value={fechaInicio}
                  className="flatpickr-input w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
                  placeholder="YYYY-MM-DD HH:mm"
                  required
                  onChange={() => {}} // Evita warning
                />
                <i className="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
              </div>
            </div>
            {/* Fecha fin */}
            <div>
              <label className="block text-text-dark dark:text-text-light mb-1">Fecha fin</label>
              <div className="relative">
                <input
                  ref={refFin}
                  name="fecha_fin"
                  type="text"
                  readOnly
                  value={fechaFin}
                  className="flatpickr-input w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
                  placeholder="YYYY-MM-DD HH:mm"
                  onChange={() => {}} // Evita warning
                />
                <i className="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
              </div>
            </div>
          </div>
          {/* Mensaje error fechas */}
          {dateError && (
            <div className="text-red-500 text-sm mt-1">
              La fecha de inicio no puede ser mayor que la de fin.
            </div>
          )}
          {/* Mensaje error de submit */}
          {submitError && <div className="text-red-500 text-sm mt-1">{submitError}</div>}
          {/* Ubicación */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Ubicación</label>
            <input
              name="ubicacion"
              type="text"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Dónde será…"
            />
          </div>
          {/* Categoría */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Categoría</label>
            <select
              name="id_categoria"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="">Selecciona…</option>
              {categorias.map((cat) => (
                <option key={cat.id_categoria} value={cat.id_categoria}>
                  {cat.nombre}
                </option>
              ))}
            </select>
          </div>
          {/* Acciones */}
          <div className="flex justify-end space-x-2 mt-4">
            <button type="button" onClick={onClose} className="btn-secondary">
              Cancelar
            </button>
            <button type="submit" className="btn-primary" disabled={dateError}>
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

// Task creation modal
// frontend/js/react-modals.jsx

function TaskModal({ initialDate, onClose, onSwitch, categorias, usuarioId }) {
  const [eventos, setEventos] = React.useState([]);

  // Cargar eventos del usuario al montar el modal
  React.useEffect(() => {
    fetch('../backend/api/eventos.php')
      .then((res) => res.json())
      .then((json) => {
        if (json.success) setEventos(json.data);
        else setEventos([]);
      })
      .catch(() => setEventos([]));
  }, []);

  async function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = {
      action: 'crear',
      titulo: form.elements['titulo'].value,
      descripcion: form.elements['descripcion'].value,
      fecha_vencimiento: form.elements['fecha_vencimiento'].value,
      prioridad: form.elements['prioridad'].value,
      id_categoria_fk: form.elements['id_categoria_fk'].value,
      id_evento_fk: form.elements['id_evento_fk'].value || null,
    };
    try {
      const res = await fetch('../backend/api/tareas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('tareasActualizadas'));
        onClose();
      } else {
        console.error('Error al crear tarea:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch tarea:', err);
    }
  }

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.7)] dark:bg-[rgba(255,255,255,0.2)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg
                 w-full max-w-md mx-4 sm:mx-auto
                 max-h-[calc(100vh-4rem)] overflow-y-auto
                 animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <ModalHeader title="Crear Tarea" type="tarea" onSwitch={onSwitch} />
        <form className="space-y-4" onSubmit={handleSubmit}>
          {/* Título */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Título</label>
            <input
              name="titulo"
              type="text"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Nombre de la tarea"
              required
            />
          </div>
          {/* Descripción */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Descripción</label>
            <textarea
              name="descripcion"
              className="w-full max-h-40 resize-y overflow-auto p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Detalles…"
            />
          </div>
          {/* Fecha y hora */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">
              Fecha vencimiento
            </label>
            <div className="relative">
              <input
                name="fecha_vencimiento"
                type="text"
                readOnly
                data-flatpickr
                data-enable-time={true}
                defaultValue={initialDate}
                required
                className="flatpickr-input w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
                placeholder="YYYY-MM-DD HH:mm"
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
            </div>
          </div>
          {/* Prioridad y categoría */}
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="block text-text-dark dark:text-text-light mb-1">Prioridad</label>
              <select
                name="prioridad"
                className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              >
                <option value="baja">Baja</option>
                <option value="media">Media</option>
                <option value="alta">Alta</option>
              </select>
            </div>
            {/* Categoría */}
            <div>
              <label className="block text-text-dark dark:text-text-light mb-1">Categoría</label>
              <select
                name="id_categoria_fk"
                className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              >
                <option value="">Selecciona…</option>
                {categorias.map((cat) => (
                  <option key={cat.id_categoria} value={cat.id_categoria}>
                    {cat.nombre}
                  </option>
                ))}
              </select>
            </div>
          </div>
          {/* Relacionar con evento */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">
              Relacionado a evento
            </label>
            <select
              name="id_evento_fk"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              defaultValue=""
            >
              <option value="">Ninguno</option>
              {eventos.map((ev) => (
                <option key={ev.id} value={ev.id}>
                  {ev.title}
                </option>
              ))}
            </select>
          </div>
          {/* Acciones */}
          <div className="flex justify-end space-x-2 mt-4">
            <button type="button" onClick={onClose} className="btn-secondary">
              Cancelar
            </button>
            <button type="submit" className="btn-primary">
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

// Reminder creation modal
function ReminderModal({ initialDate, onClose, onSwitch }) {
  async function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = {
      action: 'crear',
      mensaje: form.elements['mensaje'].value,
      fecha_hora: form.elements['fecha_hora'].value,
    };
    try {
      const res = await fetch('../backend/api/recordatorios.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('recordatoriosActualizados'));
        onClose();
      } else {
        console.error('Error al crear recordatorio:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch recordatorio:', err);
    }
  }

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.7)] dark:bg-[rgba(255,255,255,0.2)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg
                 w-full max-w-md mx-4 sm:mx-auto
                 max-h-[calc(100vh-4rem)] overflow-y-auto
                 animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <ModalHeader title="Crear Recordatorio" type="recordatorio" onSwitch={onSwitch} />
        <form className="space-y-4" onSubmit={handleSubmit}>
          {/* Mensaje */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Mensaje</label>
            <input
              name="mensaje"
              type="text"
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-accent"
              placeholder="¿Qué quieres recordar?"
              required
            />
          </div>
          {/* Fecha y hora */}
          <div>
            <label className="block text-text-dark dark:text-text-light mb-1">Fecha y hora</label>
            <div className="relative">
              <input
                name="fecha_hora"
                type="text"
                readOnly
                data-flatpickr
                data-enable-time={true}
                defaultValue={initialDate}
                required
                className="flatpickr-input w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
                placeholder="YYYY-MM-DD HH:mm"
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
            </div>
          </div>
          {/* Acciones */}
          <div className="flex justify-end space-x-2 mt-4">
            <button type="button" onClick={onClose} className="btn-secondary">
              Cancelar
            </button>
            <button type="submit" className="btn-tertiary">
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

// Main App component
function App() {
  const [modal, setModal] = useState({
    open: false,
    type: 'selector',
    date: null,
    existing: null,
  });

  // Estado para categorías
  const [categorias, setCategorias] = useState([]);

  // Estado para lista de eventos, cargada antes de abrir cualquier modal de tarea
  const [eventosList, setEventosList] = useState([]);

  // Cargar categorías al montar App
  useEffect(() => {
    fetch('../backend/api/categorias.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'listar' }),
    })
      .then((res) => res.json())
      .then((json) => {
        if (json.success) {
          setCategorias(json.data);
        } else {
          console.error('Error cargando categorías:', json.error);
        }
      })
      .catch((err) => console.error('Error de red al cargar categorías:', err));
  }, []);

  // Cargar eventos al montar App (una sola vez)
  useEffect(() => {
    fetch('../backend/api/eventos.php')
      .then((res) => res.json())
      .then((json) => {
        if (json.success) setEventosList(json.data);
        else console.error('Error cargando eventos:', json.error);
      })
      .catch((err) => console.error('Error de red al cargar eventos:', err));
  }, []);

  // Escuchar tanto openModal como los eventos de editar (evento, tarea y recordatorio)
  useEffect(() => {
    function handlerOpen(e) {
      const { type, dateStr } = e.detail || {};
      if (type) {
        // viene del sidebar select: abrir directamente ese modal
        setModal({ open: true, type, date: dateStr, existing: null });
      } else {
        // viene del botón “Crear…” o eventClick sin tipo: abrimos el selector
        setModal({ open: true, type: 'selector', date: dateStr, existing: null });
      }
    }
    function handlerEditarEvento(e) {
      setModal({
        open: true,
        type: 'evento',
        date: e.detail.fecha_inicio || e.detail.start || null,
        existing: {
          id: e.detail.id,
          title: e.detail.title,
          descripcion: e.detail.descripcion,
          fecha_inicio: e.detail.fecha_inicio || e.detail.start,
          fecha_fin: e.detail.fecha_fin || e.detail.end,
          ubicacion: e.detail.ubicacion,
          id_categoria: e.detail.id_categoria,
        },
      });
    }
    function handlerEditarTarea(e) {
      setModal({
        open: true,
        type: 'tarea',
        date: e.detail.fecha_vencimiento || null,
        existing: {
          id_tarea: e.detail.id,
          titulo: e.detail.titulo,
          descripcion: e.detail.descripcion,
          fecha_vencimiento: e.detail.fecha_vencimiento || e.detail.start,
          estado: e.detail.estado,
          prioridad: e.detail.prioridad,
          id_categoria_fk: e.detail.id_categoria_fk,
          id_evento_fk: e.detail.id_evento_fk,
        },
      });
    }
    function handlerEditarRecordatorio(e) {
      setModal({
        open: true,
        type: 'recordatorio',
        date: e.detail.fecha_hora || e.detail.start || null,
        existing: {
          id_recordatorio: e.detail.id_recordatorio,
          mensaje: e.detail.mensaje,
          fecha_hora: e.detail.fecha_hora || e.detail.start,
        },
      });
    }

    window.addEventListener('openModal', handlerOpen);
    window.addEventListener('openHelpModal', () => {
      setModal({ open: true, type: 'help', date: null, existing: null });
    });
    window.addEventListener('openModalEditarEvento', handlerEditarEvento);
    window.addEventListener('openModalEditarTarea', handlerEditarTarea);
    window.addEventListener('openModalEditarRecordatorio', handlerEditarRecordatorio);
    return () => {
      window.removeEventListener('openModal', handlerOpen);
      window.removeEventListener('openHelpModal', () => {});
      window.removeEventListener('openModalEditarEvento', handlerEditarEvento);
      window.removeEventListener('openModalEditarTarea', handlerEditarTarea);
      window.removeEventListener('openModalEditarRecordatorio', handlerEditarRecordatorio);
    };
  }, []);

  // Initialize Flatpickr on inputs when a non-selector modal opens
  useEffect(() => {
    if (modal.open && modal.type !== 'selector' && modal.type !== 'help') {
      // usamos setTimeout(..., 0) para garantizar que el DOM del modal ya esté montado
      setTimeout(() => {
        document.querySelectorAll('input[data-flatpickr]').forEach((input) => {
          flatpickr(input, {
            dateFormat: input.dataset.enableTime === 'true' ? 'Y-m-d H:i' : 'Y-m-d',
            enableTime: input.dataset.enableTime === 'true',
            allowInput: false, // ← impide caída al selector nativo
            theme: document.documentElement.classList.contains('dark') ? 'material_dark' : 'light',
            plugins: [new confirmDatePlugin({ confirmText: 'OK' })],
          });
        });
      }, 0);
    }
  }, [modal.open, modal.type]);

  if (!modal.open) return null;

  const common = {
    initialDate: modal.date,
    onClose: () => setModal({ ...modal, open: false, existing: null }),
    onSwitch: (t) => setModal({ open: true, type: t, date: modal.date, existing: null }),
  };

  switch (modal.type) {
    case 'selector':
      return (
        <ChooserModal
          onSelect={(t) => setModal({ open: true, type: t, date: modal.date, existing: null })}
          onHelp={() => setModal({ open: true, type: 'help', date: modal.date, existing: null })}
          onClose={common.onClose}
        />
      );
    case 'help':
      return (
        <HelpModal
          onBack={() =>
            setModal({ open: true, type: 'selector', date: modal.date, existing: null })
          }
          onClose={common.onClose}
        />
      );
    case 'evento':
      return modal.existing ? (
        <EditEventModal
          existing={modal.existing}
          onClose={common.onClose}
          categorias={categorias}
        />
      ) : (
        <EventModal {...common} categorias={categorias} existing={null} />
      );
    case 'tarea':
      return modal.existing ? (
        <EditTaskModal
          existing={modal.existing}
          eventos={eventosList} // ¡aquí pasamos la lista ya cargada!
          categorias={categorias}
          onClose={common.onClose}
        />
      ) : (
        <TaskModal
          {...common}
          categorias={categorias}
          eventos={eventosList} // opcional: para evitar otro fetch
          existing={null}
        />
      );
    case 'recordatorio':
      return modal.existing ? (
        <EditReminderModal existing={modal.existing} onClose={common.onClose} />
      ) : (
        <ReminderModal {...common} existing={null} />
      );
    default:
      return null;
  }
}

// Render the App into the #react-root div
ReactDOM.createRoot(document.getElementById('react-root')).render(<App />);
