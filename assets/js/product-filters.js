// window.addEventListener("DOMContentLoaded", event => {
// 	const hideEmptyFilters = () => {
// 		const allCategoriesDropdowns = document.querySelectorAll(
// 			".woof_container_mselect"
// 		);

// 		allCategoriesDropdowns.forEach(dropdown => {
// 			const dropdownList = dropdown.querySelector(".woof_mselect");
// 			const optionsAvailable = dropdownList.options;
// 			const inputText = dropdown.querySelector("input[type=text]");

// 			inputText.readOnly = true;

// 			let isEmpty;

// 			let isOptionDisabled = [];

// 			Object.entries(optionsAvailable)
// 				.slice(1)
// 				.map(option => {
// 					isOptionDisabled.push(option[1].disabled);
// 				});

// 			isEmpty = isOptionDisabled.every(boolean => {
// 				return boolean === true;
// 			});

// 			isEmpty ? (dropdown.style.display = "none") : "";
// 		});
// 	};

// 	hideEmptyFilters();
// 	jQuery(document).on("woof_ajax_done", hideEmptyFilters);
// });
