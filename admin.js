document.addEventListener('DOMContentLoaded', function() {
    fetchStatistics();
});

function fetchStatistics() {
    fetch('admin.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('clientCount').textContent = data.clientCount;
            document.getElementById('workerCount').textContent = data.workerCount;
            document.getElementById('approvedWorkerCount').textContent = data.approvedWorkerCount;
        })
        .catch(error => console.error('Error fetching statistics:', error));
}
