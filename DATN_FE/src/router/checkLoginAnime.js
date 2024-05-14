//Sau này đổi tên lại thành Middleware nhé
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function(to, from, next) {
    axios
        .post('http://127.0.0.1:8000/api/khach-hang/check', {}, {
            headers: {
                Authorization: 'Bearer ' +  localStorage.getItem('token_user')
            }}
        )
        .then((res) => {
            localStorage.setItem('ho_ten_user', res.data.ho_ten);
            localStorage.setItem('hinh_anh_user', res.data.hinh_anh);
            if(res.status === 200) {
                next();
            } else {
                toaster.warning('Thông báo<br>Bạn cần đăng nhập hệ thống trước!');
                next('/');
            }
        })
        .catch(() => {
            toaster.warning('Thông báo<br>Bạn cần đăng nhập hệ thống trước!');
            next('/home/login');
        });
}
