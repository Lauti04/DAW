document.addEventListener('DOMContentLoaded', function () {
  // Función principal para establecer el activo
  function setActiveState() {
    const currentPath = window.location.pathname;
    const currentHash = window.location.hash;
    const isHomePage = document.body.classList.contains('homepage');

    document.querySelectorAll('.nav-link').forEach(link => {
      const linkUrl = link.href;
      const linkObj = new URL(linkUrl);
      
      // Resetear siempre primero
      link.classList.remove('active');
      
      if (isHomePage) {
        // Lógica para homepage
        const linkHash = linkObj.hash;
        if (currentHash) {
          // Coincidencia exacta de hash
          if (linkHash === currentHash) {
            link.classList.add('active');
          }
        } else {
          // Si no hay hash, activar "Inicio"
          if (linkHash === '#inicio' || linkUrl.endsWith('home.php')) {
            link.classList.add('active');
          }
        }
      } else {
        // Lógica para otras páginas
        if (linkObj.pathname === currentPath) {
          link.classList.add('active');
        }
      }
    });
  }

  // Aplicar estado inicial
  setActiveState();

  // Smooth Scroll mejorado para homepage
  if (document.body.classList.contains('homepage')) {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const target = document.querySelector(targetId);
        
        if (target) {
          const headerHeight = document.querySelector('nav.navbar').offsetHeight;
          const targetPosition = target.offsetTop - headerHeight;
          
          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });
          
          history.replaceState(null, null, targetId);
          setActiveState();
        }
      });
    });
  }

  // Intersection Observer optimizado
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && entry.intersectionRatio >= 0.5) {
        const currentHash = `#${entry.target.id}`;
        
        document.querySelectorAll('.nav-link').forEach(link => {
          const linkHash = new URL(link.href).hash;
          link.classList.toggle('active', linkHash === currentHash);
        });
      }
    });
  }, {
    threshold: 0.5,
    rootMargin: '-100px 0px -35% 0px'
  });

  // Observar solo las secciones del homepage
  if (document.body.classList.contains('homepage')) {
    document.querySelectorAll('section[id]').forEach(section => {
      observer.observe(section);
    });
  }

  // Manejar cambios de hash
  window.addEventListener('hashchange', setActiveState);

  // Cerrar menú móvil al hacer click (código original preservado)
  const navbarCollapse = new bootstrap.Collapse('#navbarNav', { toggle: false });
  document.addEventListener('click', (e) => {
    if (window.innerWidth < 992) {
      const target = e.target.closest('.nav-link, .dropdown-item');
      if (!target) return;

      const navbarCollapse = bootstrap.Collapse.getInstance('#navbarNav');
      if (!navbarCollapse) return;

      const isDropdownTrigger = target.classList.contains('dropdown-toggle');
      const isDropdownItem = target.classList.contains('dropdown-item');

      if (!isDropdownTrigger && (isDropdownItem || !target.closest('.dropdown'))) {
        setTimeout(() => navbarCollapse.hide(), 100);
      }
    }
  });

  // Precarga de imágenes del slider (código original preservado)
  const preloadSliderImages = () => {
    const slider = document.querySelector('.home-slider');
    const images = document.querySelectorAll('.carousel-item img');

    if (images.length) {
      let loaded = 0;
      const checkLoaded = () => ++loaded === images.length && (slider.style.opacity = '1');

      images.forEach(img => {
        if (img.complete) checkLoaded();
        else img.addEventListener('load', checkLoaded);
      });
    }
  };

  // Animación de captions (código original preservado)
  const animateCaptions = () => {
    const carousel = document.getElementById('carouselExampleCaptions');
    if (carousel) {
      const animate = el => {
        el.classList.remove('animate');
        void el.offsetWidth;
        el.classList.add('animate');
      };

      animate(carousel.querySelector('.carousel-item.active .caption-inner'));
      carousel.addEventListener('slid.bs.carousel', e => animate(e.relatedTarget.querySelector('.caption-inner')));
    }
  };

  // Inicialización de componentes
  preloadSliderImages();
  animateCaptions();

  // Forzar actualización inicial para sección visible al cargar
  setTimeout(() => {
    if (document.body.classList.contains('homepage')) {
      const visibleSection = document.querySelector('section[id]:not([style*="display: none"])');
      if (visibleSection) {
        observer.observe(visibleSection);
      }
    }
  }, 500);
});