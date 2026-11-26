import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';
window.bootstrap = bootstrap;
window.Swal = Swal;

window.toast = (title, icon = 'success') =>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon,
        title,
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (t) => {
            t.onmouseenter = Swal.stopTimer;
            t.onmouseleave = Swal.resumeTimer;
        }
    })