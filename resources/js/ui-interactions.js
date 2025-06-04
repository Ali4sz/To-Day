window.initThemeToggle = () => {
    const themeToggleButton = document.querySelector(".theme-toggle");
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", () => {
            document.body.classList.toggle("dark-mode");
            if (document.body.classList.contains("dark-mode")) {
                themeToggleButton.textContent = "🌙";
            } else {
                themeToggleButton.textContent = "☀️";
            }
        });
    }
};

window.initFooterYear = () => {
    const yearSpan = document.getElementById("currentYear");
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }
};
