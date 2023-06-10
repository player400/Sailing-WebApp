function remove_preview()
{
	let preview = document.getElementById('preview');
	if(preview!=null)
	{
		preview.remove();
	}
}

window.addEventListener('load', function()
{
	document.getElementById('zal').addEventListener('change', function (){
		let file = document.getElementById('zal').files[0];
		const file_reader = new FileReader();
		console.log(file);
		if(file)
		{
			file_reader.readAsDataURL(file);
		}
		file_reader.onload = function(){
			let attachment=file_reader.result;
			console.log(attachment);
			
			remove_preview();
			
			let new_preview = document.createElement('img');
			new_preview.setAttribute('id', 'preview');
			new_preview.setAttribute('alt', 'Podgląd pliku nie jest dostępny');
			new_preview.setAttribute('src', attachment);
			let attachment_cell = document.getElementById('zal').parentElement;
			attachment_cell.appendChild(new_preview);
		}
	});
});