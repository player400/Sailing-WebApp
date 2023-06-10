function back()
{
	history.back();
}

window.addEventListener('load', function()
{
	var button = document.createElement('div')
	button.setAttribute('id', 'close');
	button.setAttribute('onclick', 'back()');
	button.textContent = 'POWRÓT';
	var body = document.getElementsByTagName('body')[0];
	body.removeChild(body.firstChild);
	body.appendChild(button);
});