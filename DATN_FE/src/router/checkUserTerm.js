//Sau này đổi tên lại thành Middleware nhé
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function (to, from, next) {
  axios
    .get(
      "https://wopai-be.dzfullstack.edu.vn/api/check-user-term",
      {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token_user"),
        },
      }
    )
    .then((res) => {
      if (res.data.status == 1) {
        next();
      } else if (res.data.status == 0) {
        this.$store.dispatch("showError", { description: res.data.message });
        next("/");
      } else {
        this.$store.dispatch("showError", { description: res.data.message });
        next("/");
      }
    })
    .catch(() => {
      alert("Đã xảy ra lỗi, vui lòng thử lại sau");
      next("/");
    });
}
