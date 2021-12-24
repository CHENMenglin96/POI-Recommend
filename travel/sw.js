var cacheName = 'travel';
var filesToCache = [
  '/',
    'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap',
    'https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmEU9fBBc4.woff2',
    'https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmWUlfBBc4.woff2',
    'https://fonts.gstatic.com/s/roboto/v20/KFOmCnqEu92Fr1Mu4mxK.woff2',
    'css/style.css',
    'fonts/fontawesome-webfont.eot',
    'fonts/fontawesome-webfont.svg',
    'fonts/fontawesome-webfont.ttf',
    'fonts/fontawesome-webfont.woff',
    'fonts/fontawesome-webfont.woff2',
    'fonts/FontAwesome.otf',
    'fonts/LineIcons.eot',
    'fonts/LineIcons.svg',
    'fonts/LineIcons.ttf',
    'fonts/LineIcons.woff',
    'fonts/LineIcons.woff2',
    'images/icons/icon-128x128.png',
    'images/icons/icon-144x144.png',
    'images/icons/icon-152x152.png',
    'images/icons/icon-167x167.png',
    'images/icons/icon-180x180.png',
    'images/icons/icon-192x192.png',
    'images/icons/icon-384x384.png',
    'images/icons/icon-512x512.png',
    'images/icons/icon-72x72.png',
    'images/icons/icon-96x96.png',
    'js/main.js',
    'index.html',
    'activity.php',
    'category.php',
    'detailTrip.php',
    'modifierTrip.php',
    'trip.php',
    'mytrips.php',
    'prefer.php',
    'profile2.php',
    'register.php',
    'changeProf.php',
    'changePWD.php',
    'connect.php',
    'TestPWD.php',
    'tripRecommend.php',
    'tripRecommendDetail.php',
    'usertrip.php',
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});

/* Serve cached content when offline */
self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
});