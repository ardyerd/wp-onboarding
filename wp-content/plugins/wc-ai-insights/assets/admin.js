document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("#wcai-generate-form");
    const button = document.querySelector("#wcai-generate-button");
    const loading = document.querySelector(".wcai-loading");

    if (!form || !button) return;

    form.addEventListener("submit", function () {

        // Disable button
        button.disabled = true;
        button.textContent = "Generating Insight...";

        // Show loading spinner
        if (loading) {
            loading.style.display = "inline-block";
        }
    });

});
