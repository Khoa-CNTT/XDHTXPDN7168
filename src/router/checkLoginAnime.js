const API_URL = import.meta.env.VITE_API_URL;
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function (to, from, next) {
  axios
    .post(
      API_URL + 'khach-hang/check',
      {},
      {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token_user"),
        },
      }
    )
    .then((res) => {
      // localStorage.setItem("ho_ten_user", res.data.ho_ten);
      // localStorage.setItem("hinh_anh_user", res.data.hinh_anh);
      if (res.status === 200) {
        next();
      } else {
        this.$store.dispatch("showWarning", {
          description: "Bạn cần đăng nhập hệ thống trước",
        });

        next("/");
      }
    })
    .catch(() => {
      this.$store.dispatch("showWarning", {
        description: "Bạn cần đăng nhập hệ thống trước",
      });

      next("/login");
    });
}
