const path = require('path');

module.exports = {
    entry:  path.resolve(__dirname, './resources/js/app.js'),
    mode: "development",
    module: {
        rules: [
            {test: /\.(js)$/, use: 'babel-loader'}
        ]
    },
    output: {
        path: path.resolve(__dirname, './public'),
        filename: 'bundle.js',
    }
}