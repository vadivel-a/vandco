import { InspectorControls } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";

import {
	Panel,
	PanelBody,
	ToggleControl,
	TextControl,
	SelectControl,
	__experimentalNumberControl as NumberControl,
} from "@wordpress/components";

import SliderAttributes from '../attributes';

import NavigationPanel from "./navigation-panel";
import AutoplayPanel from "./autoplay-panel";
import PaginationPanel from "./pagination-panel";
import AdvancedControls from "./advanced-controls";
import ScrollbarPanel from "./scrollbar-panel";

const SliderInspectorControls = ({ attributes, setAttributes }) => {
	const {
		autoplay,
		slidesPerView,
		speed,
		spaceBetween,
		hasNavigation,
		hasScrollbar,
		hasPagination,
		verticalAlign,
		stretchContentHeight,
		autoHeight,
		centeredSlides,
		slideWidth,
		hasOverflowVisible,
		effect,
		crossfade,
	} = attributes;

	return (
		<>
			<InspectorControls className={"skeletor-inspector-control"}>
				<Panel>
					<PanelBody title={__("Slider Settings")} initialOpen={true}>

						<ToggleControl
							label={__("Force Equal Height")}
							checked={verticalAlign === "stretch"}
							help={
								verticalAlign === "stretch"
									? "Slides will be forced to match the height of the tallest slide. This DOES NOT necessarily apply to the content of the slides."
									: verticalAlign
									? `When turned on, this will replace align: ${verticalAlign}. Note that this will only force the Slides to equal height, and not necessarily their content.`
									: ""
							}
							onChange={() => {
								if (verticalAlign === "stretch") {
									setAttributes({ verticalAlign: undefined });
								} else {
									setAttributes({ verticalAlign: "stretch" });
								}
							}}
						/>

						{verticalAlign === "stretch" && (
							<ToggleControl
								label={__("Stretch Slide Content Height")}
								checked={stretchContentHeight}
								help={
									stretchContentHeight
										? __("Children of this Slider’s Slides will be forced to 100% height")
										: __("When turned on, this will force the slide content to be 100% the height of their individual slide. ")
								}
								onChange={(stretchContentHeight) =>
									setAttributes({ stretchContentHeight })
								}
							/>
						)}

						<ToggleControl
							label={__("Auto Height Slides")}
							checked={autoHeight}
							help={__("When turned on, the Slider wrapper will adapt its height to the height of the currently active slide")}
							onChange={(autoHeight) => setAttributes({ autoHeight })}
						/>

						<ToggleControl
							label={__("Centered Slides")}
							checked={centeredSlides}
							help={__("When turned on, the active slide will be centered in this block instead of left aligned.")}
							onChange={(centeredSlides) => setAttributes({ centeredSlides })}
						/>

						<NumberControl
							label={__("Slides per View")}
							value={slidesPerView}
							onChange={(slidesPerView) => setAttributes({ slidesPerView })}
							help={
								parseInt(slidesPerView) === 0
									? __('Slides will have "auto" width, allowing variable width and a flexible number of visible slides. You can also set a width below, and probably should (swiper is a bit buggy in this feature)')
									: false
							}
							min={0}
							max={12}
							step={1}
						/>

						{(!slidesPerView || parseInt(slidesPerView) === 0) && (
							<TextControl
								label={__("Slide Width")}
								value={slideWidth}
								onChange={(slideWidth) => setAttributes({ slideWidth })}
							/>
						)}

						{slidesPerView !== 1 && (
							<NumberControl
								label={__("Space Between Slides (in pixels)")}
								value={spaceBetween}
								onChange={(spaceBetween) => setAttributes({ spaceBetween })}
							/>
						)}

						<ToggleControl
							label={__("Display Overflow?")}
							checked={hasOverflowVisible}
							help={__("When turned on, the inactive slides will remain visible on the left and right	of the Slider.")}
							onChange={(hasOverflowVisible) => setAttributes({ hasOverflowVisible })}
						/>

						<NumberControl
							label={__("Slide Transition Speed")}
							value={speed}
							onChange={(speed) => setAttributes({ speed })}
							help={__("Amount of time (in milliseconds) it takes to transition from one slide to another")}
							min={0}
						/>

						<SelectControl
							label={__("Effect")}
							value={effect}
							onChange={(effect) => setAttributes({ effect })}
							options={SliderAttributes.effect.enum.map(e => ({ label: e, slug: e }))}
						/>

						{effect === 'fade' && (
							<ToggleControl
								label={__("Crossfade")}
								checked={ crossfade }
								onChange={(crossfade) => setAttributes({ crossfade })}
							/>
						)}
					</PanelBody>

					{autoplay && (
						<AutoplayPanel
							attributes={attributes}
							setAttributes={setAttributes}
						/>
					)}

					{hasNavigation && (
						<NavigationPanel
							attributes={attributes}
							setAttributes={setAttributes}
						/>
					)}

					{hasPagination && (
						<PaginationPanel
							attributes={attributes}
							setAttributes={setAttributes}
						/>
					)}

					{hasScrollbar && (
						<ScrollbarPanel
							attributes={attributes}
							setAttributes={setAttributes}
						/>
					)}
				</Panel>
			</InspectorControls>
			<AdvancedControls
				attributes={attributes}
				setAttributes={setAttributes}
			/>
		</>
	);
};

export default SliderInspectorControls;
