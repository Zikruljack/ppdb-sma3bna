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

document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua elemen input file dalam halaman
    const fileInputs = document.querySelectorAll('input[type="file"]');

    // Daftar tipe file yang diperbolehkan
    const allowedTypes = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "application/pdf",
    ];

    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener("change", function (event) {
            const file = event.target.files[0]; // Ambil file yang diunggah
            if (!file) return; // Jika tidak ada file, keluar

            // Cek tipe file
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: "error",
                    title: "Jenis File Tidak Didukung",
                    text: "Silakan unggah file dengan format JPEG, JPG, PNG, atau PDF.",
                });
                fileInput.value = ""; // Kosongkan input file
                return;
            }

            // Cek ukuran file (maksimal 2MB)
            const maxSizeInMB = 2;
            if (file.size > maxSizeInMB * 1024 * 1024) {
                Swal.fire({
                    icon: "error",
                    title: "Ukuran File Terlalu Besar",
                    text: `Ukuran file melebihi batas maksimal ${maxSizeInMB}MB.`,
                });
                fileInput.value = ""; // Kosongkan input file
                return;
            }

            // Jika semua validasi lolos, berikan notifikasi sukses
            Swal.fire({
                icon: "success",
                title: "File Valid",
                text: "File berhasil diunggah. Anda dapat melanjutkan proses.",
            });
        });
    });
});
