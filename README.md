Core
====

```
"dependencies": {
        "axios": "^0.18.0",
        "babel-plugin-react-css-modules": "^3.4.2",
        "babel-polyfill": "^6.26.0",
        "history": "^4.7.2",
        "normalizr": "^3.2.4",
        "react": "^16.4.1",
        "react-dom": "^16.4.1",
        "react-hot-loader": "^4.3.7",
        "react-redux": "^5.0.7",
        "react-router": "^4.3.1",
        "react-router-dom": "^4.3.1",
        "react-router-redux": "^5.0.0-alpha.9",
        "redux": "^4.0.0",
        "redux-form": "^7.4.0",
        "redux-thunk": "^2.3.0",
        "reselect": "^3.0.1",
        "admin-lte": "3.0.0-alpha.2"
    }
```



// WEBPACK

// DEV Only //

```
mix.webpackConfig({ 
    resolve: { 
        symlinks: false ,
        modules: [
            path.resolve('./vendor/etigate/core/resources/js'),
            path.resolve('./node_modules')
        ]
    } 
});
```


mix.react('vendor/etigate/core/resources/js/core.js', 'public/js')
   .sass('vendor/etigate/core/resources/sass/core.scss', 'public/css');
