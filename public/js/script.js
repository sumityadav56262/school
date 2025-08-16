
const sidebar = document.querySelector('.menu');
const toggleBtn = document.getElementById('sidebarIcon');

// Load state from localStorage
if (localStorage.getItem('sidebarHidden') === 'true') {
    sidebar.classList.add('hide');
}

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
    // Save state
    localStorage.setItem('sidebarHidden', sidebar.classList.contains('hide'));
});