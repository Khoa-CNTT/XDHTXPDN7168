<template>
    <div id="preloder" v-if="isLoading">
        <div class="loader"></div>
    </div>
    <MenuAnime></MenuAnime>
    <div class="container-fluid">
        <router-view></router-view>
    </div>
    <!-- <FooterAnime></FooterAnime> -->
</template>
<script>
import FooterAnime from '../components/FooterAnime.vue';
import MenuAnime from '../components/MenuAnime.vue';
import { mapState } from 'vuex';

export default {
    name: "app",
    components: {
        MenuAnime,
        FooterAnime
    },
    computed: {
        ...mapState(['isLoading']),
    },
    created() {
        this.loadScripts();
        
        this.$router.beforeEach((to, from, next) => {
            this.$store.dispatch('showLoader');
            next();
        });

        this.$router.afterEach(() => {
            this.$store.dispatch('hideLoader');
        });
    },
    mounted() {
        this.$nextTick(() => {
            this.initializeBootstrapComponents();
        });
    },
    methods: {
        loadScripts() {
            const scripts = [
                'https://code.jquery.com/jquery-3.3.1.min.js',
                '/assets/assets_Anime/js/bootstrap.min.js',
                '/assets/assets_Rocker/js/bootstrap.bundle.min.js'
            ];
            
            let loadedCount = 0;
            const totalScripts = scripts.length;
            
            const loadScript = (index) => {
                if (index >= scripts.length) {
                    this.loadSecondaryScripts();
                    return;
                }

                const script = document.createElement('script');
                script.src = scripts[index];
                
                script.onload = () => {
                    loadedCount++;
                    if (loadedCount === totalScripts) {
                        this.loadSecondaryScripts();
                    }
                    loadScript(index + 1);
                };
                
                document.head.appendChild(script);
            };

            loadScript(0);
        },
        
        loadSecondaryScripts() {
            const secondaryScripts = [
                '/assets/assets_Anime/js/player.js',
                '/assets/assets_Anime/js/jquery.nice-select.min.js',
                '/assets/assets_Anime/js/mixitup.min.js',
                '/assets/assets_Anime/js/jquery.slicknav.js',
                '/assets/assets_Anime/js/owl.carousel.min.js',
                '/assets/assets_Anime/js/main.js'
            ];
            
            secondaryScripts.forEach(src => {
                const script = document.createElement('script');
                script.src = src;
                script.async = true;
                document.head.appendChild(script);
            });

            // Initialize Bootstrap components
            this.$nextTick(() => {
                this.initializeBootstrapComponents();
            });
        },

        initializeBootstrapComponents() {
            // Ensure Bootstrap is loaded
            if (typeof bootstrap !== 'undefined') {
                // Initialize all dropdowns
                document.querySelectorAll('.dropdown-toggle').forEach(dropdownToggle => {
                    new bootstrap.Dropdown(dropdownToggle, {
                        autoClose: true
                    });
                });
            } else {
                console.warn('Bootstrap is not loaded');
                // Retry after a short delay
                setTimeout(() => this.initializeBootstrapComponents(), 500);
            }
        }
    }
}
</script>
<style>
@import '../../assets/assets_Rocker/css/bootstrap.min.css';
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
