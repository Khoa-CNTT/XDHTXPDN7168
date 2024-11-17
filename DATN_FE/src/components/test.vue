<template>
    <div>
        <h1>Google Login</h1>
        <a href="http://127.0.0.1:8000/api/auth/google">Login with Google</a>

        <!-- Hiển thị thông tin user sau khi đăng nhập -->
        <div v-if="user">
            <p>Welcome, {{ user.name }}</p>
            <img :src="user.avatar" alt="User Avatar" />
        </div>

        <!-- Hiển thị lỗi nếu có -->
        <div v-if="error" class="error">{{ error }}</div>
    </div>
</template>

<script>
import axios from "axios";
import baseRequestUser from "../core/baseRequestUser";

export default {
    data() {
        return {
            user: null,
            error: null,
        };
    },
    methods: {
        async handleGoogleLogin() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/auth/google", {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                this.user = response.data.user; // Lưu thông tin user trả về
                this.$router.push('/'); // Chuyển hướng đến dashboard hoặc view khác
            } catch (error) {
                if (error.response && error.response.data) {
                    this.error = error.response.data.error || "Something went wrong.";
                } else {
                    this.error = "Unable to connect to the server.";
                }
            }
        },


    },
};
</script>
