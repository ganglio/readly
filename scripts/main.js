$(document).ready(function(){
	// Load current library
	var library=$.jStorage.get("library");
	
	// Update library
	$.ajax({
		"url":"library/getbooks",
		"type":"get",
		"timeout":5000,
		"dataType":"json",
		"beforeSend":function(){
			$("#trobbler").fadeIn("fast");
		},
		"success":function(books){
			$.jStorage.set("library",books);
			library=books;
		},
		"error":function(){
			console.log("error");
		},
		"complete":function(){
			for (var i in library)
				$("section").append('<article class="book"><img class="cover" src="'+library[i].cover+'" /><h2>'+library[i].author+'</h2><h1>'+library[i].title+'</h1></article>');
			$("#trobbler").fadeOut("fast");
		}
	});
	
	
});
