<!-- Menú flotante de redes sociales -->
<div class="floating-social">
    <!-- Contenedor de íconos (se despliega/contrae) -->
    <div class="social-menu">
        <a href="https://facebook.com" target="_blank" class="social-link" title="Facebook">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="https://www.instagram.com/ro_customcookies?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="social-link" title="Instagram">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.tiktok.com/?lang=es" target="_blank" class="social-link" title="Instagram">
            <i class="bi bi-tiktok"></i>
        </a>
    </div>
    <!-- Botón para togglear el menú, sin clases btn de Bootstrap -->
    <button class="social-toggle" aria-label="Mostrar redes sociales">
        <i class="bi bi-share-fill"></i>
    </button>
</div>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/34608948329" target="_blank" class="floating-whatsapp" aria-label="Chatea por WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>


<link rel="stylesheet" href="../assets/css/socials.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const socialToggle = document.querySelector('.floating-social .social-toggle');
        const socialContainer = document.querySelector('.floating-social');

        socialToggle.addEventListener('click', function() {
            socialContainer.classList.toggle('show');
        });
    });
</script>