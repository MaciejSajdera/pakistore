/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

export default class Navigation {
	constructor() {
		this.container = document.querySelector(".mobile-menu");
		this.button = document.querySelector(".menu-toggle");
		// this.menu = this.container.getElementsByTagName("ul")[0];
		this.svgButton = document.querySelector("#svgButton");
	}

	setupNavigation() {
		// Toggle mobile navigation
		this.button.onclick = () => {
			if (-1 !== this.container.className.indexOf("toggled")) {
				this.svgButton.classList.toggle("active");
				this.container.className = this.container.className.replace(
					" toggled",
					""
				);
				this.button.setAttribute("aria-expanded", "false");
				// this.menu.setAttribute("aria-expanded", "false");
			} else {
				this.svgButton.classList.toggle("active");
				this.container.className += " toggled";

				this.button.setAttribute("aria-expanded", "true");
				// this.menu.setAttribute("aria-expanded", "true");
			}
		};
	}
}
