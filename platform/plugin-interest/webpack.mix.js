let mix = require(__dirname + '/../../node_modules/laravel-mix/src/index');
const path = require('path');

let directory_bundle = 'public/platform/plugin';
mix.setPublicPath(path.normalize(directory_bundle));

let build_scss = [
    {
        from: '/src/resources/scss/plugininterest.scss',
        to: 'css/plugininterest.css'
    }
];

let build_js = [
    {
        from: '/src/resources/js/plugininterest.js',
        to: 'js/plugininterest.js'
    },

];

build_scss.map((index) => {
    let from = __dirname + index.from;
    let to   = index.to;
    mix.sass(from, to).minify(directory_bundle + '/' + to).version();
});

build_js.map((index) => {
    let from = __dirname + index.from;
    let to   = index.to;
    if (Array.isArray(index.from)) {
        from = [];
        index.from.forEach(file => {
            from.push(__dirname+ file);
        });
    }
    mix.js(from, to).version();
});

mix.options({
    processCssUrls: false
})
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    });
if (mix.inProduction()) {
    mix.version();
}

