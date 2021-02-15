/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("../bootstrap");

window.Vue = require("vue").default;

import VueRouter from "./router";

import firebase from "firebase";
import messaging from "firebase/messaging";
// Your web app's Firebase configuration
var firebaseConfig = {
    databaseURL: "https://test-8aab5-default-rtdb.firebaseio.com/",
    apiKey: "AIzaSyCzoHgPfuY-tHj0Y4mSuSUxIrPmjI1ZlQ4",
    authDomain: "test-8aab5.firebaseapp.com",
    projectId: "test-8aab5",
    storageBucket: "test-8aab5.appspot.com",
    messagingSenderId: "772462251047",
    appId: "1:772462251047:web:7bfe57d7c8902472359202",
    measurementId: "G-GS7BD7QQZH"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
Vue.prototype.$messaging = firebase.messaging();
//

Vue.prototype.$messaging
    .getToken({
        vapidKey:
            "BCgOZ-7JxGkksM8vFNgmJ9Fkohw9oB1_tbnQYZTqufyzrT65sx3cYBTYr8oYsOEGcF0bLuKI7dpgl02YHAllmrI"
    })
    .then(currentToken => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
            // console.log(currentToken);
            if (localStorage.getItem("FCM") != "1")
                axios
                    .post("/api/admin/storeFCM", {
                        fcm: currentToken
                    })
                    .then(res => {
                        console.log(res.data.status);
                        localStorage.setItem("FCM", "1");
                    })
                    .catch(err => {
                        console.log(err.response);
                        localStorage.setItem("FCM", "0");
                    });
        } else {
            // Show permission request UI
            console.log(
                "No registration token available. Request permission to generate one."
            );
            localStorage.setItem("FCM", "0");

            // ...
        }
    })
    .catch(err => {
        console.log("An error occurred while retrieving token. ", err);
        localStorage.setItem("FCM", "0");

        // ...
    });

// PrismJS
navigator.serviceWorker
    .register("/firebase-messaging-sw.js")
    .then(registration => {
        Vue.prototype.$messaging.useServiceWorker(registration);
    })
    .catch(err => {
        console.log(err);
    });

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: process.env.MIX_PUSHER_APP_KEY,
//     wsHost: "127.0.0.1",
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true
// });

// // global.jQuery = require("jquery");
// var $ = global.jQuery;
// window.$ = $;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("app-component", require("./AppComponent.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router: VueRouter
});
