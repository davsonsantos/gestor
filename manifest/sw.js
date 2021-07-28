// Cache on install

var staticCacheName = 'GESTOR_2021'
this.addEventListener("install", event => {
    this.skipWaiting();

    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll([
                    'offline.html',
                    'images/offline.png',
                    'https://fonts.googleapis.com/css?family=Assistant:300,400,600,700,800'
                ]);
            })
    )
});


// Clear cache on activate
this.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith('suculentas_cg_ms_')))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});


// Serve from Cache
this.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline.html');
            })
    )
});