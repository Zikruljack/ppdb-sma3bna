import "./bootstrap";

import $ from "jquery";
window.$ = $;

import select2 from "select2";

import "laravel-datatables-vite";

select2($);
$(".select2").select2({
    placeholder: "Pilih",
    theme: "bootstrap-5",
    width: "resolve",
    dropdownAutoWidth: true,
});
