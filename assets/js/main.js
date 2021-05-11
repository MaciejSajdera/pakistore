/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";
import skipLinkFocus from "./skip-link-focus-fix.js";
import smoothscroll from "smoothscroll-polyfill";
import {
	isElementInViewport,
	addSelfDestructingEventListener,
	addClassToAllTargetsAbove
} from "../js/helperFunctions";

window.addEventListener("load", () => {
	let vh = window.innerHeight * 0.01;
	let fullVH = window.innerHeight;
	document.documentElement.style.setProperty("--vh", `${vh}px`);
	document.documentElement.style.setProperty("--fullVH", `${fullVH}px`);
});

window.addEventListener("resize", () => {
	let vh = window.innerHeight * 0.01;
	let fullVH = window.innerHeight;
	document.documentElement.style.setProperty("--vh", `${vh}px`);
	document.documentElement.style.setProperty("--fullVH", `${fullVH}px`);
});

window.addEventListener("DOMContentLoaded", event => {
	const navigation = new Navigation();
	navigation.setupNavigation();

	smoothscroll.polyfill();

	const myPreloader = document.querySelector(".my-preloader");
	const page = document.querySelector("#page");
	const topPromoItems = document.querySelectorAll(".top-promo-item");

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-off");
	}, 400);

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-none");
		page.classList.add("page-loaded");

		if (topPromoItems) {
			topPromoItems.forEach(element => {
				element.classList.add("top-promo-items-loaded");
			});
		}
	}, 500);

	setTimeout(() => {
		cookiesNotification();
	}, 1000);

	const cookiesNotification = () => {
		const cookiesInfo = document.querySelector(".cookie-law-notification");
		const cookiesAcceptButton = document.querySelector("#cookie-law-button");

		if (localStorage.getItem("cookiesAreAccepted")) {
			return;
		} else {
			cookiesInfo.classList.add("cookies-notification-on");
			cookiesAcceptButton.addEventListener("click", () => {
				localStorage.setItem("cookiesAreAccepted", "1");
				cookiesInfo.classList.add("cookies-notification-off");
			});
			return;
		}
	};

	//Lazy Loading

	const imagesLazyLoading = function() {
		let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
		let active = false;

		const lazyLoad = function() {
			if (active === false) {
				active = true;

				setTimeout(function() {
					lazyImages.forEach(function(lazyImage) {
						if (
							lazyImage.getBoundingClientRect().top <= window.innerHeight &&
							lazyImage.getBoundingClientRect().bottom >= 0 &&
							getComputedStyle(lazyImage).display !== "none"
						) {
							lazyImage.src = lazyImage.dataset.src;
							lazyImage.srcset = lazyImage.dataset.srcset;
							lazyImage.classList.remove("lazy");

							lazyImages = lazyImages.filter(function(image) {
								return image !== lazyImage;
							});

							if (lazyImages.length === 0) {
								document.removeEventListener("scroll", lazyLoad);
								window.removeEventListener("resize", lazyLoad);
								window.removeEventListener("orientationchange", lazyLoad);
							}
						}
					});

					active = false;
				}, 200);
			}
		};

		lazyLoad();
	};

	imagesLazyLoading();
	document.addEventListener("scroll", imagesLazyLoading);
	window.addEventListener("resize", imagesLazyLoading);
	window.addEventListener("orientationchange", imagesLazyLoading);

	const hideEmptyFilters = () => {
		const allCategoriesDropdowns = document.querySelectorAll(
			".woof_container_mselect"
		);

		if (allCategoriesDropdowns.length <= 1) {
			return;
		}

		allCategoriesDropdowns.forEach(dropdown => {
			const dropdownList = dropdown.querySelector(".woof_mselect");
			const optionsAvailable = dropdownList.options;
			const inputText = dropdown.querySelector("input[type=text]");

			console.log(dropdown);

			inputText.readOnly = true;

			let isEmpty;

			let isOptionDisabled = [];

			Object.entries(optionsAvailable)
				.slice(1)
				.map(option => {
					isOptionDisabled.push(option[1].disabled);
				});

			isEmpty = isOptionDisabled.every(boolean => {
				return boolean === true;
			});

			isEmpty ? (dropdown.style.display = "none") : "";
		});
	};

	hideEmptyFilters();

	const handleSelectProductsPerPage = () => {
		const selectProductsPerPage = document.querySelector("#products-per-page");

		if (selectProductsPerPage) {
			selectProductsPerPage.addEventListener("change", e => {
				e.target.closest("FORM").submit();
			});
		} else {
			return;
		}
	};

	handleSelectProductsPerPage();

	jQuery(document).on("woof_ajax_done", woof_ajax_done_handler);

	function woof_ajax_done_handler(e) {
		imagesLazyLoading();
		const pagination = document.querySelector(".woocommerce-pagination");

		if (window.pageYOffset > 1000) {
			window.scrollTo({
				top: 100,
				behavior: "smooth"
			});
		}

		hideEmptyFilters();

		handleSelectProductsPerPage();
	}

	// function makeNavSticky() {
	// 	const siteNavigation = document.querySelector("#site-navigation");

	// 	if (window.pageYOffset > siteNavigation.offsetTop) {
	// 		siteNavigation.classList.add("fixed-nav");
	// 		siteNavigation.classList.add("box-shadow-nav");
	// 	} else {
	// 		siteNavigation.classList.remove("fixed-nav");
	// 		siteNavigation.classList.remove("box-shadow-nav");
	// 	}
	// }

	// window.onscroll = function() {
	// 	makeNavSticky();
	// };

	const mobileMenu = () => {
		const nav = document.querySelector(".mobile-menu");
		const allMenuLinks = nav.querySelectorAll("LI");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children a");
		const backButton = document.querySelector("#back-button");

		const wooMenu = document.querySelector("#menu-woomenu");

		linksWithChildren.forEach(link => {
			link.nextElementSibling &&
			link.nextElementSibling.classList.contains("sub-menu")
				? (link.style.pointerEvents = "none")
				: "";
		});

		nav.addEventListener("click", function(e) {
			let backButtonAppended = false;
			console.log(e.target);

			if (e.target.classList.contains("expand-menu-toggle")) {
				// e.preventDefault();

				e.target.querySelector("#back-button")
					? e.target.querySelector("#back-button").remove()
					: "";

				const myBackButton = document.createElement("LI");
				myBackButton.id = "back-button";
				myBackButton.classList.add("back-button");
				myBackButton.innerText = e.target.previousElementSibling.innerText;

				const submenu = e.target.nextElementSibling;

				const appendButton = () => {
					if (!backButtonAppended) {
						submenu.appendChild(myBackButton);
						backButtonAppended = true;
					}
				};

				appendButton();

				// e.target.closest("UL").classList.add("move-back");

				submenu.classList.add("sub-menu--expanded", "sub-menu--visible");

				//delay
				if (wooMenu) {
					setTimeout(function() {
						wooMenu.scrollTop = 0;
					}, 0);
				}

				myBackButton.addEventListener("click", function(e) {
					const submenuExpanded = this.closest(".sub-menu--expanded");
					submenuExpanded.classList.remove("sub-menu--expanded");

					// const menuMovedBack = document.querySelector(".move-back");
					// menuMovedBack.classList.remove("move-back");

					setTimeout(() => {
						this.remove();
						submenu.classList.remove("sub-menu--visible");
					}, 500);

					backButtonAppended = false;
				});
			} else {
				return;
			}
		});
	};

	const mediaQueryMobile = window.matchMedia("(max-width: 992px)");

	let mobileMenuWasAlreadyFired = false;

	function handleMobileChange(e) {
		// Check if the media query is true
		if (e.matches && !mobileMenuWasAlreadyFired) {
			// Then log the following message to the console
			console.log("Media Query Mobile Matched!");
			mobileMenu();
			mobileMenuWasAlreadyFired = true;
		}
	}

	mediaQueryMobile.addListener(handleMobileChange);
	handleMobileChange(mediaQueryMobile);

	// This is the important part!

	function collapseSection(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// temporarily disable all css transitions
		var elementTransition = element.style.transition;
		element.style.transition = "";

		// on the next frame (as soon as the previous style change has taken effect),
		// explicitly set the element's height to its current pixel height, so we
		// aren't transitioning out of 'auto'
		requestAnimationFrame(function() {
			element.style.height = sectionHeight + "px";
			element.style.transition = elementTransition;

			// on the next frame (as soon as the previous style change has taken effect),
			// have the element transition to height: 0
			requestAnimationFrame(function() {
				element.style.height = 0 + "px";
			});
		});

		// mark the section as "currently collapsed"
		element.setAttribute("data-collapsed", "true");
	}

	function expandSection(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// have the element transition to the height of its inner content
		element.style.height = sectionHeight + "px";

		// when the next css transition finishes (which should be the one we just triggered)
		const removeHeight = function(e) {
			element.style.height = null;
		};

		addSelfDestructingEventListener(element, "transitionend", removeHeight);

		// mark the section as "currently not collapsed"
		element.setAttribute("data-collapsed", "false");
	}

	const desktopMenu = () => {
		const nav = document.querySelector("#desktop-shop-menu");
		const allMenuLinks = nav.querySelectorAll("#menu-woomenu > li");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children");

		const background = document.querySelector(".dropdownBackground");

		const wooMenu = document.querySelector("#menu-woomenu");

		// linksWithChildren.forEach(link => {
		// 	// const submenu = link.querySelector(".sub-menu");
		// 	// submenu.setAttribute("data-collapsed", "true");
		// 	// console.log(link);
		// 	if (link.querySelector(".sub-menu")) {
		// 		const submenu = link.querySelector(".sub-menu");

		// 		submenu.setAttribute("data-collapsed", "true");
		// 		console.log(`submenu: ${submenu}`);
		// 	}
		// });

		// console.log(currentMenuItem.closest(".sub-menu"));

		// linksWithChildren.forEach(link => {
		// 	link.nextElementSibling &&
		// 	link.nextElementSibling.classList.contains("sub-menu")
		// 		? (link.style.pointerEvents = "none")
		// 		: "";

		// if (
		// 	link.nextElementSibling &&
		// 	link.nextElementSibling.classList.contains("sub-menu")
		// ) {
		// 	const submenu = link.querySelector(".sub-menu");
		// 	submenu.setAttribute("data-collapsed", "true");
		// }
		// });

		allMenuLinks.forEach(link => {
			link.addEventListener("mouseenter", handleEnter);
		});

		function handleEnter(e) {
			// console.log(e.target);
			console.log("enter");

			// if (e.target.classList.contains(".menu-item")) {
			// const expandSubMenuTrigger = e.target;
			// expandSubMenuTrigger.classList.add("expand-menu-toggle__toggled");
			const submenu = this.querySelector(".sub-menu");
			// submenu.classList.toggle("sub-menu--expanded");
			// const submenuExpanded = this.closest(".sub-menu--expanded");
			// submenuExpanded.classList.remove("sub-menu--expanded");

			// var isCollapsed = submenu.getAttribute("data-collapsed") === "true";

			submenu.classList.add("sub-menu--expanded");
			this.classList.add("trigger-enter");

			setTimeout(
				() =>
					this.classList.contains("trigger-enter") &&
					this.classList.add("trigger-enter-active"),
				150
			);

			background.classList.add("open");

			const dropdown = this.querySelector(".sub-menu");
			const dropdownCoords = dropdown.getBoundingClientRect();
			const navCoords = nav.getBoundingClientRect();

			const coords = {
				height: dropdownCoords.height,
				width: dropdownCoords.width,
				top: dropdownCoords.top - navCoords.top,
				left: dropdownCoords.left - navCoords.left
			};

			background.style.setProperty("width", `${coords.width}px`);
			background.style.setProperty("height", `${coords.height}px`);
			background.style.setProperty(
				"transform",
				`translate(${coords.left}px, ${coords.top}px)`
			);

			// if (isCollapsed) {
			// 	// expandSection(submenu);
			// 	// submenu.setAttribute("data-collapsed", "false");
			// 	submenu.classList.add("sub-menu--expanded");
			// } else {
			// 	// collapseSection(submenu);
			// 	submenu.classList.remove("sub-menu--expanded");
			// }
			// }
		}

		allMenuLinks.forEach(link => {
			link.addEventListener("mouseleave", handleLeave);
		});

		function handleLeave(e) {
			console.log(`left`);

			// if (e.target.classList.contains(".menu-item")) {
			// const expandSubMenuTrigger = e.target;
			// expandSubMenuTrigger.classList.add("expand-menu-toggle__toggled");
			const submenu = this.querySelector(".sub-menu");
			// submenu.classList.toggle("sub-menu--expanded");
			// const submenuExpanded = this.closest(".sub-menu--expanded");
			// submenuExpanded.classList.remove("sub-menu--expanded");

			// var isCollapsed = submenu.getAttribute("data-collapsed") === "true";

			submenu.classList.remove("sub-menu--expanded");

			this.classList.remove("trigger-enter");
			this.classList.remove("trigger-enter-active");

			background.classList.remove("open");

			// if (isCollapsed) {
			// 	// expandSection(submenu);
			// 	// submenu.setAttribute("data-collapsed", "false");
			// 	submenu.classList.add("sub-menu--expanded");
			// } else {
			// 	// collapseSection(submenu);
			// 	submenu.classList.remove("sub-menu--expanded");
			// }
			// }
		}

		//AT ARCHIVE TEMPLATE

		const currentMenuItem = nav.querySelector(".current-menu-item");
		const currentCategoryAncestor = nav.querySelector(".current-menu-ancestor");

		//if current menu item is an ancestor with no submenu
		if (
			currentMenuItem &&
			!currentCategoryAncestor &&
			!currentMenuItem.querySelector(".sub-menu")
		) {
			console.log("no submenu");
			return;
		}

		//if is an ancestor with submenu
		if (currentMenuItem && !currentCategoryAncestor) {
			const currentSubMenu = currentMenuItem.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");

			currentSubMenu.setAttribute("data-collapsed", "false");

			const currentExpandMenuToggle = currentMenuItem.querySelector(
				".expand-menu-toggle"
			);

			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			// console.log("test3");
		}

		//if is nested and has its own submenu

		if (
			currentMenuItem &&
			currentMenuItem.classList.contains("menu-item-has-children") &&
			currentCategoryAncestor
		) {
			const directAncestor = currentMenuItem.closest(".current-menu-ancestor");
			console.log(directAncestor);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".expand-menu-toggle"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			const childrenSubMenu = currentMenuItem.querySelector(".sub-menu");
			const childrenExpandMenuToggle = currentMenuItem.querySelector(
				".expand-menu-toggle"
			);

			childrenSubMenu.classList.add("sub-menu--expanded");
			childrenSubMenu.setAttribute("data-collapsed", "false");
			childrenExpandMenuToggle.classList.add("expand-menu-toggle__toggled");
		}

		//if is nested and doesn't have its own submenu

		if (
			currentMenuItem &&
			!currentMenuItem.classList.contains("menu-item-has-children") &&
			currentCategoryAncestor
		) {
			const directAncestor = currentMenuItem.closest(".current-menu-ancestor");
			const currentExpandMenuToggle = directAncestor.querySelector(
				".expand-menu-toggle"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			const grandparentAncestor = directAncestor.parentElement.closest(
				".menu-parent-link"
			);

			if (grandparentAncestor) {
				const grandparentSubMenu = grandparentAncestor.querySelector(
					".sub-menu"
				);
				const grandparentExpandMenuToggle = grandparentAncestor.querySelector(
					".expand-menu-toggle"
				);

				grandparentSubMenu.classList.add("sub-menu--expanded");
				grandparentSubMenu.setAttribute("data-collapsed", "false");
				grandparentExpandMenuToggle.classList.add(
					"expand-menu-toggle__toggled"
				);
			}
		}

		//AT SINGLE PRODUCT TEMPLATE

		const currentProductParent = nav.querySelector(".current-product-parent");
		const currentProductAncestor = nav.querySelector(
			".current-product-ancestor"
		);

		//if current menu item is an ancestor with no submenu
		if (
			currentProductParent &&
			!currentProductAncestor &&
			!currentProductParent.querySelector(".sub-menu")
		) {
			console.log("no submenu");
			return;
		}

		//if is an ancestor with submenu
		if (currentProductParent && !currentProductAncestor) {
			const currentSubMenu = currentProductParent.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");

			currentSubMenu.setAttribute("data-collapsed", "false");

			const currentExpandMenuToggle = currentProductParent.querySelector(
				".expand-menu-toggle"
			);

			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			// console.log("test3");
		}

		//if is nested and has its own submenu

		if (
			currentProductParent &&
			currentProductParent.classList.contains("menu-item-has-children") &&
			currentProductAncestor
		) {
			const directAncestor = currentProductParent.closest(
				".current-product-ancestor"
			);
			console.log(directAncestor);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".expand-menu-toggle"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			const childrenSubMenu = currentProductParent.querySelector(".sub-menu");
			const childrenExpandMenuToggle = currentProductParent.querySelector(
				".expand-menu-toggle"
			);

			childrenSubMenu.classList.add("sub-menu--expanded");
			childrenSubMenu.setAttribute("data-collapsed", "false");
			childrenExpandMenuToggle.classList.add("expand-menu-toggle__toggled");
		}

		//if is nested and doesn't have its own submenu

		if (
			currentProductParent &&
			!currentProductParent.classList.contains("menu-item-has-children") &&
			currentProductAncestor
		) {
			const directAncestor = currentProductParent.closest(
				".menu-item-has-children"
			);

			const currentExpandMenuToggle = directAncestor.querySelector(
				".expand-menu-toggle"
			);
			const currentSubMenu = directAncestor.querySelector(".sub-menu");

			currentSubMenu.classList.add("sub-menu--expanded");
			currentSubMenu.setAttribute("data-collapsed", "false");
			currentExpandMenuToggle.classList.add("expand-menu-toggle__toggled");

			const grandparentAncestor = directAncestor.parentElement.closest(
				".menu-parent-link"
			);

			if (grandparentAncestor) {
				const grandparentSubMenu = grandparentAncestor.querySelector(
					".sub-menu"
				);
				const grandparentExpandMenuToggle = grandparentAncestor.querySelector(
					".expand-menu-toggle"
				);

				grandparentSubMenu.classList.add("sub-menu--expanded");
				grandparentSubMenu.setAttribute("data-collapsed", "false");
				grandparentExpandMenuToggle.classList.add(
					"expand-menu-toggle__toggled"
				);
			}
		}
	};

	const mediaQueryDesktop = window.matchMedia("(min-width: 992px)");

	const asideDesktopMenu = document.querySelector("#desktop-shop-menu");
	let desktopMenuWasAlreadyFired = false;

	function handleDesktopChange(e) {
		// Check if the media query is true
		if (asideDesktopMenu && e.matches && !desktopMenuWasAlreadyFired) {
			console.log("Media Query Desktop Matched!");

			desktopMenu();
			desktopMenuWasAlreadyFired = true;
		}
	}

	mediaQueryDesktop.addListener(handleDesktopChange);
	handleDesktopChange(mediaQueryDesktop);

	document.addEventListener("click", e => {
		const searchToggleSVG = document.querySelector("#search-icon svg");
		const searchToggleSVGPath = document.querySelectorAll(
			"#search-icon svg path"
		);
		const searchToggleIcon = document.querySelector("#search-icon");
		const searchToggleWrapper = document.querySelector(".search-icon-wrapper");
		const searchToggleSubText = document.querySelector(".search-sub-icon-text");
		const searchPanel = document.querySelector(".search-panel");
		const searchInput = document.querySelector(".dgwt-wcas-search-input");

		if (
			e.target === searchToggleSVG ||
			e.target === searchToggleSVGPath[0] ||
			e.target === searchToggleSVGPath[1] ||
			e.target === searchToggleIcon ||
			e.target === searchToggleSubText ||
			e.target === searchToggleWrapper
		) {
			searchPanel.classList.toggle("search-panel--toggled");
			searchToggleSVG.classList.toggle("search-icon-clicked");

			if (window.innerWidth >= 992) {
				searchInput.focus();
			}
		}
	});

	const switchSignIn = document.querySelector("#switch-sign-in");
	const switchSignUp = document.querySelector("#switch-sign-up");
	const signInWrapper = document.querySelector(".sign-in-wrapper");
	const signUpWrapper = document.querySelector(".sign-up-wrapper");

	if (switchSignIn) {
		switchSignUp.addEventListener("click", () => {
			signInWrapper.classList.remove("form-active");
			signUpWrapper.classList.add("form-active", "choose-customer-type");

			switchSignIn.classList.remove("switch-active");
			switchSignUp.classList.add("switch-active");
		});

		switchSignIn.addEventListener("click", () => {
			signUpWrapper.classList.remove("form-active", "choose-customer-type");
			signInWrapper.classList.add("form-active");

			switchSignUp.classList.remove("switch-active");
			switchSignIn.classList.add("switch-active");
		});
	}

	const registerAsRetail = document.querySelector("#registerAsRetail");
	const registerAsWholesale = document.querySelector("#registerAsWholesale");

	if (registerAsRetail && registerAsWholesale) {
		//showing form after choosing customer type
		const signUpForm = document.querySelector(".sign-up-wrapper form");

		//switching input fields betweem wholesale and retail customer

		const customRegisterFormFields = document.querySelectorAll(
			".my-custom-form-field"
		);

		const customRegisterFormFieldsInputs = document.querySelectorAll(
			".my-custom-form-field input"
		);
		const wholesaleInfo = document.querySelector(".wholesale-info");

		registerAsRetail.addEventListener("click", function retailFunction() {
			registerAsWholesale.classList.contains("customer-type-chosen")
				? registerAsWholesale.classList.remove("customer-type-chosen")
				: "";

			this.classList.add("customer-type-chosen");

			wholesaleInfo.classList.contains("show-info")
				? wholesaleInfo.classList.remove("show-info")
				: "";

			customRegisterFormFields.forEach(field => {
				field.style.display = "none";
			});

			customRegisterFormFieldsInputs.forEach(field => {
				field.required = false;
			});

			signUpForm.classList.add("form-type-chosen");
		});

		registerAsWholesale.addEventListener("click", function wholesaleFunction() {
			registerAsRetail.classList.contains("customer-type-chosen")
				? registerAsRetail.classList.remove("customer-type-chosen")
				: "";

			this.classList.add("customer-type-chosen");

			wholesaleInfo.classList.add("show-info");

			customRegisterFormFields.forEach(field => {
				field.style.display = "block";
			});

			customRegisterFormFieldsInputs.forEach(field => {
				field.required = true;
			});

			signUpForm.classList.add("form-type-chosen");
		});
	}

	const showSection = () => {
		// const categoriesShowcaseSection = document.querySelector(
		// 	".categories-showcase"
		// );
		const blogPostsSection = document.querySelector(".blog-posts");

		// if (categoriesShowcaseSection) {
		// 	isElementInViewport(categoriesShowcaseSection)
		// 		? categoriesShowcaseSection.classList.add("move-up")
		// 		: "";
		// }

		if (blogPostsSection) {
			isElementInViewport(blogPostsSection)
				? blogPostsSection.classList.add("move-up")
				: "";
		}

		// if (
		// 	categoriesShowcaseSection.classList.contains("move-up") &&
		// 	blogPostsSection.classList.contains("move-up")
		// ) {
		// 	document.removeEventListener("scroll", showSection);
		// 	window.removeEventListener("resize", showSection);
		// 	window.removeEventListener("orientationchange", showSection);
		// }
	};

	const homePage = document.querySelector(".home");

	if (homePage) {
		document.addEventListener("scroll", showSection);
		window.addEventListener("resize", showSection);
		window.addEventListener("orientationchange", showSection);
	}

	const toggleFilters = document.querySelector("#toggle-filters");

	if (toggleFilters) {
		const woofFilters = document.querySelector(".woof");
		toggleFilters.addEventListener("click", e => {
			woofFilters.classList.toggle("woof__show");
		});
	}

	//li hover effect - Noel Delgado | @pixelia_me

	const directions = { 0: "top", 1: "right", 2: "bottom", 3: "left" };
	const classNames = ["in", "out"]
		.map(p => Object.values(directions).map(d => `${p}-${d}`))
		.reduce((a, b) => a.concat(b));

	const getDirectionKey = (ev, node) => {
		const { width, height, top, left } = node.getBoundingClientRect();
		const l = ev.pageX - (left + window.pageXOffset);
		const t = ev.pageY - (top + window.pageYOffset);
		const x = l - (width / 2) * (width > height ? height / width : 1);
		const y = t - (height / 2) * (height > width ? width / height : 1);
		const directionKey =
			Math.round((Math.atan2(y, x) * (180 / Math.PI) + 180) / 90 + 3) % 4;
		return directionKey;
	};

	class Item {
		constructor(element) {
			this.element = element;
			element.addEventListener("mouseover", ev => this.update(ev, "in"));
			element.addEventListener("mouseout", ev => this.update(ev, "out"));
		}

		update(ev, prefix) {
			this.element.classList.remove(...classNames);
			this.element.classList.add(
				`${prefix}-${directions[getDirectionKey(ev, this.element)]}`
			);
		}
	}

	// const allWooCategoryMenuLinks = document.querySelectorAll(
	// 	"#menu-woomenu > li > a"
	// );

	const allWooCategoryMenuLinks = document.querySelectorAll(
		"#menu-woomenu > .trigger-enter-active"
	);

	if (allWooCategoryMenuLinks) {
		const linksToDirectionHover = [].slice.call(allWooCategoryMenuLinks, 0);
		linksToDirectionHover.forEach(node => new Item(node));
	}

	const allShowcaseCategories = document.querySelectorAll(
		".categories-showcase__wrapper > a"
	);

	if (allShowcaseCategories) {
		const categoriesToDirectionHover = [].slice.call(allShowcaseCategories, 0);
		categoriesToDirectionHover.forEach(node => new Item(node));
	}

	document.addEventListener("scroll", () => {
		const scrollToTopBtn = document.querySelector(".scrollToTopBtn");
		if (scrollToTopBtn) {
			if (pageYOffset > window.innerHeight) {
				scrollToTopBtn.classList.add("showBtn");
			} else {
				scrollToTopBtn.classList.remove("showBtn");
			}
			scrollToTopBtn.addEventListener("click", () => {
				window.scrollTo({
					top: 0,
					behavior: "smooth"
				});
			});
		}
	});

	// const wooGalleryThumbnails = document.querySelectorAll(
	// 	".woocommerce-product-gallery--with-images .flex-control-thumbs li"
	// );

	// if (wooGalleryThumbnails) {
	// 	console.log(wooGalleryThumbnails);

	// 	wooGalleryThumbnails.forEach(thumbnail => {
	// 		thumbnail.addEventListener("click", e => {
	// 			e.preventDefault();
	// 			console.log(`thumbevent: ${e.target}`);
	// 		});
	// 	});
	// }
});

// const closePromo = document.querySelector("#close-promo");

// closePromo.addEventListener("click", () => {
// 	const siteNavigation = document.querySelector("#site-navigation");
// 	const topPromo = document.querySelector(".top-promo");

// 	siteNavigation.classList.remove("promo-navigation");
// 	topPromo.parentNode.removeChild(topPromo);
// });

// function debounce(func, wait, immediate) {
// 	var timeout;

// 	return function executedFunction() {
// 		var context = this;
// 		var args = arguments;

// 		var later = function() {
// 			timeout = null;
// 			if (!immediate) func.apply(context, args);
// 		};

// 		var callNow = immediate && !timeout;

// 		clearTimeout(timeout);

// 		timeout = setTimeout(later, wait);

// 		if (callNow) func.apply(context, args);
// 	};
// }

// document.addEventListener("click", e => {
// 	console.log(e.target);
// });
