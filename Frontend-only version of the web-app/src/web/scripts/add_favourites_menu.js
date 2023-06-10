function change_to_favourites()
{
	sessionStorage.setItem('current_menu', 'fav');
}
function change_to_all()
{
	sessionStorage.removeItem('current_menu');
}

window.addEventListener('load', function()
{
	let test=sessionStorage.getItem('current_menu');
	if(test)
	{
		let dropdown = document.getElementById('dropdown_body');
		let child=dropdown.lastChild;
		while(child)
		{
			child.remove();
			child=dropdown.lastChild;
		}
		let favourites_=JSON.parse(localStorage.getItem('favourites'));
		if (favourites_!= null) 
		{
			for(let i=0; i<favourites_.length; i++)
			{
				let class_button = document.createElement('li');
				class_button.classList.add('menu_element', 'favourite_class');
				class_button.setAttribute('id', favourites_[i]+'_button');
				
				let class_button_link = document.createElement('a');
				class_button_link.setAttribute('href', 'favourites.html#'+favourites_[i]);
				class_button_link.classList.add('menu_link');
				class_button_link.textContent = favourites_[i].toUpperCase();

				class_button.appendChild(class_button_link);

				dropdown.appendChild(class_button);
			}
		}
		let all_button = document.createElement('li');
		all_button.classList.add('menu_element');

		let all_button_link = document.createElement('a');
		all_button_link.setAttribute('href', 'classes.html');
		all_button_link.setAttribute('onclick', 'change_to_all()');
		all_button_link.textContent = 'WSZYSTKIE';

		all_button.appendChild(all_button_link);

		dropdown.appendChild(all_button);
	}
	else
	{
		let favourites_button = document.createElement('li');
		favourites_button.classList.add('menu_element');

		let favourites_button_link = document.createElement('a');
		favourites_button_link.setAttribute('href', 'favourites.html');
		favourites_button_link.setAttribute('onclick', 'change_to_favourites()');
		favourites_button_link.textContent = 'ULUBIONE';

		favourites_button.appendChild(favourites_button_link);

		let dropdown = document.getElementById('dropdown_body');
		dropdown.appendChild(favourites_button);
	}
});