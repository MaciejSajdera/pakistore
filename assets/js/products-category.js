window.addEventListener("DOMContentLoaded", event => {
	const allCategoriesDropdowns = document.querySelectorAll(
		".woof_container_select"
	);

	allCategoriesDropdowns.forEach(dropdown => {
		const dropdownList = dropdown.querySelector(".woof_select");
		let isEmpty;
		const optionsAvailable = dropdownList.options;

		let booleanArray = [];

		Object.entries(optionsAvailable)
			.slice(1)
			.map(option => {
				booleanArray.push(option[1].disabled);
			});

		isEmpty = booleanArray.every(boolean => {
			return boolean === true;
		});

		isEmpty ? (dropdown.style.display = "none") : "";
	});
});
