const pkg = require('./package.json');

const preset = require('postcss-preset-env');
const normalize = require('postcss-normalize');
const pxtorem = require('postcss-pxtorem');
const inlineSVG = require('postcss-inline-svg');
const sortMediaQueries = require('postcss-sort-media-queries');
const uniqueSelectors = require('postcss-unique-selectors');

const pxToRemOptions = {
	propWhiteList: [
		'font',
		'font-size',
		'line-height',
		'letter-spacing',
		'margin',
		'margin-top',
		'margin-right',
		'margin-bottom',
		'margin-left',
		'padding',
		'padding-top',
		'padding-right',
		'padding-bottom',
		'padding-left',
	],
};

const inlineSVGOptions = {
	paths: [pkg.config.images],
	removeFill: true,
	removeStroke: true,
};

module.exports = {
	plugins: [
		preset(),
		normalize(),
		pxtorem(pxToRemOptions),
		inlineSVG(inlineSVGOptions),
		sortMediaQueries(),
		uniqueSelectors(),
	],
};
