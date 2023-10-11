document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function darkMode() {

    const prefiereDarMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (prefiereDarMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    prefiereDarMode.addEventListener('chage', function() {
        if (prefiereDarMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        } 
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive)

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}
function mostrarMetodosContacto(evento) {
    const contactoDiv = document.querySelector('#contacto');

    if (evento.target.value === 'telefono') {
        contactoDiv.innerHTML = `
                <label for="telefono">Número Telfono</label>
                <input type="tel" placeholder="Tu E-mail" id="telefono" name="contacto[telefono]">

                <p>Elija la fecha y hora a la que desea ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="17:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email" name="contacto[email]" required>
        `;
    }
} 
