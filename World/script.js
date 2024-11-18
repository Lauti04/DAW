document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide'); 
    let currentIndex = 0; 

    function nextSlide() {
        slides.forEach(slide => slide.classList.remove('active'));
        currentIndex = (currentIndex + 1) % slides.length; 
        slides[currentIndex].classList.add('active');
    }

    function prevSlide() {
        slides.forEach(slide => slide.classList.remove('active'));
        currentIndex = (currentIndex - 1 + slides.length) % slides.length; 
        slides[currentIndex].classList.add('active');
    }

    // Mostrar el primer slide al cargar
    slides[currentIndex].classList.add('active');

    const leftArrow = document.querySelector('.arrow.left');
    const rightArrow = document.querySelector('.arrow.right');

    leftArrow.addEventListener('click', prevSlide);
    rightArrow.addEventListener('click', nextSlide);


    
    const menuToggle = document.getElementById('menuToggle'); 
    const menuOverlay = document.getElementById('menuOverlay');
    const closeMenu = document.getElementById('closeMenu');
    
    menuToggle.addEventListener('click', () => {
        console.log("hola");
        menuOverlay.classList.toggle('active2');
    });
    
    closeMenu.addEventListener('click', () => {
        menuOverlay.classList.remove('active2');
    });
    
    menuOverlay.addEventListener('click', (e) => {
        if (e.target === menuOverlay) {
            menuOverlay.classList.remove('active2'); 
        }
    });
    
    
});
