
const sidebar = document.querySelector('.menu');

document.getElementById('sidebarIcon').addEventListener('click', function () {
    sidebar.classList.toggle('hide');

    // Save state to server (optional, via fetch)
    fetch("/sidebar").catch(error => {
        console.error('Error:', error);
    });
});
