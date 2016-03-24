
function closeView()
{
	document.getElementById('viewTable').style.display='none';
	document.getElementById('viewForm').style.display='none';
}

function change()
{
	if (document.getElementById('pressIt').checked)
		document.getElementById('eNum').style.visibility='visible';
	else
		document.getElementById('eNum').style.visibility='hidden';
}


