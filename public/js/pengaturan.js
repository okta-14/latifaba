document.addEventListener("DOMContentLoaded", function () {
    const fileInputs = document.querySelectorAll(".custom-file-input");

    fileInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            let fileName = this.files[0].name;

            this.nextElementSibling.innerHTML = fileName;
        });
    });
});
