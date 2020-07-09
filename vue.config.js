module.exports = {
    pwa: {
        workboxPluginMode: 'GenerateSW',
        workboxOptions: {
            navigateFallback: '/index.php',
            runtimeCaching: [
                {
                    // urlPattern: new RegExp('^https://api.'),
                    handler: 'networkfirst',
                    options: {
                        networkTimeoutSeconds: 20,
                        cacheName: 'api-cache',
                        cacheableResponse: {
                            statuses: [0, 200]
                        }
                    }
                }
            ]
        }
    }
}