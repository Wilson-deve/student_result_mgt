

document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector("body");
    const modeToggle = body.querySelector(".mode-toggle");
    const sidebar = body.querySelector("nav");
    const sidebarToggle = body.querySelector(".sidebar-toggle");

    // Check for saved preferences
    const savedMode = localStorage.getItem("mode");
    let savedSidebarState = localStorage.getItem("sidebarState");

    // Apply saved preferences
    if (savedMode) {
        body.classList.add(savedMode);
    }
    
    if (savedSidebarState === "close") {
        sidebar.classList.add("close");
    }

    // Dark mode toggle
    modeToggle.addEventListener("click", () => {
        body.classList.toggle("dark");
        const currentMode = body.classList.contains("dark") ? "dark" : "light";
        localStorage.setItem("mode", currentMode);
    });

    // Sidebar toggle
    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        const currentSidebarState = sidebar.classList.contains("close") ? "close" : "";
        localStorage.setItem("sidebarState", currentSidebarState);
    });
});

$(document).ready(function(){
    // Jquery for toggle sub menus
    $('.sub-btn').click(function(){
        // Hide all other open sub-menus
        $('.sub-btn.active').not(this).removeClass('active');
        $('.sub-menu:visible').not($(this).next('.sub-menu')).slideUp();

        // Toggle the selected sub-menu
        $(this).toggleClass('active');
        $(this).next('.sub-menu').slideToggle();
    });
});

const lightboxTrigger = document.getElementById('lightbox-trigger');
const lightbox = document.getElementById('lightbox');
const closeLightbox = document.getElementById('close-lightbox');

lightboxTrigger.addEventListener('click', (e) => {
    e.preventDefault();
    lightbox.style.display = 'flex';
});

closeLightbox.addEventListener('click', () => {
    lightbox.style.display = 'none';
});

lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
        lightbox.style.display = 'none';
    }
});


function togglePasswordVisibility(inputId, iconId) {
    var passwordInput = document.getElementById(inputId);
    var icon = document.getElementById(iconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
