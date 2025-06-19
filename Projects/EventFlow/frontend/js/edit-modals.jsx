/** frontend/js/edit-modals.jsx **/

// Nota: ya no hacemos destructuring de React (useState/useEffect) aquí,
// para evitar duplicar la declaración cuando Babel in‐browser cargue varios archivos.

// Modal para editar un evento existente.
function EditEventModal({ existing, onClose, categorias }) {
  // 1) Formatea el valor inicial para eliminar segundos y zona
  const formatInitial = (d) => {
    if (!d) return '';
    // quita “T”, zona y segundos: "2025-06-19T17:00:00+02:00" → "2025-06-19 17:00"
    const cleaned = d.replace('T', ' ').replace(/\+\d{2}:\d{2}$/, '');
    return cleaned.slice(0, 16);
  };

  const [fechaInicio, setFechaInicio] = React.useState(formatInitial(existing.fecha_inicio));
  const [fechaFin, setFechaFin] = React.useState(formatInitial(existing.fecha_fin));
  const [dateError, setDateError] = React.useState(false);
  const [submitError, setSubmitError] = React.useState('');
  const refInicio = React.useRef(null);
  const refFin = React.useRef(null);

  // Valida fechas
  React.useEffect(() => {
    if (fechaInicio && fechaFin) {
      const startDate = new Date(fechaInicio.replace(' ', 'T'));
      const endDate = new Date(fechaFin.replace(' ', 'T'));
      setDateError(startDate > endDate);
    } else {
      setDateError(false);
    }
  }, [fechaInicio, fechaFin]);

  // Flatpickr SOLO al montar
  React.useEffect(() => {
    if (refInicio.current) {
      flatpickr(refInicio.current, {
        dateFormat: 'Y-m-d H:i',
        enableTime: true,
        defaultDate: fechaInicio || null,
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
        defaultDate: fechaFin || null,
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

  // Editar evento con validación real
  async function handleSubmit(e) {
    e.preventDefault();
    setSubmitError('');
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
      action: 'editar',
      id_evento: existing.id,
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
        setSubmitError(json.error || 'Error al editar evento');
        console.error('Error al editar evento:', json.error);
      }
    } catch (err) {
      setSubmitError('Error en fetch editar evento');
      console.error('Error en fetch editar evento:', err);
    }
  }

  const handleDelete = async () => {
    if (!confirm('¿Estás seguro de que deseas eliminar este evento?')) return;
    try {
      const res = await fetch('../backend/api/eventos.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'borrar', id_evento: existing.id }),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('eventosActualizados'));
        onClose();
      } else {
        setSubmitError(json.error || 'Error al borrar evento');
        console.error('Error al borrar evento:', json.error);
      }
    } catch (err) {
      setSubmitError('Error en fetch borrar evento');
      console.error('Error en fetch borrar evento:', err);
    }
  };

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.7)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg w-full max-w-md mx-4 sm:mx-auto max-h-[calc(100vh-4rem)] overflow-y-auto animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light mb-4 flex items-center space-x-2">
          <i className="fas fa-calendar-alt" />
          <span>Editar Evento</span>
        </h2>
        <form id="edit-event-form" onSubmit={handleSubmit} autoComplete="off">
          {/* Título */}
          <div className="mb-4">
            <label htmlFor="titulo" className="block text-text-dark dark:text-text-light mb-1">
              Título
            </label>
            <input
              type="text"
              name="titulo"
              id="titulo"
              defaultValue={existing.title}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              required
            />
          </div>
          {/* Descripción */}
          <div className="mb-4">
            <label htmlFor="descripcion" className="block text-text-dark dark:text-text-light mb-1">
              Descripción
            </label>
            <textarea
              name="descripcion"
              id="descripcion"
              rows="3"
              defaultValue={existing.descripcion}
              className="max-h-40 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          {/* Fecha de inicio */}
          <div className="mb-4">
            <label
              htmlFor="fecha_inicio"
              className="block text-text-dark dark:text-text-light mb-1"
            >
              Fecha y hora de inicio
            </label>
            <div className="relative">
              <input
                type="text"
                readOnly
                name="fecha_inicio"
                id="fecha_inicio"
                ref={refInicio}
                value={fechaInicio}
                className="bg-secondary w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-primary"
                required
                onChange={() => {}} // evita warning
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
            </div>
          </div>
          {/* Fecha fin */}
          <div className="mb-4">
            <label htmlFor="fecha_fin" className="block text-text-dark dark:text-text-light mb-1">
              Fecha y hora de fin
            </label>
            <div className="relative">
              <input
                type="text"
                readOnly
                name="fecha_fin"
                id="fecha_fin"
                ref={refFin}
                value={fechaFin}
                className="bg-secondary w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-primary"
                onChange={() => {}} // evita warning
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
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
          <div className="mb-4">
            <label htmlFor="ubicacion" className="block text-text-dark dark:text-text-light mb-1">
              Ubicación
            </label>
            <input
              type="text"
              name="ubicacion"
              id="ubicacion"
              defaultValue={existing.ubicacion}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
            />
          </div>
          {/* Categoría */}
          <div className="mb-6">
            <label
              htmlFor="id_categoria"
              className="block text-text-dark dark:text-text-light mb-1"
            >
              Categoría
            </label>
            <select
              name="id_categoria"
              id="id_categoria"
              defaultValue={existing.id_categoria}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
            >
              {categorias.map((cat) => (
                <option key={cat.id_categoria} value={cat.id_categoria}>
                  {cat.nombre}
                </option>
              ))}
            </select>
          </div>
          {/* Botones */}
          <div className="flex flex-wrap gap-2 justify-end">
            <button
              type="button"
              onClick={onClose}
              className="btn-secondary flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Cancelar
            </button>
            <button
              type="submit"
              className="btn-primary flex-1 sm:flex-none py-2 px-4 text-sm"
              disabled={dateError}
            >
              Guardar
            </button>
            <button
              type="button"
              onClick={handleDelete}
              className="btn-tertiary text-white flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Eliminar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

// Modal para editar una tarea existente.
function EditTaskModal({ existing, eventos, categorias, onClose }) {
  // Estado para el evento seleccionado, inicializado con el valor de la BBDD
  const [selectedEvento, setSelectedEvento] = React.useState(String(existing.id_evento_fk || ''));

  // Envío del formulario: incluye id_evento_fk desde el estado controlado
  async function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = {
      action: 'editar',
      id_tarea: existing.id_tarea,
      titulo: form.elements['titulo'].value,
      descripcion: form.elements['descripcion'].value,
      fecha_vencimiento: form.elements['fecha_vencimiento'].value,
      prioridad: form.elements['prioridad'].value,
      id_categoria_fk: form.elements['id_categoria_fk'].value || null,
      id_evento_fk: selectedEvento || null,
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
        console.error('Error al editar tarea:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch editar tarea:', err);
    }
  }

  // Función para borrar la tarea
  const handleDelete = async () => {
    if (!confirm('¿Estás seguro de que deseas eliminar esta tarea?')) return;
    try {
      const res = await fetch('../backend/api/tareas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'borrar', id_tarea: existing.id_tarea }),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('tareasActualizadas'));
        onClose();
      } else {
        console.error('Error al borrar tarea:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch borrar tarea:', err);
    }
  };

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.7)]"
      onClick={onClose}
    >
      <div
        className="bg-card dark:bg-dark p-6 rounded-lg w-full max-w-md mx-4 sm:mx-auto
                   max-h-[calc(100vh-4rem)] overflow-y-auto animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light mb-4 flex items-center space-x-2">
          <i className="fas fa-tasks" />
          <span>Editar Tarea</span>
        </h2>
        <form id="edit-task-form" onSubmit={handleSubmit}>
          {/* Título */}
          <div className="mb-4">
            <label htmlFor="titulo" className="block text-text-dark dark:text-text-light mb-1">
              Título
            </label>
            <input
              type="text"
              name="titulo"
              id="titulo"
              defaultValue={existing.titulo}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md
                         bg-secondary dark:bg-dark text-text-dark dark:text-text-light
                         focus:outline-none focus:ring-2 focus:ring-primary"
              required
            />
          </div>

          {/* Descripción */}
          <div className="mb-4">
            <label htmlFor="descripcion" className="block text-text-dark dark:text-text-light mb-1">
              Descripción
            </label>
            <textarea
              name="descripcion"
              id="descripcion"
              rows="3"
              defaultValue={existing.descripcion}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md
                         bg-secondary dark:bg-dark text-text-dark dark:text-text-light
                         focus:outline-none focus:ring-2 focus:ring-primary max-h-40"
            />
          </div>

          {/* Fecha de vencimiento */}
          <div className="mb-4">
            <label
              htmlFor="fecha_vencimiento"
              className="block text-text-dark dark:text-text-light mb-1"
            >
              Fecha de vencimiento
            </label>
            <div className="relative">
              <input
                type="text"
                readOnly
                name="fecha_vencimiento"
                id="fecha_vencimiento"
                data-flatpickr
                data-enable-time="true"
                defaultValue={existing.fecha_vencimiento}
                className="bg-secondary w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded
                           focus:outline-none focus:ring-2 focus:ring-primary text-text-dark dark:text-text-light"
                required
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
            </div>
          </div>

          {/* Prioridad */}
          <div className="mb-4">
            <label htmlFor="prioridad" className="block text-text-dark dark:text-text-light mb-1">
              Prioridad
            </label>
            <select
              name="prioridad"
              id="prioridad"
              defaultValue={existing.prioridad}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md
                         bg-secondary dark:bg-dark text-text-dark dark:text-text-light
                         focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="baja">Baja</option>
              <option value="media">Media</option>
              <option value="alta">Alta</option>
            </select>
          </div>

          {/* Categoría */}
          <div className="mb-4">
            <label
              htmlFor="id_categoria_fk"
              className="block text-text-dark dark:text-text-light mb-1"
            >
              Categoría
            </label>
            <select
              name="id_categoria_fk"
              id="id_categoria_fk"
              defaultValue={existing.id_categoria_fk || ''}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md
                         bg-secondary dark:bg-dark text-text-dark dark:text-text-light
                         focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="">Selecciona…</option>
              {categorias.map((cat) => (
                <option key={cat.id_categoria} value={cat.id_categoria}>
                  {cat.nombre}
                </option>
              ))}
            </select>
          </div>

          {/* Relacionar con evento */}
          <div className="mb-6">
            <label
              htmlFor="id_evento_fk"
              className="block text-text-dark dark:text-text-light mb-1"
            >
              Relacionar con evento
            </label>
            <select
              name="id_evento_fk"
              id="id_evento_fk"
              value={selectedEvento}
              onChange={(e) => setSelectedEvento(e.target.value)}
              className="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md
                         bg-secondary dark:bg-dark text-text-dark dark:text-text-light
                         focus:outline-none focus:ring-2 focus:ring-primary"
            >
              <option value="">— Ninguno —</option>
              {eventos.map((ev) => (
                <option key={ev.id} value={ev.id}>
                  {ev.title}
                </option>
              ))}
            </select>
          </div>

          {/* Botones */}
          <div className="flex flex-wrap gap-2 justify-end">
            <button
              type="button"
              onClick={onClose}
              className="btn-secondary flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Cancelar
            </button>
            <button type="submit" className="btn-primary flex-1 sm:flex-none py-2 px-4 text-sm">
              Guardar
            </button>
            <button
              type="button"
              onClick={handleDelete}
              className="btn-tertiary text-white flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Eliminar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

// Modal para editar un recordatorio existente.
function EditReminderModal({ existing, onClose }) {
  async function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const data = {
      action: 'editar',
      id_recordatorio: existing.id_recordatorio,
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
        console.error('Error al editar recordatorio:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch editar recordatorio:', err);
    }
  }

  const handleDelete = async () => {
    if (!confirm('¿Estás seguro de que deseas eliminar este recordatorio?')) return;
    try {
      const res = await fetch('../backend/api/recordatorios.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'borrar', id_recordatorio: existing.id_recordatorio }),
      });
      const json = await res.json();
      if (json.success) {
        window.dispatchEvent(new CustomEvent('recordatoriosActualizados'));
        onClose();
      } else {
        console.error('Error al borrar recordatorio:', json.error);
      }
    } catch (err) {
      console.error('Error en fetch borrar recordatorio:', err);
    }
  };

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.7)]"
      onClick={onClose}
    >
      <div
        className=" bg-card dark:bg-dark p-6 rounded-lg w-full max-w-md mx-4 sm:mx-auto max-h-[calc(100vh-4rem)] overflow-y-auto animate-fade-in"
        onClick={(e) => e.stopPropagation()}
      >
        <h2 className="text-2xl font-heading text-text-dark dark:text-text-light mb-4 flex items-center space-x-2">
          <i className="fas fa-bell" />
          <span>Editar Recordatorio</span>
        </h2>
        <form id="edit-reminder-form" onSubmit={handleSubmit}>
          {/* Mensaje */}
          <div className="mb-4">
            <label htmlFor="mensaje" className="block text-text-dark dark:text-text-light mb-1">
              Mensaje
            </label>
            <textarea
              name="mensaje"
              id="mensaje"
              rows="2"
              defaultValue={existing.mensaje}
              className="max-h-40 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-secondary dark:bg-dark text-text-dark dark:text-text-light focus:outline-none focus:ring-2 focus:ring-primary"
              required
            />
          </div>
          {/* Fecha y hora */}
          <div className="mb-6">
            <label htmlFor="fecha_hora" className="block text-text-dark dark:text-text-light mb-1">
              Fecha y hora
            </label>
            <div className="relative">
              <input
                type="text"
                readOnly // ← evita el picker nativo
                name="fecha_hora"
                id="fecha_hora"
                data-flatpickr
                data-enable-time="true"
                defaultValue={existing.fecha_hora}
                className="bg-secondary w-full pl-10 p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-primary text-text-dark dark:text-text-light"
                required
              />
              <i className="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-dark dark:text-text-light" />
            </div>
          </div>
          {/* Botones: Cancelar, Guardar y Eliminar en la misma línea */}
          <div className="flex flex-wrap gap-2 justify-end">
            <button
              type="button"
              onClick={onClose}
              className="btn-secondary flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Cancelar
            </button>
            <button type="submit" className="btn-primary flex-1 sm:flex-none py-2 px-4 text-sm">
              Guardar
            </button>
            <button
              type="button"
              onClick={handleDelete}
              className="btn-tertiary text-white flex-1 sm:flex-none py-2 px-4 text-sm"
            >
              Eliminar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
