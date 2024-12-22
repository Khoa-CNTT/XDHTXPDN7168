import { createApp } from "vue";
import App from "./App.vue";
import store from "./store";
import axios from "axios";
import Toaster from "@meforma/vue-toaster";
import router from "./router";
import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap';

// import $ from "jquery";
import "ant-design-vue/dist/reset.css";
import { Tree, notification,QRCode} from "ant-design-vue";
notification.config({
  placement: "topRight", // Default placement
  duration: 2, // Default duration
});

const app = createApp(App);
app.config.globalProperties.$notification = notification;

app.use(store);
app.use(QRCode);
app.use(router, axios, Toaster);
app.use(Tree);
app.mount("#app");
