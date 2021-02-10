<template>
    <div>
        <router-view />
    </div>
</template>

<script>
//const messaging = firebase.messaging();
export default {
    mounted() {
        // Retrieve Firebase Messaging object.
        // Get Instance ID token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        // this.getNotificationPermission();
        // messaging.onMessage(payload => {
        //     console.log("Message received. ", payload);
        //     // ...
        // });
    },
    methods: {
        // getNotificationPermission() {
        //     messaging
        //         .requestPermission()
        //         .then(() => {
        //             console.log("Notification permission granted.");
        //             this.getFCMToken();
        //         })
        //         .catch(err => {
        //             console.log("Unable to get permission to notify.", err);
        //         });
        // },
        // getFCMToken() {
        //     messaging
        //         .getToken()
        //         .then(currentToken => {
        //             if (currentToken) {
        //                 console.log(currentToken);
        //                 // this.sendFCMtoDatabase(currentToken);
        //             } else {
        //                 console.log(
        //                     "No Instance ID token available. Request permission to generate one."
        //                 );
        //             }
        //         })
        //         .catch(err => {
        //             console.log(
        //                 "An error occurred while retrieving token. ",
        //                 err
        //             );
        //             this.setTokenSentToServer(false);
        //         });
        // },
        // setTokenSentToServer(sent) {
        //     localStorage.setItem("sentToServer", sent ? "1" : "0");
        // },
        // sendFCMtoDatabase(token) {
        //     axios
        //         .post("/api/admin/storeFCM", {
        //             fcm: token
        //         })
        //         .then(res => {
        //             console.log(res.data.status);
        //         })
        //         .catch(err => {
        //             console.log(err.response);
        //         });
        // }
    }
};
</script>

<style></style>
