// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAfCptH_y5TA3IP0bbEGRQ1mXwhDzeZCss",
  authDomain: "login-c5a4c.firebaseapp.com",
  projectId: "login-c5a4c",
  storageBucket: "login-c5a4c.firebasestorage.app",
  messagingSenderId: "944810457078",
  appId: "1:944810457078:web:6e3a8a2cd57b7f0dc679d7",
  measurementId: "G-ZB9TC2SZ01"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const analytics = getAnalytics(app);

export { auth };