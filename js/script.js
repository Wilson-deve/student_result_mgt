
const modal = document.querySelector('.modal');
const overlay = document.querySelector('.overlay');
const btnOpenModal = document.querySelector('.btn--show-modal');
const btnCloseModal = document.querySelector('.btn--close-modal');
const btnShowStudentPortalModal = document.querySelectorAll('.btn--show-student-portal-modal');
const btnCloseStudenPortaltModal = document.querySelector('.btn--close-student-portal-modal');
const studentPortalModal = document.querySelector('.modal1');
const studentPortalOverlay = document.querySelector('.overlay1');

// Modal window

const OpenModal = function (e){
    e.preventDefault();
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
};

const closeModal = function (){
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
};

const openStudentPortalModal = function (e){
    e.preventDefault();
    studentPortalModal.classList.remove('hidden1');
    studentPortalOverlay.classList.remove('hidden1');
};

const closeStudentPortalModal = function (){
    studentPortalModal.classList.add('hidden1');
    studentPortalOverlay.classList.add('hidden1');
}

btnOpenModal.addEventListener('click', OpenModal);
btnCloseModal.addEventListener('click', closeModal);
btnShowStudentPortalModal.forEach(btn => btn.addEventListener('click', openStudentPortalModal));
// btnShowStudentPortalModal.addEventListener('click', openStudentPortalModal);
btnCloseStudenPortaltModal.addEventListener('click', closeStudentPortalModal);
overlay.addEventListener('click', closeModal);
studentPortalOverlay.addEventListener('click', closeStudentPortalModal);

document.addEventListener('keydown', function (e){
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
    }
    if (e.key === 'Escape' && !studentPortalModal.classList.contains('hidden1')) {
        closeStudentPortalModal();
    }
});

// /////////////////////////////////////////////////////////
// button scrolling
const btnScrollTo = document.querySelector('.btn--scroll-to');
const section1 = document.querySelector('#section--1');

btnScrollTo.addEventListener('click', function (e){
    const s1coords = section1.getBoundingClientRect();
    section1.scrollIntoView({ behavior: 'smooth'});
});

// /////////////////////////////////////////////////////////
// slider
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    const dotsContainer = document.querySelector('.dots');
    const dots = [];
    let currentSlide = 0;
    let intervalId = null;
    let isMouseOverSlider = false; // Flag to track mouseover state

    function showSlide(n) {
        slides.forEach((slide, index) => {
            if (index === n) {
                slide.classList.add('active');
        
            } else {
                slide.classList.remove('active');
                 
            }
        });
        currentSlide = n;
        updateDots();


          // Update slide content visibility
        slides[currentSlide].querySelector('.slide-content-wrapper').style.opacity = 1;

        // Reset opacity for other slide content
        slides.forEach((slide, index) => {
            if (index !== currentSlide) {
                slide.querySelector('.slide-content-wrapper').style.opacity = 0;
            }
        });
    
    }

    function showNextSlide() {
        showSlide((currentSlide + 1) % slides.length);
    }

    function showPrevSlide() {
        showSlide((currentSlide - 1 + slides.length) % slides.length);
    }

    function createDots() {
        for (let i = 0; i < slides.length; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.addEventListener('click', () => showSlide(i));
            dotsContainer.appendChild(dot);
            dots.push(dot);
        }
    }

    function updateDots() {
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    createDots();
    updateDots();

    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');

    nextButton.addEventListener('click', showNextSlide);
    prevButton.addEventListener('click', showPrevSlide);

    function startSlider() {
        if (!isMouseOverSlider) { // Check if mouse is not over the slider
            intervalId = setInterval(showNextSlide, 5000);
        }
    }

    function stopSlider() {
        clearInterval(intervalId);
    }

    // Start the slider initially
    showSlide(0);
    startSlider();

    // Toggle the mouseover flag when mouse enters and leaves the slider area
    const sliderArea = document.querySelector('.slider');
    sliderArea.addEventListener('mouseover', () => {
        isMouseOverSlider = true;
        stopSlider();
    });
    sliderArea.addEventListener('mouseleave', () => {
        isMouseOverSlider = false;
        startSlider();
    });
});

// /////////////////////////////////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
    const testimonials = document.querySelectorAll('.testimonial');
  
    testimonials.forEach(testimonial => {
      testimonial.addEventListener('click', () => {
        console.log('test');
        if (testimonial.classList.contains('active')) {
          testimonial.classList.remove('active');
        } else {
          testimonials.forEach(item => {
            item.classList.remove('active');
          });
          testimonial.classList.add('active');
        }
      });
    });
  });
  

// ////////////////////////////////////////////////
const nav = document.querySelector('.nav');
const navHeight = nav.getBoundingClientRect().height;

const toggleStickyNav = function () {
    if (window.scrollY > navHeight) {
        nav.classList.add('sticky');
    } else {
        nav.classList.remove('sticky');
    }
};

window.addEventListener('scroll', toggleStickyNav);



// ///////////////////////////////////////////////
// page navigation
document.querySelector('.nav__links').addEventListener('click', function (e){
    e.preventDefault();
    
    if (e.target.classList.contains('nav__link')) {
        const id = e.target.getAttribute('href');
        document.querySelector(id).scrollIntoView({behavior: 'smooth'});
    }
});
document.querySelector('.nav__links').addEventListener('click', function (e){
    e.preventDefault();
    
    if (e.target.classList.contains('nav__link')) {
        const id = e.target.getAttribute('href'); 
        if (id.startsWith('#')) {
            
            document.querySelector(id).scrollIntoView({ behavior: 'smooth' });
        }
    }
});
document.querySelector('.nav__links').addEventListener('click', function (e){
    e.preventDefault();
    
    if (e.target.classList.contains('nav__link')) {
        const id = e.target.getAttribute('href');
        console.log('id:', id); 
        if (id && id.startsWith('#')) {
            const targetElement = document.querySelector(id);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            } else {
                console.error('Element not found:', id); 
            }
        }
    }
});


// ///////////////////////////////////////////////
// menu fedu animation
const handleHover = function (e){
    if (e.target.classList.contains('nav__link')) {
        const link = e.target;
        const siblings = link.closest('.nav').querySelectorAll('.nav__link');
        const logo = link.closest('.nav').querySelector('img');

        siblings.forEach(el => {
            if (el !== link) el.style.opacity = this
        });
        logo. style.opacity = this;
    }
};

nav.addEventListener('mouseover', handleHover.bind(0.5));
nav.addEventListener('mouseout', handleHover.bind(1));

// ///////////////////////////////////////////////////
// Reveal sections
const allSections = document.querySelectorAll('.section');
const revealSection = function (entries, observer){
    const [entry] = entries;

    if (!entry.isIntersecting) return;
    entry.target.classList.remove('section--hidden');
    observer.unobserve(entry.target);
};

const sectionObserver = new IntersectionObserver(revealSection, {
    root: null,
    threshold: 0.15,
});

allSections.forEach(function (section){
    sectionObserver.observe(section);
    section.classList.add('section--hidden');
});
// ///////////////////////////////////////////////////////////////////////////////////
// Scroll top button event
const scrollBtn = document.querySelector('.btn--scroll-to-top');

window.addEventListener('scroll', () => {
  if (window.scrollY > 300) {  
    scrollBtn.style.display = 'block';
  } else {
    scrollBtn.style.display = 'none';
  }
});

scrollBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const passwordInput = document.getElementById("password");
const passwordToggle = document.getElementById("password-toggle");
const passwordLabel = document.getElementById("password-label");

passwordToggle.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggle.classList.remove("fa-eye-slash");
    passwordToggle.classList.add("fa-eye");
  } else {
    passwordInput.type = "password";
    passwordToggle.classList.remove("fa-eye");
    passwordToggle.classList.add("fa-eye-slash");
  }
  
});
// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

function hideMessage() {
    var messageContainer = document.getElementById("error-message");
    if (messageContainer) {
        setTimeout(function() {
            messageContainer.style.display = "none";
        }, 5000); 
    }
}


window.onload = hideMessage;








        
        