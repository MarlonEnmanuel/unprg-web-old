(function($){
	
	var Cado = {

		init : function(options, form){
			
		},

		submit : function(){

		}

	};

	$.fn.unprgCado = function(options){
		return this.each(function(index, el) {
			if($(el).data('cado-init')===true){
				return false;
			}
			$(el).data('cado-init', true);
			var cado = Object.create(Cado);
			cado.init(options, el);
			$.data(el, 'unprgCado', cado);
		});
	};

})(jQuery);