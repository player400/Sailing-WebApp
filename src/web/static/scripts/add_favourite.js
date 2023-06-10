function distinguish(article)
{
	let button = article.lastChild;
	button.classList.add('active');
	document.querySelector('#'+article.id).style.border = 'solid 3px var(--general_link_color)';
}

function not_distinguish(article)
{
	let button = article.lastChild;
	button.classList.remove('active');
	document.querySelector('#'+article.id).style.border = '0';
}

function remove_favourite(article)
{	
	let favourites = [];
	
	if(localStorage.getItem("favourites")!=null)
	{
		favourites=JSON.parse(localStorage.getItem("favourites"));
		localStorage.removeItem("favourites");
	}
	
	
	let id=article.id;
	
	
	for(let i=0; i<favourites.length; i++)
	{
		if(favourites[i]===id)
		{
			favourites.splice(i, 1);
		}
	}
	
	localStorage.setItem("favourites", JSON.stringify(favourites))
	
	
	localStorage.removeItem(id);
	
	
	var favourite_class_buttons = document.getElementsByClassName('favourite_class');
	
	if(favourite_class_buttons.length===0)
	{
		let add_button=document.getElementById(id+'_button');
		add_button.textContent = 'Dodaj do ulubionych';
		add_button.setAttribute('onclick', 'add_favourite(this.parentNode)');
		not_distinguish(article);
	}
	else
	{
		let button_to_be_removed = document.getElementById(id+'_button');
		button_to_be_removed.remove();
		
		let article_to_be_removed = document.getElementById(id);
		article_to_be_removed.remove();
	}

	console.log(favourites);
}

function add_favourite(article)
{

	let id=article.id;
	
	let favourites = [];
	
	if(localStorage.getItem("favourites")!=null)
	{
		favourites=JSON.parse(localStorage.getItem("favourites"));
		favourites[favourites.length] = id;
		localStorage.removeItem("favourites");
	}
	else
	{
		favourites[0] = id;
	}
	
	let rem_button=document.getElementById(id+'_button');
	rem_button.textContent = 'Usuń z ulubionych';
	rem_button.setAttribute('onclick', 'remove_favourite(this.parentNode)');
	
	localStorage.setItem("favourites", JSON.stringify(favourites));
	localStorage.setItem(id, article.innerHTML);
	distinguish(article);
	console.log(favourites);
	
}

