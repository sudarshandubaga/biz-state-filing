import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Dropdown functionality
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    dropdownToggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const parent = this.closest(".nav-item");
            const isOpen = parent.classList.contains("show");

            // Close all other dropdowns
            document
                .querySelectorAll(".nav-item.show")
                .forEach(function (item) {
                    item.classList.remove("show");
                });

            // Toggle current dropdown
            if (!isOpen) {
                parent.classList.add("show");
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".nav-item")) {
            document
                .querySelectorAll(".nav-item.show")
                .forEach(function (item) {
                    item.classList.remove("show");
                });
        }
    });

    // Close dropdowns when pressing Escape
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            document
                .querySelectorAll(".nav-item.show")
                .forEach(function (item) {
                    item.classList.remove("show");
                });
        }
    });

    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const navbarNav = document.querySelector(".navbar-nav");

    if (mobileMenuToggle && navbarNav) {
        mobileMenuToggle.addEventListener("click", function () {
            navbarNav.classList.toggle("mobile-open");
            this.classList.toggle("active");
        });
    }
});
