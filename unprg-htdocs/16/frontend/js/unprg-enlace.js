(function($){
	
	var Cado = {

		init : function(options, form){
			
		},

		enviar : function(data){
			var base = this;
			$.$.ajax({
				url: base.options.url,
				type: 'post',
				dataType: 'json',
				data: data,
				cache: false,
	            contentType: false,
		        processData: false
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}

	};

	if(!window.unprg) window.unprg ={};
	window.unprg.cado = Cado;
	
})(jQuery);