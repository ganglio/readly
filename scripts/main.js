$(document).ready(function(){
	var library=$.jStorage.get("library");
	
	if (!library) {
		$.get("library/getbooks",{},function(books){
			$.jStorage.set("library",books);
			library=books;
		},"json");
	}
});
