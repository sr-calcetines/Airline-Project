const path2 = window.location.pathname.startsWith('/planes') ? 'planes' : window.location.pathname.split('/').pop();

function showPlane()
{
    const rows = document.querySelectorAll(".row");

    for (let i = 0; i < rows.length; i++) 
    {
        rows[i].addEventListener("click", () =>
        {
            window.location.href = `/planes/show/${rows[i].id}`;
        });
    }
}

if (path2 === "planes" || path2 === "") 
{
    showPlane();
}
