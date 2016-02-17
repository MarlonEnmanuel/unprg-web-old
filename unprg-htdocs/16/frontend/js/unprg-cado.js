(function($){
	
	var Cado = function(options){
		this.options = $.extend({}, this.prototype.options, options);
	};

	Cado.getInputs = function(form){
		var base = this, ips = {};
		form = $(form);

		form.find('input[type=text], input[type=password], select, textarea').each(function(index, el) {
			var name = $(el).attr('name');
			var val = $(el).val().trim();
			form[name] = val;
		});
		form.find('input[type=checkbox]').each(function(index, el) {
			var name = $(el).attr('name');
			var val = $(el).is(':checked');
			form[name] = val;
		});
	};

	Cado.prototype.options = {
		textSending : 'Enviando ...'
	};



	if(!window.unprg) window.unprg ={};
	window.unprg.cado = Cado;
	
})(jQuery);