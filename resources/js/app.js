import "./bootstrap";
import "laravel-datatables-vite";
import $ from "jquery";
window.$ = $;
import "bootstrap/dist/css/bootstrap.min.css";

import select2 from "select2";

select2($);
$(".select2").select2({
    placeholder: "Pilih",
    theme: "bootstrap-5",
    width: "resolve",
    dropdownAutoWidth: true,
});
