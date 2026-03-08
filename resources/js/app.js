import "./bootstrap";
import TomSelect from "tom-select";

import Alpine from "alpinejs";

window.Alpine = Alpine;

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
