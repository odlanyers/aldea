import './bootstrap';

document.querySelector('#logout').addEventListener('click', function (event) {
    event.preventDefault();
    
    document.querySelector('#form-logout').submit();
});

// Seleccionar todos los checkboxes
document.querySelector('#chk-select-all').addEventListener('change', function () {
    const checkboxes = document.querySelectorAll('.chk-selection');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = this.checked;
    });
});

// Validar que al menos un checkbox y una opción del selector de categorías se haya seleccionado antes de mandar el formulario
document.querySelector('#frm-categorize').addEventListener('submit', function(event) {
    const checkboxes = document.querySelectorAll('.form-check-input');
    const categorySelector = document.querySelector('#category-selector');
    let control = false;

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            control = true;
        }
    });

    if (!categorySelector.selectedIndex) {
        control = false;
    }

    if (!control) {
        event.preventDefault();
        alert('Debes seleccionar al menos un gasto y la categoría que deseas asignar.');
        return;
    }
});
