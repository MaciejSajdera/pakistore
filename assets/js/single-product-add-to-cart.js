window.addEventListener("DOMContentLoaded", event => {
	const productTypeVariable = document.querySelector(".variations_form");

	const singleAddToCartWithQty = document.querySelector(
		"#my_simple_add_to_cart_ajax"
	);

	// .single_add_to_cart_button

	const allStarLinks = document.querySelectorAll(".star-link");
	const reviewsTab = document.querySelector(".reviews_tab a");

	if (allStarLinks) {
		allStarLinks.forEach(starlink => {
			starlink.addEventListener("click", e => {
				e.preventDefault();

				reviewsTab.scrollIntoView({
					behavior: "smooth",
					block: "center"
				});

				reviewsTab.click();
			});
		});
	}

	const formCart = document.querySelector("form.cart");

	formCart.addEventListener("click", function(e) {
		const qty = this.querySelector(".qty");

		console.log(e.target);
		console.log(qty);

		const val = parseFloat(qty.value);
		console.log(val);

		const max = parseFloat(qty.getAttribute("max"));
		const min = parseFloat(qty.getAttribute("min"));
		const step = parseFloat(qty.getAttribute("step"));

		if (
			e.target.closest("BUTTON") &&
			e.target.closest("BUTTON").classList.contains("plus")
		) {
			singleAddToCartWithQty.classList.remove("added");

			if (max && max <= val) {
				qty.value = max;
			} else {
				qty.value = val + step;
			}
		}

		if (
			e.target.closest("BUTTON") &&
			e.target.closest("BUTTON").classList.contains("minus")
		) {
			singleAddToCartWithQty.classList.remove("added");

			if (min && min >= val) {
				qty.value = min;
			} else if (val > 1) {
				qty.value = val - step;
			}
		} else {
			return;
		}

		singleAddToCartWithQty.setAttribute("data-quantity", qty.value);
	});

	// const qtyInput = document.querySelector(".input-text");

	// if (!productTypeVariable) {
	// 	qtyInput.addEventListener("change", e => {
	// 		console.log("change");
	// 		singleAddToCartWithQty.setAttribute("data-quantity", e.target.value);
	// 	});
	// }
});
