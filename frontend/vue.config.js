const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,

  // Enable source maps in development mode for easier debugging
  productionSourceMap: process.env.NODE_ENV !== 'production',

  // ChainWebpack allows you to modify internal webpack configurations
  chainWebpack: config => {
    // Set up aliases for cleaner imports
    config.resolve.alias.set('@', require('path').resolve(__dirname, 'src'))

    // Example: Add a rule for handling markdown files
    config.module
      .rule('markdown')
      .test(/\.md$/)
      .use('raw-loader')
      .loader('raw-loader')
      .end()
  },

  // Configure webpack-dev-server behavior
  devServer: {
    port: 8080, // Change port if needed
    open: true, // Automatically open the browser
    proxy: {
      '/api': {
        target: 'http://localhost:3000', // Proxy API requests to backend server
        changeOrigin: true,
        pathRewrite: { '^/api': '' }
      }
    }
  },

  // Enable PWA features
  pwa: {
    name: 'My Vue App',
    themeColor: '#4DBA87',
    msTileColor: '#000000',
    appleMobileWebAppCapable: 'yes',
    appleMobileWebAppStatusBarStyle: 'black',
    // configure the workbox plugin
    workboxPluginMode: 'GenerateSW',
    workboxOptions: {
      skipWaiting: true
    }
  },

  // Additional plugin options
  pluginOptions: {
    // Example: Add options for a plugin
  },

  // CSS related options
  css: {
    // Enable CSS source maps.
    sourceMap: process.env.NODE_ENV !== 'production'
  }
})
