function change_to_dark()
{
	let root = document.querySelector(':root');
	root.style.setProperty('--main_element_color', '#9EC8D1');
	root.style.setProperty('--navigation_text_color', 'black');
	root.style.setProperty('--general_text_color', 'white');
	root.style.setProperty('--theme_color', '#185B69');
}

function change_to_bright()
{
	let root = document.querySelector(':root');
	root.style.setProperty('--main_element_color', 'white');
	root.style.setProperty('--navigation_text_color', '#185B69');
	root.style.setProperty('--general_text_color', 'black');
	root.style.setProperty('--theme_color', '#9EC8D1');
}

function change()
{
	let test=localStorage.getItem('mode');
	if(test!=null)
	{
		change_to_bright();
		localStorage.removeItem('mode');
	}
	else
	{
		change_to_dark();
		localStorage.setItem('mode', 'dark');
	}
}

window.addEventListener('load', function()
{
	let test2=localStorage.getItem('mode');
	if(test2!=null)
	{
		change_to_dark();
	}
	else
	{
		change_to_bright();
	}		
});
		