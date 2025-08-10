document.addEventListener('DOMContentLoaded', () => {
  const searchBtn = document.querySelector('#search-btn');
  const searchBar = document.querySelector('.search-bar-container');
  const formBtn = document.querySelector('#login-btn');
  const loginPopup = document.getElementById('login-popup');
  const registerPopup = document.getElementById('register-popup');
  const loginClose = document.getElementById('login-close');
  const registerClose = document.getElementById('register-close');
  const showRegister = document.getElementById('show-register');
  const showLogin = document.getElementById('show-login');
  const loginForm = document.getElementById('login-form');
  const loginMessage = document.getElementById('login-message');
  const registerForm = document.getElementById('register-form');
  const menu = document.querySelector('#menu-bar');
  const navbar = document.querySelector('.navbar');
  const videoBtn = document.querySelectorAll('.vid-btn');

  window.onscroll = () => {
    searchBtn.classList.remove('fa-times');
    searchBar.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    loginPopup.classList.remove('active');
    registerPopup.classList.remove('active');
  };

  menu.addEventListener('click', () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
  });

  searchBtn.addEventListener('click', () => {
    searchBtn.classList.toggle('fa-times');
    searchBar.classList.toggle('active');
  });

  // Open login popup
  formBtn.addEventListener('click', () => {
    loginPopup.classList.add('active');
    registerPopup.classList.remove('active');
  });

  // Switch to register popup
  showRegister.addEventListener('click', (e) => {
    e.preventDefault();
    loginPopup.classList.remove('active');
    registerPopup.classList.add('active');
  });

  // Switch back to login popup
  showLogin.addEventListener('click', (e) => {
    e.preventDefault();
    registerPopup.classList.remove('active');
    loginPopup.classList.add('active');
  });

  // Close popups
  loginClose.addEventListener('click', () => {
    loginPopup.classList.remove('active');
  });
  registerClose.addEventListener('click', () => {
    registerPopup.classList.remove('active');
  });

  // Login form submit
  loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(loginForm);
    fetch('login.php', { method: 'POST', body: formData })
      .then(res => res.text())
      .then(text => {
        loginMessage.textContent = text;
        loginMessage.style.color = text.includes("successful") ? 'green' : 'red';
        if (text.includes("successful")) loginForm.reset();
      })
      .catch(err => {
        loginMessage.textContent = "Error occurred.";
        loginMessage.style.color = 'red';
      });
  });

  // Register form clear after submit
  registerForm.addEventListener('submit', function() {
    setTimeout(() => this.reset(), 100);
  });

  videoBtn.forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelector('.controls .active').classList.remove('active');
      btn.classList.add('active');
      let src = btn.getAttribute('data-src');
      document.querySelector('#video-slider').src = src;
    });
  });

  new Swiper(".review-slider", {
    spaceBetween: 20, loop: true, autoplay: { delay: 2500, disableOnInteraction: false },
    breakpoints: { 640:{slidesPerView:1}, 768:{slidesPerView:2}, 1024:{slidesPerView:3} }
  });
  new Swiper(".brand-slider", {
    spaceBetween: 20, loop: true, autoplay: { delay: 2500, disableOnInteraction: false },
    breakpoints: { 640:{slidesPerView:3}, 768:{slidesPerView:4}, 1024:{slidesPerView:6} }
  });
});
