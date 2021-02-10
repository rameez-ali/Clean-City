// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts("https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.2.5/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    databaseURL: "https://test-8aab5-default-rtdb.firebaseio.com/",
    apiKey: "AIzaSyCzoHgPfuY-tHj0Y4mSuSUxIrPmjI1ZlQ4",
    authDomain: "test-8aab5.firebaseapp.com",
    projectId: "test-8aab5",
    storageBucket: "test-8aab5.appspot.com",
    messagingSenderId: "772462251047",
    appId: "1:772462251047:web:7bfe57d7c8902472359202",
    measurementId: "G-GS7BD7QQZH"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
