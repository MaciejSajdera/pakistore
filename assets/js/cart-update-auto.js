window.addEventListener("DOMContentLoaded", event => {
	var timeout;
	jQuery(function($) {
		$(".woocommerce").on("change", "input.qty", function() {
			if (timeout !== undefined) {
				clearTimeout(timeout);
			}

			timeout = setTimeout(function() {
				$("[name='update_cart']").trigger("click");
			}, 0); // 1 second delay, half a second (500) seems comfortable too
		});
	});
});
