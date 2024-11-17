//Sau này đổi tên lại thành Middleware nhé
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function(to, from, next) {
    axios
        .post('http://127.0.0.1:8000/api/check', {}, {
            headers: {
                Authorization: 'Bearer ' +  localStorage.getItem('token')
            }}
        )
        .then((res) => {
            if(res.status === 200) {
                next();
            } else {
                this.$store.dispatch('showWarning', {description: "Bạn cần đăng nhập hệ thống trước",});
                next('/admin/login');
            }
        })
        .catch(() => {
            this.$store.dispatch('showWarning', {description: "Bạn cần đăng nhập hệ thống trước",});
            next('/admin/login');
        });
}
