const { styles, hostname, build } = require('./package.json').config;
const { resolve } = require('path');

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
module.exports = {
    mode: "development",
    entry: './src/index.js',
    output: {
        path: path.resolve(__dirname, build),
        filename: 'js/main.js',
    },
    module: {

        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    
                    // Creates `style` nodes from JS strings
                    MiniCssExtractPlugin.loader,

                    // Translates CSS into CommonJS
                    "css-loader",
                    'postcss-loader',
                    // Compiles Sass to CSS
                    "sass-loader",
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/main.css',
        }),
        new (require('stylelint-webpack-plugin'))({
            customSyntax: 'postcss-scss',
            files: resolve(process.cwd(), styles),
            fix: true,
        }),
        new BrowserSyncPlugin({
            proxy: `https://${hostname}`,
            host: 'localhost',
        })
    ],

    watch: true
};