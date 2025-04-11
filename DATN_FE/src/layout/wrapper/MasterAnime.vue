<template>
    <div id="preloder" v-if="isLoading">
        <div class="loader"></div>
    </div>
    <MenuAnime></MenuAnime>
    <div :class="isMobile < 768 ? 'container-fluid' : ''" style="margin-top: 69px;">
        <router-view></router-view>
    </div>
    <FooterAnime></FooterAnime>
</template>
<script>
import FooterAnime from '../components/FooterAnime.vue';
import MenuAnime from '../components/MenuAnime.vue';
import '../../assets/assets_Anime/js/jquery-3.3.1.min.js';
import '../../assets/assets_Anime/js/bootstrap.min.js';
import '../../assets/assets_Anime/js/player.js';
import '../../assets/assets_Anime/js/jquery.nice-select.min.js';
import '../../assets/assets_Anime/js/mixitup.min.js';
import '../../assets/assets_Anime/js/jquery.slicknav.js';
import '../../assets/assets_Anime/js/owl.carousel.min.js';
import '../../assets/assets_Anime/js/main.js';
import '../../assets/assets_Rocker/js/bootstrap.bundle.min.js';
import { mapState } from 'vuex'; // Thêm import này

export default {
    name: "app",
    components: {
        MenuAnime,
        FooterAnime
    },
    data() {
        return {
            isMobile: window.innerWidth,
        }
    },
    computed: {
        ...mapState(['isLoading']), // Lấy isLoading từ store
    },
    created() {
        window.addEventListener('resize', this.handleResize);

        this.$router.beforeEach((to, from, next) => {
            this.$store.dispatch('showLoader'); // Hiển thị loader khi chuyển trang
            next();
        });

        this.$router.afterEach(() => {
            this.$store.dispatch('hideLoader'); // Ẩn loader sau khi trang đã tải
        });

    },
    methods: {
        handleResize() {
            this.isMobile = window.innerWidth;
        },
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleResize);
    }
}
</script>
<style>
/* @import '../../assets/assets_Rocker/css/bootstrap.min.css'; */


@import '../../assets/assets_Anime/css/bootstrap.min.css';
@import '../../assets/assets_Anime/css/font-awesome.min.css';
@import '../../assets/assets_Anime/css/elegant-icons.css';
@import '../../assets/assets_Anime/css/plyr.css';
@import '../../assets/assets_Anime/css/nice-select.css';
@import '../../assets/assets_Anime/css/owl.carousel.min.css';
@import '../../assets/assets_Anime/css/slicknav.min.css';
@import '../../assets/assets_Anime/css/style.css';
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css');
/* @import url('https://cdnjs.cloudflare.com/ajax/libs/cloudinary-core/2.11.0/cloudinary-core-shrinkwrap.min.js'); */
</style>
