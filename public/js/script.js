
const sidebar = document.querySelector('.menu');

document.getElementById('sidebarIcon').addEventListener('click', function () {
    sidebar.classList.toggle('hide');

    // Save state to server (optional, via fetch)
    fetch("/sidebar").catch(error => {
        console.error('Error:', error);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.autoDismissAlert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 4000);
    });
});