import { addFilter, applyFilters, doAction } from "@wordpress/hooks";

const SELECTOR = ".wp-block-custom-swiper";

function onDocumentReady() {
	const els = document.querySelectorAll(SELECTOR);

	if (!els) {
		return;
	}

	setTimeout(() => {
		initialize(els);
	}, 0);
}

function initialize(els) {
	import("swiper/css/bundle");
	import("swiper/bundle").then((swiperModule) => {
		els.forEach((el) =>
			setTimeout(() => {
				initializeElement(el, swiperModule.Swiper);
			}, 0)
		);
	});
}

export function initializeElement(element, Swiper) {
	if (!element) {
		return null;
	}

	doAction('customSwiper.beforeInitialize', element);

	const swiperElement = element.querySelector(".swiper");
	if (!swiperElement) {
		return null;
	}

	const defaultConfig = {
		speed: 300,
		slidesPerView: 1,
	};

	const swiperConfig = applyFilters(
		"customSwiper.swiperConfig",
		defaultConfig,
		element,
		Swiper
	);

	const swiperInstance = new Swiper(swiperElement, swiperConfig);

	doAction('customSwiper.afterInitialize', swiperInstance, element, swiperConfig);
	return swiperInstance;
}

document.addEventListener("DOMContentLoaded", onDocumentReady);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.speed",
	(swiperConfig, element) => {
		const { speed } = element.dataset;
		if (!speed) {
			return swiperConfig;
		}

		return Object.assign({}, swiperConfig, {
			speed: parseInt(speed),
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.slidesPerView",
	(swiperConfig, element) => {
		if (!Object.keys(element.dataset).includes("slidesPerView")) {
			return swiperConfig;
		}

		const { slidesPerView } = element.dataset;
		const numSlidesPerView = parseInt(slidesPerView);

		if (!numSlidesPerView || Number.isNaN(numSlidesPerView)) {
			return Object.assign({}, swiperConfig, {
				slidesPerView: "auto",
			});
		}

		return Object.assign({}, swiperConfig, {
			slidesPerView: numSlidesPerView,
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.spaceBetween",
	(swiperConfig, element) => {
		const { spaceBetween } = element.dataset;

		if (!spaceBetween) {
			return swiperConfig;
		}

		return Object.assign({}, swiperConfig, {
			spaceBetween: parseInt(spaceBetween),
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.autoplay",
	(swiperConfig, element, swiperModule) => {
		if (!element.classList.contains("autoplay")) {
			return swiperConfig;
		}

		const { Autoplay } = swiperModule;
		const delay = parseInt(element.dataset.autoplayDelay);
		const pauseOnMouseEnter = element.dataset.pauseOnMouseEnter === "true";
		const disableOnInteraction = !pauseOnMouseEnter;

		return Object.assign({}, swiperConfig, {
			autoplay: { delay, pauseOnMouseEnter, disableOnInteraction },
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.loop",
	(swiperConfig, element) => {
		if (!element.classList.contains("infinite")) {
			return swiperConfig;
		}

		return Object.assign({}, swiperConfig, {
			loop: true,
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.autoHeight",
	(swiperConfig, element) => {
		if (!element.classList.contains("autoheight-slides")) {
			return swiperConfig;
		}

		return Object.assign({}, swiperConfig, { autoHeight: true });
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.centeredSlides",
	(swiperConfig, element) => {
		if (!element.classList.contains("centered-slides")) {
			return swiperConfig;
		}

		return Object.assign({}, swiperConfig, { centeredSlides: true });
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.navigation",
	(swiperConfig, element, swiperModule) => {
		if (!element.classList.contains("has-navigation")) {
			return swiperConfig;
		}

		const { Navigation } = swiperModule;
		return Object.assign({}, swiperConfig, {
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.pagination",
	(swiperConfig, element, swiperModule) => {
		if (!element.classList.contains("has-pagination")) {
			return swiperConfig;
		}

		const { Pagination } = swiperModule;
		return Object.assign({}, swiperConfig, {
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.scrollbar",
	(swiperConfig, element, swiperModule) => {
		if (!element.classList.contains("has-scrollbar")) {
			return swiperConfig;
		}

		const { Scrollbar } = swiperModule;
		return Object.assign({}, swiperConfig, {
			scrollbar: {
				el: ".swiper-scrollbar",
				draggable: true,
			},
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.fade",
	(swiperConfig, element, swiperModule) => {
		if (!element.classList.contains("has-effect-fade")) {
			return swiperConfig;
		}

		const { EffectFade } = swiperModule;

		return Object.assign({}, swiperConfig, {
			effect: "fade",
		});
	}
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.advancedSettingsJSON",
	(swiperConfig, element) => {
		const { advancedSettings } = element.dataset;

		if (!advancedSettings) {
			return swiperConfig;
		}

		try {
			const advancedSettingsObject = JSON.parse(advancedSettings);
			return Object.assign({}, swiperConfig, advancedSettingsObject);
		} catch (error) {
			console.warn(error);
			return swiperConfig;
		}
	},
);

addFilter(
	"customSwiper.swiperConfig",
	"customSwiper.swiperConfig.dispatchInit",
	(swiperConfig, element) => {
		return Object.assign({}, swiperConfig, {
			on: {
				...swiperConfig.on,
				afterInit: function () {
					element.dispatchEvent(
						new CustomEvent("custom-swiper-initialized", {
							detail: { swiper: this },
						})
					);
				},
			},
		});
	}
);
