importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');
if (workbox) {

    // top-level routes we want to precache
    workbox.precaching.precacheAndRoute(['/', '/blog']);

    // injected assets by Workbox CLI
    workbox.precaching.precacheAndRoute([
  {
    "url": "css/app.css",
    "revision": "2a4461fc35df4e8d0a0629d72e8d25b5"
  },
  {
    "url": "favicon.ico",
    "revision": "6e7c1397e8ed898e21644d49bf6a0c21"
  },
  {
    "url": "images/icons/icon-128x128.png",
    "revision": "c009b3c0221865d85db088e426e561cd"
  },
  {
    "url": "images/icons/icon-144x144.png",
    "revision": "d99aa12258287ce4b8ceaa78556acd0f"
  },
  {
    "url": "images/icons/icon-152x152.png",
    "revision": "b72085fded861e6b7ceba9a20b8f1fde"
  },
  {
    "url": "images/icons/icon-192x192.png",
    "revision": "28afdec698dd00bc9d540ac28fc6bcff"
  },
  {
    "url": "images/icons/icon-384x384.png",
    "revision": "4ca0be55e49a3975eb5a969a48d09069"
  },
  {
    "url": "images/icons/icon-512x512.png",
    "revision": "d3f3a673c59da7b8de826aa82ef9ab3a"
  },
  {
    "url": "images/icons/icon-72x72.png",
    "revision": "febf3a8f145227e9ce2c184a9ca81b22"
  },
  {
    "url": "images/icons/icon-96x96.png",
    "revision": "2201201403cb8e32fe0459073a45d6fa"
  },
  {
    "url": "images/icons/splash-1125x2436.png",
    "revision": "518e06cdce0a4ffbf7493f540582576e"
  },
  {
    "url": "images/icons/splash-1242x2208.png",
    "revision": "d15ada007d8dd3e45178983910ba711a"
  },
  {
    "url": "images/icons/splash-1242x2688.png",
    "revision": "912a29a0de0fa415744b13a62e85fd13"
  },
  {
    "url": "images/icons/splash-1536x2048.png",
    "revision": "7684d8ea8025ca26d2b258baf263d251"
  },
  {
    "url": "images/icons/splash-1668x2224.png",
    "revision": "bd5c8ce83c1c91ea0c0f501a26ba0c8e"
  },
  {
    "url": "images/icons/splash-1668x2388.png",
    "revision": "6905895b2d7bf4f6de58637c9406069c"
  },
  {
    "url": "images/icons/splash-2048x2732.png",
    "revision": "7a638fcbd3f218dd0395677ab2d1d13e"
  },
  {
    "url": "images/icons/splash-640x1136.png",
    "revision": "8b92656ee822a58032fccb69444e9147"
  },
  {
    "url": "images/icons/splash-750x1334.png",
    "revision": "fe1960a06106e43b488dbeb2eab32f30"
  },
  {
    "url": "images/icons/splash-828x1792.png",
    "revision": "ccb94664dc278e0208b11a20ea329586"
  },
  {
    "url": "js/app.js",
    "revision": "66b6a50db56e43e0106ff26066a881ee"
  },
  {
    "url": "manifest.json",
    "revision": "ae23029cb944acdfe5701d9f6b82737f"
  },
  {
    "url": "mix-manifest.json",
    "revision": "207fd484b7c2ceeff7800b8c8a11b3b6"
  }
]);

    // match routes for homepage, blog and any sub-pages of blog
    workbox.routing.registerRoute(
        /^\/(?:(blog)?(\/.*)?)$/,
        new workbox.strategies.NetworkFirst({
            cacheName: 'static-resources',
        })
    );

    // js/css files
    workbox.routing.registerRoute(
        /\.(?:js|css)$/,
        new workbox.strategies.StaleWhileRevalidate({
            cacheName: 'static-resources',
        })
    );

    // images
    workbox.routing.registerRoute(
        // Cache image files.
        /\.(?:png|jpg|jpeg|svg|gif)$/,
        // Use the cache if it's available.
        new workbox.strategies.CacheFirst({
            // Use a custom cache name.
            cacheName: 'image-cache',
            plugins: [
                new workbox.expiration.Plugin({
                    // Cache upto 50 images.
                    maxEntries: 50,
                    // Cache for a maximum of a week.
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

}