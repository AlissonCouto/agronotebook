import "./bootstrap";
import TomSelect from "tom-select";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".tom-select").forEach((el) => {
        new TomSelect(el, {
            plugins: ["remove_button"],
            create: false,
            sortField: {
                field: "text",
                direction: "asc",
            },
        });
    });
});
