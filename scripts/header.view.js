$(document).ready(function(){
	HeaderView = Backbone.View.extend({
		el:"header",
		initialize: function(){
			$.get("user/isIn",{},function(isIn){
				if (isIn) {
					$("header .buttons").load("tpl/isIn.tpl.html");
				} else {
					$("header .buttons").load("tpl/isNotIn.tpl.html");
				}
			},"json");
		},
		events: {
			"click .login":"login"
		},
		login:function(){
			$("#modal").load("tpl/login.tpl.html",.slideDown();
		}
	});
	
	var header = new HeaderView;
});
