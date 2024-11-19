document.addEventListener("DOMContentLoaded", function () {
    const contMenu = document.querySelector(".cont-menu");
    const iconoMenu = document.querySelector(".icono-menu");
    
    // Manejador del menú desplegable
    iconoMenu.addEventListener("click", function () {
        contMenu.classList.toggle("active");

        if (contMenu.classList.contains("active")) {
            const opacityDiv = document.createElement("div");
            opacityDiv.className = "opacity";
            opacityDiv.style.position = "fixed";
            opacityDiv.style.width = "100%";
            opacityDiv.style.height = "100%";
            opacityDiv.style.top = "0";
            opacityDiv.style.left = "0";
            opacityDiv.style.zIndex = "99";

            document.body.appendChild(opacityDiv);

            opacityDiv.addEventListener("click", function () {
                contMenu.classList.remove("active");
                document.body.removeChild(opacityDiv);
            });
        } else {
            const opacityDiv = document.querySelector(".opacity");
            if (opacityDiv) {
                document.body.removeChild(opacityDiv);
            }
        }
    });
});
