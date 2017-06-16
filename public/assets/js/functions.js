var insert = function(title, text){
	$('button').text('Enviando...').attr('disabled','disabled');
	$.ajax({
		headers: {
  		'X-Csrf-Token': $('meta[name="csrftoken"]').attr('content')
  	},
		type: "POST",
    url: "/ajax/posts/newpost",
    data: { title : title, text : text },
	  dataType: "JSON",
    success: function(data){
      if(data == true){
				alert('Dados salvos com sucesso!');
			} else {
				alert('Algum erro ocorreu! Tente novamente mais tarde.');
			}
			$('button').text('Enviar').removeAttr('disabled');
    }
	});
}

var update = function(id, title, text){
	$('button').text('Enviando...').attr('disabled','disabled');
	$.ajax({
		headers: {
  		'X-Csrf-Token': $('meta[name="csrftoken"]').attr('content')
  	},
		type: "POST",
    url: "/ajax/posts/updatepost",
    data: { id : id, title : title, text : text },
	  dataType: "JSON",
    success: function(data){
      if(data == true){
				alert('Dados salvos com sucesso!');
			} else {
				alert('Algum erro ocorreu! Tente novamente mais tarde.');
			}
			$('button').text('Enviar').removeAttr('disabled');
    }
	});
}
