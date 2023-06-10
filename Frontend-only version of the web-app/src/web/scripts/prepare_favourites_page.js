function change_to_all()
{
	sessionStorage.removeItem('current_menu');
}

window.addEventListener('load', function()
{
	let favourites_ = JSON.parse(localStorage.getItem("favourites"));

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

			let dropdown = document.getElementById('dropdown_body');
			dropdown.appendChild(class_button);
			
			let class_element = document.createElement('article');
			class_element.classList.add('general_content_box');
			class_element.setAttribute('id', favourites_[i]);
			class_element.innerHTML = localStorage.getItem(favourites_[i]);
			
			let parent_node = document.getElementsByTagName('main')[0];
			parent_node.appendChild(class_element);
		}
	}

	let all_button = document.createElement('li');
	all_button.classList.add('menu_element');

	let all_button_link = document.createElement('a');
	all_button_link.setAttribute('href', 'classes.html');
	all_button_link.setAttribute('onclick', 'change_to_all()');
	all_button_link.textContent = 'WSZYSTKIE';

	all_button.appendChild(all_button_link);

	let dropdown = document.getElementById('dropdown_body');
	dropdown.appendChild(all_button);
});

