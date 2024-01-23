import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkLogin from "./checkLoginAdmin";
import checkLoginAnime from "./checkLoginAnime";
const routes = [
    // Page Anime
    {
        path : '/',
        component: ()=>import('../components/Page/HomeAnime/index.vue'),

    },
    {
        path : '/login',
        component: ()=>import('../components/Page/Login/index.vue'),
        meta : {layout : 'loginanime'} ,

    },
    {
        path : '/forget-password',
        component: ()=>import('../components/Page/QuenMatKhau/index.vue'),
        meta : {layout : 'loginanime'} ,

    },
    {
        path : '/reset-password/:hash',
        component: ()=>import('../components/Page/DatLaiMatKhau/index.vue'),
        meta : {layout : 'loginanime'} ,

    },
    {
        path : '/kich-hoat-email/:hash',
        component: ()=>import('../components/Page/XacThucEmail/index.vue'),
        meta : {layout : 'loginanime'} ,

    },
    {
        path : '/register',
        component: ()=>import('../components/Page/Register/index.vue'),
        meta : {layout : 'loginanime'} ,

    },
    {
        path : '/list-phim',
        component: ()=>import('../components/Page/ListPhim/index.vue'),

    }, 
    {
        path : '/the-loai/:slug',
        component: ()=>import('../components/Page/PageList/index.vue'),
        name: 'PageList',
        props: route => ({ id: route.params.id, slug : route.params.slug }),

    }, 
    {
        path : '/de-list/:slug',
        component: ()=>import('../components/Page/PageDelist/index.vue'),
        name: 'PageDelist',
        props: route => ({ id: route.params.id, slug : route.params.slug }),


    },
    {
        path : '/index3/:id',
        component: ()=>import('../components/Page/PageWatch/index.vue'),

    }, 
    {
        path : '/loai-phim/:slug',
        component: ()=>import('../components/Page/PageLoaiPhim/index.vue'),
        name: 'PageLoaiPhim',
        props: route => ({ id: route.params.id, slug : route.params.slug }),

    },
    {
        path : '/tim-kiem/:id',
        component: ()=>import('../components/Page/PageSearch/index.vue'),

    },
    {
        path : '/profile',
        component: ()=>import('../components/Page/PageProfile/index.vue'),

    },
    //Page Blog
    {
        path : '/index4',
        component: ()=>import('../components/Page/BlogList/index.vue'),

    }, 
    {
        path : '/index5/:id',
        component: ()=>import('../components/Page/BlogDelist/index.vue'),

    }, 
    
    /// Admin
    {
        path : '/admin/profile',
        component: ()=>import('../components/Admin/ProfileAdmin/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/the-loai',
        component: ()=>import('../components/Admin/TheLoai/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/tk-admin',
        component: ()=>import('../components/Admin/AdminAnime/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/khach-hang',
        component: ()=>import('../components/Admin/KhachHang/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/khach-hang',
        component: ()=>import('../components/Admin/KhachHang/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/bai-viet',
        component: ()=>import('../components/Admin/BaiViet/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
    {
        path : '/admin/chuyen-muc',
        component: ()=>import('../components/Admin/ChuyenMucBlog/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'} ,
    },
   
    {
        path : '/admin/loai-phim',
        component: ()=>import('../components/Admin/LoaiAnime/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'}

    },
    {
        path : '/admin/tac-gia',
        component: ()=>import('../components/Admin/TacGia/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'}

    },
     {
        path : '/admin/anime',
        component: ()=>import('../components/Admin/Phim/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'}
    },
    {
        path : '/admin/tap-phim',
        component: ()=>import('../components/Admin/TapPhim/index.vue'),
        beforeEnter: checkLogin,
        meta : {layout : 'new'}
    },
    {
        path : '/admin/login',
        component: ()=>import('../components/Admin/Login/index.vue'),
        meta : {layout : 'login'}
    },
    {
        path : '/admin/register',
        component: ()=>import('../components/Admin/Register/index.vue'),
        meta : {layout : 'login'}
    },
    
    
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router