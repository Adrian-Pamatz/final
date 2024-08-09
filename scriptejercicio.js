document.addEventListener('DOMContentLoaded', function() {
    const editFormContainer = document.getElementById('editFormContainer');
    const editForm = document.getElementById('editForm');
    const editmedicoid = document.getElementById('editmedicoid');
    const editName = document.getElementById('editName');
    const editareamedica = document.getElementById('editareamedica');
    const edittelefono = document.getElementById('edittelefono');
    const editañosexperiencia = document.getElementById('editañosexperiencia');

    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            editmedicoid.value = this.dataset.medicoid;
            editName.value = this.dataset.name;
            editareamedica.value = this.dataset.areamedica;
            edittelefono.value = this.dataset.telefono;
            editañosexperiencia.value = this.dataset.añosexperiencia;
            editFormContainer.style.display = 'block';
        });
    });

    editForm.addEventListener('submit', function(e) {
        if (!confirm('¿Está seguro de que desea actualizar los datos del medico??')) {
            e.preventDefault();
        }
    });

    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('¿Está seguro de que desea eliminar los datos del Medico??')) {
                e.preventDefault();
            }
        });
    });
});
