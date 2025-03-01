import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkLoginUser from "./checkLoginAnime";
import checkloginAdmin from "./checkLoginAdmin";
import checkUserTerm from "./checkUserTerm";
import ThongKeChung from "../components/Admin/ThongKe/ThongKeChung.vue";
import ThongKeLuotXem from "../components/Admin/ThongKe/LuotXem/index.vue";
import ThongKeBinhLuan from "../components/Admin/ThongKe/BinhLuan/index.vue";
import ThongKeYeuThich from "../components/Admin/ThongKe/YeuThich/index.vue";
const routes = [
  {
    path: "/home",
    component: () => import("../layout/wrapper/MasterAnimeLogin.vue"),
    children: [
      //   {
      //     path: "login",
      //     component: () => import("../components/Page/Login/index.vue"),
      //   },
      {
        path: "forget-password",
        component: () => import("../components/Page/QuenMatKhau/index.vue"),
      },
      {
        path: "reset-password/:hash",
        component: () => import("../components/Page/DatLaiMatKhau/index.vue"),
      },
      {
        path: "kich-hoat-email/:hash",
        component: () => import("../components/Page/XacThucEmail/index.vue"),
      },
      {
        path: "auth-google/statute/:token",
        component: () => import("../components/Page/LoginGG/index.vue"),
        // props: true,
      },
    ],
  },
  {
    path: "/",
    component: () => import("../layout/wrapper/MasterAnime.vue"),
    children: [
      {
        path: "test",
        component: () => import("../components/test.vue"),
      },
      {
        path: "login",
        component: () => import("../components/Page/Login/index.vue"),
        // beforeEnter: checkloginAdmin,
      },
      {
        path: "register",
        component: () => import("../components/Page/Register/index.vue"),
      },
      //   {
      //     path: "thanh-toan",
      //     component: () => import("../components/Page/MuaVip/index.vue"),
      //   },
      // Page Anime
      {
        path: "",
        component: () => import("../components/Page/HomeAnime/index.vue"),
      },

      {
        path: "tat-ca-phim",
        component: () => import("../components/Page/ListPhim/index.vue"),
      },
      {
        path: "the-loai/:slug",
        component: () => import("../components/Page/PageList/index.vue"),
        name: "PageList",
        // props: (route) => ({ slug: route.params.slug }),
      },
      {
        path: ":slug",
        component: () => import("../components/Page/PageDelist/index.vue"),
        name: "PageDelist",
        // props: true,
      },
      {
        path: ":slugMovie/:slugEpisode",
        component: () => import("../components/Page/PageWatch/index.vue"),
        // props: true,
        beforeEnter: checkUserTerm,
      },
      {
        path: "loai-phim/:slug",
        component: () => import("../components/Page/PageLoaiPhim/index.vue"),
        name: "PageLoaiPhim",
        // props: (route) => ({ id: route.params.id, slug: route.params.slug }),
      },
      {
        path: "tim-kiem/:id",
        component: () => import("../components/Page/PageSearch/index.vue"),
      },
      {
        path: "profile",
        component: () => import("../components/Page/PageProfile/index.vue"),
        beforeEnter: checkLoginUser,
      },
      //Page Blog
      {
        path: "blog",
        component: () => import("../components/Page/BlogList/index.vue"),
      },
      {
        path: "blog/:slug",
        component: () => import("../components/Page/BlogDelist/index.vue"),
      },
      {
        path: "lich-su-xem",
        name: "LichSuXem",
        component: () => import("../components/User/LichSuXem/index.vue"),
        beforeEnter: checkLoginUser,
      },
    ],
  },

  /// Admin
  {
    path: "/admin",
    component: () => import("../layout/wrapper/MasterRocker.vue"),
    beforeEnter: checkloginAdmin,
    children: [
      //   {
      //     path: "test",
      //     component: () => import("../components/test_1.vue"),
      //   },
      {
        path: "leech-phim",
        component: () => import("../components/Admin/LeechPhim/index.vue"),
      },
      {
        path: "",
        component: () => import("../components/Admin/Dashboard/index.vue"),
      },
      {
        path: "danh-muc",
        component: () => import("../components/Admin/DanhMuc/index.vue"),
      },
      {
        path: "config-slide",
        component: () => import("../components/Admin/ConfigSlide/index.vue"),
      },
      {
        path: "goi-vip",
        component: () => import("../components/Admin/GoiVip/index.vue"),
      },
      {
        path: "profile",
        component: () => import("../components/Admin/ProfileAdmin/index.vue"),
      },
      {
        path: "the-loai",
        component: () => import("../components/Admin/TheLoai/index.vue"),
      },
      {
        path: "tk-admin",
        component: () => import("../components/Admin/AdminAnime/index.vue"),
      },
      {
        path: "chuc-vu",
        component: () => import("../components/Admin/ChucVu/index.vue"),
      },
      //   {
      //     path: "khach-hang",
      //     component: () => import("../components/Admin/KhachHang/index.vue"),
      //
      //   },
      {
        path: "khach-hang",
        component: () => import("../components/Admin/KhachHang/index.vue"),
      },
      {
        path: "bai-viet",
        component: () => import("../components/Admin/BaiViet/index.vue"),
      },
      {
        path: "chuyen-muc",
        component: () => import("../components/Admin/ChuyenMucBlog/index.vue"),
      },

      {
        path: "loai-phim",
        component: () => import("../components/Admin/LoaiAnime/index.vue"),
      },
      {
        path: "dien-vien",
        component: () => import("../components/Admin/DienVien/index.vue"),
      },
      {
        path: "tac-gia",
        component: () => import("../components/Admin/TacGia/index.vue"),
      },
      {
        path: "anime",
        component: () => import("../components/Admin/Phim/index.vue"),
      },
      {
        path: "phan-quyen",
        component: () => import("../components/Admin/PhanQuyen/index.vue"),
      },
      {
        path: "tap-phim",
        component: () => import("../components/Admin/TapPhim/index.vue"),
      },
      {
        path: "thong-ke/loai-phim",
        component: () =>
          import("../components/Admin/ThongKe/LoaiPhim/index.vue"),
      },
      {
        path: "thong-ke/doanh-thu",
        component: () =>
          import("../components/Admin/ThongKe/DoanhthuGoi/index.vue"),
      },
      {
        path: "quan-li-thanh-toan",
        component: () => import("../components/Admin/ThanhToan/index.vue"),
      },
      {
        path: "thong-ke",
        name: "AdminThongKe",
        component: ThongKeChung,
      },
      {
        path: "thong-ke/luot-xem",
        name: "ThongKeLuotXem",
        component: ThongKeLuotXem,
      },
      {
        path: "thong-ke/binh-luan",
        name: "ThongKeBinhLuan",
        component: ThongKeBinhLuan,
      },
      {
        path: "thong-ke/yeu-thich",
        name: "ThongKeYeuThich",
        component: ThongKeYeuThich,
      },
    ],
  },
  //login admin
  {
    path: "/admin",
    component: () => import("../layout/wrapper/MasterRockerLogin.vue"),
    children: [
      {
        path: "login",
        component: () => import("../components/Admin/Login/index.vue"),
      },
      {
        path: "register",
        component: () => import("../components/Admin/Register/index.vue"),
      },
    ],
  },
  {
    path: "/platform/checkout",
    component: () => import("../layout/wrapper/MasterRockerLogin.vue"),
    children: [
      {
        path: "process/:id_goi",
        component: () => import("../components/Checkout/ThanhToan/index.vue"),
        // beforeEnter: checkUserTerm,
        props: true,
      },
      {
        path: "qrPayment/:id_goi",
        component: () => import("../components/Checkout/qrPayment/index.vue"),
        // beforeEnter: checkUserTerm,
        props: true,
      },
      {
        path: "thanks-payment/:email",
        component: () =>
          import("../components/Checkout/PaymentSucces/index.vue"),
        // beforeEnter: checkUserTerm,
        props: true,
      },
      {
        path: "error-payment/:id_goi",
        component: () =>
          import("../components/Checkout/PaymentErrors/index.vue"),
        beforeEnter: checkUserTerm,
        props: true,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
