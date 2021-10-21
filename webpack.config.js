const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    entry: path.resolve(__dirname, './resources/js/app.js'),
    mode: "development",
    module: {
        rules: [
            {test: /\.(js)$/, use: 'babel-loader'},
            {test: /\.vue$/, loader: 'vue-loader'},
            {test: /\.scss$/, use: ['vue-style-loader', 'css-loader', 'sass-loader']}
        ]
    },
    output: {
        path: path.resolve(__dirname, './public'),
        filename: 'bundle.js',
    },
    plugins: [
        new VueLoaderPlugin()
    ],
    resolve: {
        extensions: [".vue", ".js", ".scss"]
    }
}