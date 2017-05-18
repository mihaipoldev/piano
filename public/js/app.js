$(function() {
	$(document).on('click', '.ajax-choose-btn', function(event) {
		var $this = $(this),
			addUrl = $this.data('add-url'),
			removeUrl = $this.data('remove-url');

		if($this.hasClass('active')) {
			$.ajax({
				type: "GET",
				url: removeUrl,
				success: function(result) {
					$('#ajax-show-scales').html(result);
					$this.removeClass('active');
				}
			});
		}
		else {
			$.ajax({
				type: "GET",
				url: addUrl,
				success: function(result) {
					$('#ajax-show-scales').html(result);
					$this.addClass('active')
				}
			});
		}
	});
});

var selectScaleBtn = function($this) {
	$('#ajax-piano-app .choose .ajax-btn.active').removeClass('active');
	$this.addClass('active');
};
