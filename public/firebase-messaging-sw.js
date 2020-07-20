// [START initialize_firebase_in_sw]
// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts("https://www.gstatic.com/firebasejs/7.8.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.8.2/firebase-messaging.js");
// // Initialize the Firebase app in the service worker by passing in the messagingSenderId.
// firebase.initializeApp({
//   'messagingSenderId': '172957971468' // 4. Get Firebase Configuration
// });

// // Retrieve an instance of Firebase Messaging so that it can handle background messages.
// const messaging = firebase.messaging();
// // [END initialize_firebase_in_sw]

let config = {
    apiKey: "AIzaSyBtLvHr2gYFVMdad8JmtUeLUATc1TV4qFI",
    authDomain: "portal-baboon.firebaseapp.com",
    databaseURL: "https://portal-baboon.firebaseio.com",
    projectId: "portal-baboon",
    storageBucket: "portal-baboon.appspot.com",
    messagingSenderId: "172957971468",
    appId: "1:172957971468:web:34c41d3f1c771b1b8faa29",
    measurementId: "G-8QVGKVYDKZ"
};
firebase.initializeApp(config);
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(' Received background message ', payload);
    let title = 'Recipe PWA',
        options = {
            body: "New Recipe Alert",
            icon: "https://raw.githubusercontent.com/idoqo/laravel-vue-recipe-pwa/master/public/recipe-book.png"
        };
    return self.registration.showNotification(
        title,
        options
    );
});