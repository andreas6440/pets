require("./bootstrap");
import Swal from "sweetalert2";

$(".datepicker").datepicker({
    format: "yyyy-mm-dd",
});
$(document).ready(function () {
    window.deleteConfirm = function (href) {
        Swal.fire({
            icon: "warning",
            text: "¿Quieres borrar esto?",
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            confirmButtonColor: "#e3342f",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    };
});
