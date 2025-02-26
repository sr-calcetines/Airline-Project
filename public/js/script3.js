const path3 = window.location.pathname.startsWith('/flights/past') ? 'flights/past' : window.location.pathname.split('/').pop();

function showPastFlight()
{
    const rows = document.querySelectorAll(".row");

    for (let i = 0; i < rows.length; i++) 
    {
        rows[i].addEventListener("click", () =>
        {
            window.location.href = `/flights/show/${rows[i].id}`;
        });
    }
}

if (path3 === "flights/past" || path2 === "") 
{
    showPastFlight();
}

function openUserReservations(flightId) {
    fetch(`/flights/${flightId}/reservations`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#reservationTable tbody');
            tbody.innerHTML = ''; 
            if (data.length > 0) {
                data.forEach(function(reservation) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${reservation.user_id}</td>
                        <td>${reservation.user_name}</td>
                        <td>${reservation.user_email}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="3">There are no reservations for this flight.</td></tr>';
            }
            document.getElementById('reservationModal').style.display = 'flex';
        })
        .catch(error => console.error('Error fetching reservations:', error));
}

function closeReservationModal() {
    document.getElementById('reservationModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('reservationModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}