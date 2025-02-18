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
