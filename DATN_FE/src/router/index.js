import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkLogin from "./checkLogin";
const routes = [
    // Page Anime
    {
        path : '/',
        component: ()=>import('../components/Page/HomeAnime/index.vue'),

    },
    {
        path : '/index2',
        component: ()=>import('../components/Page/PageDelist/index.vue'),

    },
    {
        path : '/index1',
        component: ()=>import('../components/Page/PageList/index.vue'),

    }, 
    {
        path : '/index3',
        component: ()=>import('../components/Page/PageWatch/index.vue'),

    }, 
    //Page Blog
    {
        path : '/index4',
        component: ()=>import('../components/Page/BlogList/index.vue'),

    }, 
    {
        path : '/index5',
        component: ()=>import('../components/Page/BlogDelist/index.vue'),

    }, 
    /// Admin
    {
        path : '/admin/the-loai',
        component: ()=>import('../components/Admin/TheLoai/index.vue'),
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
        path : '/admin/anime',
        component: ()=>import('../components/Admin/Anime/index.vue'),
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