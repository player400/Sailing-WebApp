function back()
{
	history.back();
}

window.addEventListener('load', function()
{
	let button = document.createElement('div')
	button.setAttribute('id', 'close');
	button.setAttribute('onclick', 'back()');
	button.textContent = 'POWRÓT';
	let body = document.getElementsByTagName('body')[0];
	body.appendChild(button);
});