// webpack.mix.js

const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       //
   ])
   .version(); // برای کش‌بریِک
const mix = require('laravel-mix');
mix.css('resources/css/app.css', 'public/css');