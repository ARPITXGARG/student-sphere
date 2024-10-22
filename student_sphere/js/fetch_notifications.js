document.addEventListener("DOMContentLoaded", function() {
    fetch('php/fetch_notifications.php')
        .then(response => response.json())
        .then(data => {
            const notificationsDiv = document.getElementById('notifications');
            notificationsDiv.innerHTML = data.map(notification => `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${notification.title}</h5>
                            <p class="card-text">${notification.message}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        });
});
