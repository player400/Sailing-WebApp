let form_contents = {
	name: '',
	email: '',
	license: '',
	date: '',
	subject: '',
	content: '',
}

function read_form()
{

	form_contents.email=document.getElementById('mail').value;
	form_contents.name=document.getElementById('name').value;
	let choice = document.getElementsByName('license');
	for(let i=0; i<choice.length; i++)
	{
			if(choice[i].checked)
			{
				form_contents.license=choice[i].value;
			}
	}
	form_contents.date=document.getElementById('date').value;
	form_contents.subject=document.getElementById('sbjt').value;
	form_contents.content=document.getElementById('msg').value;
	console.log('The form has been readed:');
	console.log(form_contents);
}

function check_adress(adress)
{
	if(adress.includes('@'))
	{
		let splitted = adress.split('@');
		if(splitted.length>2)
		{
			return false;
		}
		
		if(splitted[0].length<1)
		{
			return false;
		}
		if(splitted[1].includes('.'))
		{
			return true;
		}
	}
	return false;
}

function validate()
{
	let result='';
	read_form();
	if(!check_adress(form_contents.email))
	{
		result=result+'E-mail, ';
	}
	if(form_contents.name==='')
	{
		result=result+'Imię, ';
	}
	if(form_contents.license==='yes'&&form_contents.date==='')
	{
		result=result+'Data uzyskania patentu, '
	}
	if(form_contents.subject==='not_chosen')
	{
		result=result+'Temat, ';
	}
	if(form_contents.content==='')
	{
		result=result+'Wiadomość, ';
	}
	console.log(result);
	if(result!='')
	{
		event.preventDefault();
		$("#error_list").text(result.slice(0, -2));
		$("#validation_dialog").dialog("open");
	}
}

function clear_all()
{
	remove_preview();
	
	form_contents.email='';
	form_contents.name='';
	form_contents.license='';
	form_contents.date='';
	form_contents.subject='';
	form_contents.content='';
	
	sessionStorage.removeItem('form_contents');
}

window.addEventListener('unload', function() {
	read_form();
	sessionStorage.setItem('form_contents', JSON.stringify(form_contents));
});

window.addEventListener('load', function()
{
	let new_form_contents = JSON.parse(sessionStorage.getItem('form_contents'));
	if(new_form_contents)
	{
		form_contents=new_form_contents;
	}

	if(form_contents.name!='')
	{
		document.getElementById('name').value=form_contents.name;
	}
	if(form_contents.email!='')
	{
		document.getElementById('mail').value=form_contents.email;
	}
	if(form_contents.date!='')
	{
		document.getElementById('date').value=form_contents.date;
	}
	if(form_contents.content!='')
	{
		document.getElementById('msg').value=form_contents.content;
	}
	if(form_contents.subject!='')
	{
		document.getElementById('sbjt').value=form_contents.subject;
	}
	if(form_contents.license!='')
	{
		let choice = document.getElementsByName('license');
		for(let i=0; i<choice.length; i++)
		{
				if(choice[i].value===form_contents.license)
				{
					choice[i].setAttribute('checked', '');
				}
		}
	}

	const date = new Date();
	let year = date.getYear();
	year=year+1900;
	let month = date.getMonth();
	month=month+1;
	let day = date.getDate();
	let today = year+'-'+month+'-'+day;
	let datepicker = document.getElementById('date');
	datepicker.setAttribute('max', today);

	$( "#validation_dialog" ).dialog({
		autoOpen: false,
		resizable: false,
		show: {
			effect: "blind",
			duration: 100
		},
		buttons: {
			"Popraw dane": function(){
				$(this).dialog("close");
			}
		}	
	});

	$('#mail').mailtip({
		mails: ['gmail.com', 'wp.pl', 'outlook.com', 'onet.pl', 'interia.pl', 'gazeta.pl', 'o2.pl'],
	});
});

