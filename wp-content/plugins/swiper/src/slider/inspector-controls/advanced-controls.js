import { InspectorAdvancedControls } from '@wordpress/block-editor';
import { Notice, TextareaControl, SelectControl } from '@wordpress/components';

const AdvancedControls = ({ attributes, setAttributes }) => {
	const { advancedSettings, timingFunction } = attributes;

	let advancedSettingsOutput = advancedSettings
		? JSON.parse(advancedSettings)
		: '';
	if (typeof advancedSettingsOutput === 'object') {
		advancedSettingsOutput = advancedSettings;
	}

	return (
		<InspectorAdvancedControls>
			<TextareaControl
				label="Manual JSON"
				help="Add JSON here to force settings into the Swiper configuration object (see https://swiperjs.com/swiper-api#parameters for reference). Mostly intended for responsive stuff, but anything is allowed. Keep in mind that Swiper Breakpoints are mobile-first and move up, so your block settings should define the mobile version, and this field should have the tablet/desktop overrides."
				value={advancedSettingsOutput}
				onChange={(advancedSettings) =>
					setAttributes({ advancedSettings: JSON.stringify(advancedSettings) })
				}
			/>

			<SelectControl
				label="Timing Function"
				value={timingFunction}
				options={[
					{ value: '', label: 'Choose a Timing Function', disabled: true },
					{ value: 'ease', label: 'Ease' },
					{ value: 'ease-in', label: 'Ease In' },
					{ value: 'ease-out', label: 'Ease Out' },
					{ value: 'ease-in-out', label: 'Ease In/Out' },
					{ value: 'linear', label: 'Linear' },
				]}
				onChange={(timingFunction) => setAttributes({ timingFunction })}
			/>
		</InspectorAdvancedControls>
	);
};

export default AdvancedControls;
