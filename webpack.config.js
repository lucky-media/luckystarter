const webpack = require('webpack');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const {
    CleanWebpackPlugin
} = require('clean-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');
const TailwindCss = require('tailwindcss');
const AutoPrefixer = require('autoprefixer');
const path = require('path');
const fs = require('fs');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const purgecss = require('@fullhuman/postcss-purgecss')({
    // Specify the paths to all of the template files in your project
    content: [
        './src/**/*.twig',
        './src/**/*.js',
    ],

    // Include any special characters you're using in this regular expression
    defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || [],
});

// create a list of twig files to generate
// filter out anything that starts with an underscore or is not a twig file
function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = `${dir}/${file}`;
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory() && path.basename(file).indexOf('_') !== 0) {
            /* Recurse into a subdirectory */
            results = results.concat(walk(file));
        } else if (
            stat &&
            !stat.isDirectory() &&
            path.extname(file) === '.twig' &&
            path.basename(file).indexOf('_') !== 0
        ) {
            /* Is a file */
            results.push(file);
        }
    });
    return results;
}
const files = walk('./src/templates');

// generates html plugins to export
const htmlPlugins = files.map(
    file =>
    // Create new HTMLWebpackPlugin with options
    new HtmlWebpackPlugin({
        filename: file.replace('./src/templates/', '').replace('.twig', '.html'),
        template: path.resolve(__dirname, file),
        hash: true,
    })
);

module.exports = {
    stats: {
        entrypoints: false,
        children: false,
    },
    context: path.resolve(__dirname, 'src'),
    entry: {
        main: './js/app.js',
    },
    output: {
        // publicPath: '/assets/',
        path: path.join(__dirname, './web'),
        filename: '[name].[hash].js',
    },
    module: {
        rules: [{
                test: /\.js$/,
                exclude: /node_modules/,

                use: [{
                    loader: 'babel-loader',
                }, ],
            },
            {
                test: /\.(sa|sc|c)ss$/,
                use: [{
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            hmr: process.env.NODE_ENV === 'development',
                        },
                    },
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            ident: 'postcss',
                            plugins: loader => [
                                TailwindCss,
                                AutoPrefixer,
                                ...(process.env.NODE_ENV == 'production' ? [purgecss] : []),
                            ],
                        },
                    },
                    'sass-loader',
                ],
            },

            {
                test: /\.(woff2?|ttf|eot|svg)(\?.*)?$/i,
                use: 'file-loader?name=fonts/[name].[hash].[ext]',
            },
            // Twig templates
            {
                test: /\.twig$/,
                use: [
                    'raw-loader',
                    {
                        loader: 'twig-html-loader',
                        options: {
                            data: (context) => {
                                const templateFileName = context.resource.split('\\').pop().split('/').pop();
                                const data = path.join(__dirname, `src/templates/_data/${templateFileName}.json`);
                                const global = path.join(__dirname, 'src/templates/_data/global.json');

                                // Force webpack to watch file
                                context.addDependency(data);
                                context.addDependency(global);

                                // Read JSON from individual files
                                const dataJson = context.fs.readJsonSync(data, {
                                    throws: false
                                }) || {};

                                // Read JSON from the global.json file.
                                const globalJson = context.fs.readJsonSync(global, {
                                    throws: false
                                }) || {};

                                // Merge both Data Sources
                                const allData = {
                                    ...dataJson,
                                    ...globalJson
                                };
                                // const allData = [globalJson].concat([dataJson]);
                                return allData;
                            }
                        },
                    },
                ],
            },
        ],
    },

    plugins: [
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 8080,
            server: {
                baseDir: ['web']
            }
        }),

        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: '[name].[hash].css',
            chunkFilename: '[id].css',
        }),

        new CopyWebpackPlugin([{
            from: './assets',
            to: './assets'
        }]),

        new CleanWebpackPlugin({
            protectWebpackAssets: true,
            cleanOnceBeforeBuildPatterns: [],
            cleanAfterEveryBuildPatterns: [
                '*.js',
                '*.css',
                '*.map',
                '.html',
                '!uploads/**',
                '!assets/**',
                'web/**'
            ],
        }),

        new ManifestPlugin({
            filter: ({
                name
            }) => name.endsWith('.js') || name.endsWith('.css'),
        }),
    ].concat(htmlPlugins),

    watch: false,
};