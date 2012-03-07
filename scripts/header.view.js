$(document).ready(function(){
	HeaderView = Backbone.View.extend({
		el:"header",
		initialize: function(){
			this.render();
		},
		events: {
			"click .login":"login"
		},
		render:function(){
			console.log(this.el);
			return this;
		},
		login:function(){
			
		}
	});
	
	var header = new HeaderView;
});
