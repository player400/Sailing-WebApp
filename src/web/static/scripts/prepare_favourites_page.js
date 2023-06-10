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
			let class_element = document.createElement('article');
			class_element.classList.add('general_content_box');
			class_element.setAttribute('id', favourites_[i]);
			class_element.innerHTML = localStorage.getItem(favourites_[i]);
			
			let parent_node = document.getElementsByTagName('main')[0];
			parent_node.appendChild(class_element);
		}
	}
});

