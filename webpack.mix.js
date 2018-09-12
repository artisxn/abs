const mix = require("laravel-mix");
const OfflinePlugin = require("offline-plugin");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css")
  .extract(["vue", "axios", "lodash", "chart.js"])
  .version()
  .disableNotifications();

mix.webpackConfig({
  plugins: [
    new OfflinePlugin({
      externals: ["/"],
      responseStrategy: "network-first",
      ServiceWorker: {
        entry: "./resources/js/webpush.js",
        navigateFallbackURL: "/",
        events: true,
        minify: true
      }
    })
  ]
});
