import {
	removeEmptyParagraphs,
	isElementInViewport
} from "../js/helperFunctions";

window.addEventListener("DOMContentLoaded", event => {
	// .single_add_to_cart_button

	const allStarLinks = document.querySelectorAll(".star-link");
	const reviewsTab = document.querySelector("#reviews");

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

	const singleAddToCartWithQty = document.querySelector(
		"#my_simple_add_to_cart_ajax"
	);

	const quantityControls = document.querySelector(".quantity-controls");
	let isPopUpActive = false;

	const showMaxQtyPopUp = () => {
		let maxQtyPopUp = document.createElement("DIV");
		maxQtyPopUp.classList.add("pop-up");

		let maxQtyArrow = document.createElement("SPAN");
		maxQtyArrow.classList.add("pop-up__arrow");

		let maxQtyParagraph = document.createElement("P");
		maxQtyParagraph.innerText = "Osiągnięto maksymalną dostępną ilość";

		maxQtyPopUp.appendChild(maxQtyArrow);
		maxQtyPopUp.appendChild(maxQtyParagraph);
		quantityControls.appendChild(maxQtyPopUp);

		setTimeout(() => {
			maxQtyPopUp.style.opacity = 1;
		}, 100);

		isPopUpActive = true;
	};

	document.addEventListener("click", e => {
		if (
			(isPopUpActive && !e.target.closest("BUTTON")) ||
			(isPopUpActive &&
				e.target.closest("BUTTON") &&
				!e.target.closest("BUTTON").classList.contains("plus"))
		) {
			let maxQtyPopUp = document.querySelector(".pop-up");

			maxQtyPopUp ? (maxQtyPopUp.style.opacity = 0) : "";

			setTimeout(() => {
				maxQtyPopUp.remove();
				isPopUpActive = false;
			}, 300);
		}
	});

	const formTypeVariable = document.querySelector("form.variations_form");

	formTypeVariable &&
		formTypeVariable.addEventListener("click", function(e) {
			const qty = this.querySelector(".qty");
			const val = parseFloat(qty.value);
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
					qty.setAttribute("value", max);
				} else {
					qty.value = val + step;
					qty.setAttribute("value", parseFloat(val + step));
				}

				if (max === val && !isPopUpActive) {
					showMaxQtyPopUp();
				}
			}

			if (
				e.target.closest("BUTTON") &&
				e.target.closest("BUTTON").classList.contains("minus")
			) {
				singleAddToCartWithQty.classList.remove("added");

				if (min && min >= val) {
					qty.value = min;
					qty.setAttribute("value", min);
				} else if (val > 1) {
					qty.value = parseFloat(val - step);
					qty.setAttribute("value", parseFloat(val - step));
				}
			} else {
				return;
			}

			singleAddToCartWithQty.setAttribute("data-quantity", qty.value);
		});

	const formTypeSingle = document.querySelector("form.single-product_form");

	formTypeSingle &&
		formTypeSingle.addEventListener("click", function(e) {
			const qty = this.querySelector(".qty");

			const val = parseFloat(qty.getAttribute("value"));
			const max = parseFloat(qty.getAttribute("max"));
			const min = parseFloat(qty.getAttribute("min"));
			const step = parseFloat(qty.getAttribute("step"));

			if (
				e.target.classList.contains("plus") ||
				(e.target.closest("BUTTON") &&
					e.target.closest("BUTTON").classList.contains("plus"))
			) {
				singleAddToCartWithQty &&
				singleAddToCartWithQty.classList.contains("added")
					? singleAddToCartWithQty.classList.remove("added")
					: "";

				if (max && max <= val) {
					qty.setAttribute("value", max);
					qty.value = max;
					singleAddToCartWithQty.setAttribute("data-quantity", parseFloat(max));
				} else {
					qty.setAttribute("value", parseFloat(val + step));
					qty.value = parseFloat(val + step);
					singleAddToCartWithQty.setAttribute(
						"data-quantity",
						parseFloat(val + step)
					);
				}

				if (max === val && !isPopUpActive) {
					showMaxQtyPopUp();
				}
			}

			if (
				e.target.classList.contains("minus") ||
				(e.target.closest("BUTTON") &&
					e.target.closest("BUTTON").classList.contains("minus"))
			) {
				singleAddToCartWithQty &&
				singleAddToCartWithQty.classList.contains("added")
					? singleAddToCartWithQty.classList.remove("added")
					: "";

				if (min && min >= val) {
					qty.setAttribute("value", min);
					qty.value = min;
				} else if (val > 1) {
					qty.setAttribute("value", parseFloat(val - step));
					qty.value = parseFloat(val - step);
				}

				singleAddToCartWithQty.setAttribute(
					"data-quantity",
					parseFloat(val - step)
				);
			}

			// if (!productTypeVariable) {
			// singleAddToCartWithQty.setAttribute("data-quantity", qty.value);
			// }
		});

	const qtyInput = document.querySelector(".quantity input");

	qtyInput &&
		qtyInput.addEventListener("change", function(e) {
			const val = parseFloat(this.getAttribute("value"));
			const max = parseFloat(this.getAttribute("max"));
			const min = parseFloat(this.getAttribute("min"));
			const step = parseFloat(this.getAttribute("step"));

			if (max && max <= e.target.value) {
				this.setAttribute("value", max);
				this.value = max;
			}

			if (min && min > e.target.value) {
				this.setAttribute("value", min);
				this.value = min;
			} else {
				this.setAttribute("value", e.target.value);
				this.value = e.target.value;
				singleAddToCartWithQty.setAttribute("data-quantity", e.target.value);
			}
		});

	const shortSpecificationList = document.querySelector(
		".short_specification__list"
	);
	shortSpecificationList && new removeEmptyParagraphs(shortSpecificationList);

	const featuresContainer = document.querySelector(".features__container");
	featuresContainer && new removeEmptyParagraphs(featuresContainer);

	const contentMenuLinks = document.querySelectorAll(
		".single-product__content-menu li a"
	);

	contentMenuLinks[0] && contentMenuLinks[0].classList.add("active");

	contentMenuLinks &&
		contentMenuLinks.forEach((link, i) => {
			link.addEventListener("click", function() {
				contentMenuLinks.forEach(link => {
					link.classList.contains("active")
						? link.classList.remove("active")
						: "";
				});

				let destination;

				if (i === 0) {
					destination = document.querySelector(".features__container");
				}

				if (i === 1) {
					destination = document.querySelector(
						".full_specification__container"
					);
				}

				destination &&
					destination.scrollIntoView({
						behavior: "smooth",
						block: "center"
						// inline: "nearest"
					});
			});
		});

	const contentMenu = document.querySelector(".single-product__content-menu");

	let affixContainer = document.querySelector(".affix__container");

	affixContainer.querySelector("button").addEventListener("click", () => {
		singleAddToCartWithQty.click();
	});

	// affixContainer.classList.add("affix__container");
	// let affixImage = document.createElement("IMG");

	// const productArea = document.querySelector(".product");
	// productArea.appendChild(affixContainer);

	// affixContainer.appendChild(affixImage);

	// const showProductAffix = () => {
	// 	let affixImageSrc = document.querySelector(".slick-current img").src;
	// 	affixImage.setAttribute("src", affixImageSrc);
	// 	console.log("do");
	// 	affixContainer.classList.toggle("affix__container--active");
	// };

	document.addEventListener("scroll", () => {
		let isAffixActive = false;

		if (affixContainer) {
			affixContainer.style.display = "flex";
		}

		let affixImage = affixContainer.querySelector("IMG");

		let affixImageSrc =
			document.querySelector(".woocommerce-product-gallery__image img").src ||
			document.querySelector(".slick-current img").src;

		affixImage && affixImage.setAttribute("src", affixImageSrc);

		let bottomOfThePage = document.querySelector(".site-footer__main");

		if (isElementInViewport(singleAddToCartWithQty)) {
			isAffixActive = false;
		} else if (isElementInViewport(bottomOfThePage)) {
			isAffixActive = false;
		} else {
			isAffixActive = true;
		}

		!isAffixActive
			? ((affixContainer.style.opacity = "0"),
			  (affixContainer.style.zIndex = "-1"))
			: ((affixContainer.style.opacity = "1"),
			  (affixContainer.style.zIndex = "1"));
	});

	// const destroyProductAffix = () => {
	// 	console.log("undo");
	// };

	// contentMenu &&
	// 	new isElementAtTopOfViewport(
	// 		contentMenu,
	// 		createProductAffix,
	// 		destroyProductAffix
	// 	);
});
