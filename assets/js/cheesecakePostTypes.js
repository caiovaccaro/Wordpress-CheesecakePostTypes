jQuery(function($) {

	var Cheese = {};

	Cheese.Start = function() {

		if($('body').hasClass('wp-admin')) {

			$.each(Cheese.PostTypes, function(i,v) {
		        var func = i;
		        if(typeof Cheese.PostTypes[func] !== 'undefined' && func !== 'init' && typeof Cheese.PostTypes[func] === 'function') Cheese.PostTypes[func]();
		    });

		}

	};

	Cheese.PostTypes = {

		chosenMultiselect: function() {

			$.each($('.chzn-select'), function() {

				var max = $(this).attr('max');

				if(!$(this).hasClass('chzn-done') && $(this).is(':visible')) $(this).chosen({no_results_text: "No results", width: '100%'});

				if(typeof max !== 'undefined' && max !== false) {
					$(this).change(function() {
						var selected = $(this).find('option:selected').length;

						if(selected == max) {
							$(this).find('option:not(:selected)').prop('disabled', true);
							$(this).trigger('liszt:updated');
						} else {
							$(this).find('option').prop('disabled', false);
							$(this).trigger('liszt:updated');
						}
					});
				}

			});
		}

	};

	Cheese.Start();

});