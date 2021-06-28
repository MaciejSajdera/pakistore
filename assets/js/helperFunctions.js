export const isElementInViewport = el => {
	const scroll = window.scrollY || window.pageYOffset;
	const boundsTop = el.getBoundingClientRect().top + scroll;

	const viewport = {
		top: scroll,
		bottom: scroll + window.innerHeight
	};

	const bounds = {
		top: boundsTop,
		bottom: boundsTop + el.clientHeight
	};

	return (
		(bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom) ||
		(bounds.top <= viewport.bottom && bounds.top >= viewport.top)
	);
};

export const addSelfDestructingEventListener = (
	element,
	eventType,
	callback
) => {
	let handler = () => {
		callback();
		element.removeEventListener(eventType, handler);
	};
	element.addEventListener(eventType, handler);
};

export const addClassToAllTargetsAbove = (
	element,
	target,
	classToAdd,
	attrToChange,
	attrValue
) => {
	if (element && element.closest(target)) {
		element.closest(target).classList.add(classToAdd);

		if ((attrToChange, attrValue)) {
			element.closest(target).setAttribute(attrToChange, attrValue);
		}

		let currentTarget = element.closest(target);

		let nextTarget = currentTarget.parentElement.closest(target);

		if (nextTarget) {
			addClassToAllTargetsAbove(
				nextTarget,
				target,
				classToAdd,
				attrToChange,
				attrValue
			);
		}
	}

	if (element && !element.closest(target)) {
		element.parentElement.closest(target).classList.add(classToAdd);

		if ((attrToChange, attrValue)) {
			element.parentElement
				.closest(target)
				.setAttribute(attrToChange, attrValue);
		}

		let currentElement = element.parentElement.closest(target);

		let nextTarget = currentElement.closest(target);

		if (nextTarget) {
			addClassToAllTargetsAbove(
				nextTarget,
				target,
				classToAdd,
				attrToChange,
				attrValue
			);
		}
	} else {
		return;
	}
};

export const removeEmptyParagraphs = container => {
	container.querySelectorAll("P").forEach(p => {
		p.innerHTML === "&nbsp;" ? p.remove() : "";
	});
};

export class isElementAtTopOfViewport {
	constructor(element, doAction, undoAction) {
		this.element = element;
		this.doAction = doAction;
		this.undoAction = undoAction;

		if ("IntersectionObserver" in window) {
			// IntersectionObserver Supported
			let config = {
				root: null,
				rootMargin: "0px",
				threshold: 0
			};

			let observer = new IntersectionObserver(onChange, config);

			observer.observe(element);

			function onChange(changes, observer) {
				changes.forEach(change => {
					console.log(change);

					if (
						change.boundingClientRect.top < 0 &&
						change.intersectionRect.top === 0
					) {
						doAction();
					}
					// if (change.intersectionRect.top > 0) {
					// 	undoAction();
					// }
				});
			}
		} else {
			// IntersectionObserver NOT Supported
			return;
		}
	}
}

export default isElementInViewport;
