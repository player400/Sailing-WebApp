window.addEventListener('load', function()
{
	var articles = document.getElementsByClassName('general_content_box');
	console.log(articles.length);
	for(let i=0; i<articles.length; i++)
	{
		let button = document.createElement('button');
		button.classList.add('fav_button');
		button.setAttribute('id', articles[i].id+'_button');
		if(localStorage.getItem(articles[i].id)===null)
		{
			button.textContent = 'Dodaj do ulubionych';
			button.setAttribute('onclick', 'add_favourite(this.parentNode)');
			articles[i].appendChild(button);
		}
		else
		{
			button.textContent = 'Usuń z ulubionych';
			button.setAttribute('onclick', 'remove_favourite(this.parentNode)');
			articles[i].appendChild(button);
			distinguish(articles[i]);
		}
	}
});


