import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Dropdown functionality for standard dropdowns and mega menus
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    dropdownToggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const parent = this.closest(".nav-item");
            if (!parent) return;

            const isOpen = parent.classList.contains("show");

            // Close all other dropdowns/mega-menus at the same level
            document
                .querySelectorAll(".navbar-nav > .nav-item.show")
                .forEach(function (item) {
                    if (item !== parent) {
                        item.classList.remove("show");
                    }
                });

            // Toggle current dropdown
            if (!isOpen) {
                parent.classList.add("show");
            } else {
                parent.classList.remove("show");
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

        // Close mobile menu when a non-dropdown link is clicked
        navbarNav
            .querySelectorAll(".nav-link:not(.dropdown-toggle)")
            .forEach(function (link) {
                link.addEventListener("click", function () {
                    navbarNav.classList.remove("mobile-open");
                    mobileMenuToggle.classList.remove("active");
                });
            });
    }

    // Handle sub-dropdown toggles on mobile (touch devices)
    const subDropdownToggles = document.querySelectorAll(".nav-link-sub");
    subDropdownToggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            // Only handle on mobile
            if (window.innerWidth < 1024) {
                e.preventDefault();
                const parent = this.closest(".nav-item-sub");
                if (parent) {
                    parent.classList.toggle("show");
                }
            }
        });
    });
});
