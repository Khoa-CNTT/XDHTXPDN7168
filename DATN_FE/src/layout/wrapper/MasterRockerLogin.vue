<template>
    <body class="bg-login">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
                style="margin-top: 100px;">
                <div class="container-fluid">
                    <RouterView></RouterView>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
import '../../assets/assets_Rocker/js/bootstrap.bundle.min.js';
import '../../assets/assets_Rocker/js/jquery.min.js';
import '../../assets/assets_Rocker/plugins/simplebar/js/simplebar.min.js';
import '../../assets/assets_Rocker/plugins/metismenu/js/metisMenu.min.js';
import '../../assets/assets_Rocker/plugins/perfect-scrollbar/js/perfect-scrollbar.js';
import '../../assets/assets_Rocker/js/index.js';
import '../../assets/assets_Rocker/js/app.js';
export default {
    name: 'app',
    components: {
    },
}
</script>
<style>
@import '../../assets/assets_Rocker/plugins/simplebar/css/simplebar.css';
@import '../../assets/assets_Rocker/plugins/perfect-scrollbar/css/perfect-scrollbar.css';
@import '../../assets/assets_Rocker/css/bootstrap.min.css';
@import '../../assets/assets_Rocker/css/bootstrap-extended.css';
@import '../../assets/assets_Rocker/css/app.css';
@import '../../assets/assets_Rocker/css/icons.css';
@import '../../assets/assets_Rocker/css/dark-theme.css';
@import '../../assets/assets_Rocker/css/semi-dark.css';
@import '../../assets/assets_Rocker/css/header-colors.css';
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css");
</style>
