$(document).ready(function(){
	var app = Sammy('#main', function() {

		this.get('#/', function() {
			alert("home");
		});
		this.get('#/dropbox', function() {
			alert("dropbox");
		});
		this.get('#/upload', function() {
			alert("upload");
		});
		this.get('#/login', function() {
			alert("login");
		});
	});

	app.run('#/');
});
