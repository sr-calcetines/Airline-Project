const path = window.location.pathname.split('/').pop();

function showNewFlight()
{
	const rows = document.querySelectorAll(".row");

	for (let i = 0; i < rows.length; i++) 
	{

		rows[i].addEventListener("click", () =>
		{
			window.location.href = `/flights/show/${rows[i].id}`;;
	  	});
	}
}

if (!path)
	{
		showNewFlight();
	}
	