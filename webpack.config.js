const webpack = require("webpack");
const path = require("path");

module.exports = {
    entry: {
        app: "./public/js/app.js",
        appLight: "./public/js/appLight.js",
        appDark: "./public/js/appDark.js"
    },
    output: {
        path: path.resolve(__dirname + "/dist"),
        filename: "[name].bundle.js",
        publicPath: "/dist/"
    },
    module: {
        rules: [{
            test: /\.scss$/,
            use: [
                "style-loader", // creates style nodes from JS strings
                "css-loader",   // translates CSS into CommonJS
                "sass-loader"   // compiles Sass to CSS, using Node Sass by default
            ]
        }]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        })
    ]
};