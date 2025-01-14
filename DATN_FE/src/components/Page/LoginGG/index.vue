<template>




</template>
<script>
import axios from 'axios';
import baseRequest from '../../../core/baseRequestUser';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            obj_user: {},
        }
    },
    mounted() {
        this.checkHashLogin();
    },
    methods: {
        async checkHashLogin() {
            const response = await axios.get("https://wopai-be.dzfullstack.edu.vn/api/kiem-tra-login-google", {
                headers: {
                    Authorization: 'Bearer ' + this.$route.params.token
                }
            })
            if (response.data.status == true) {
                localStorage.setItem('token_user', response.data.token);
                localStorage.setItem('ho_ten_user', response.data.ho_ten_user);
                localStorage.setItem('hinh_anh_user', response.data.hinh_anh_user);
                localStorage.setItem('id_user', response.data.id_user);
                this.$router.push('/');
                this.$store.dispatch('showSuccess', { description: response.data.message, });
            } else {
                this.$store.dispatch('showError', { description: response.data.message, });
                this.$router.push('/login');
            }
        },
    }
}
</script>
<style></style>
