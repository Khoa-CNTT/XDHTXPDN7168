<template>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="card login-card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="login-logo-container">
                        </div>
                        <h3 class="login-title mt-3">ĐĂNG NHẬP ADMIN</h3>
                        <p class="text-muted">Truy cập hệ thống quản trị</p>
                    </div>

                    <form 
                        class="form-body" 
                        @submit.prevent="dangNhap"
                        novalidate
                    >
                        <div class="mb-4">
                            <label class="form-label">Địa Chỉ Email</label>
                            <div class="input-group input-group-lg has-validation">
                                <span class="input-group-text bg-transparent">
                                    <i class="bx bx-envelope"></i>
                                </span>
                                <input 
                                    type="email" 
                                    v-model="dang_nhap.email" 
                                    :class="[
                                        'form-control form-control-lg',
                                        check_validate && errors.email ? 'is-invalid' : ''
                                    ]"
                                    placeholder="Nhập Email" 
                                    required
                                />
                                <div 
                                    v-if="check_validate && errors.email" 
                                    class="invalid-feedback"
                                >
                                    {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label">Mật Khẩu</label>
                                <a 
                                    href="#" 
                                    class="forgot-link text-decoration-none"
                                >
                                    Quên mật khẩu?
                                </a>
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-transparent">
                                    <i class="bx bx-lock"></i>
                                </span>
                                <input 
                                    :type="showPassword ? 'text' : 'password'"
                                    v-model="dang_nhap.password"
                                    class="form-control form-control-lg" 
                                    placeholder="Nhập Mật Khẩu"
                                    required
                                />
                                <button 
                                    type="button"
                                    class="input-group-text bg-transparent"
                                    @click="showPassword = !showPassword"
                                >
                                    <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button 
                                type="submit" 
                                class="btn btn-primary btn-lg login-btn"
                            >
                                <i class="bx bxs-lock-open me-2"></i>
                                Đăng Nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
import functionBasic from "../../../core/functionBasic";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            showPassword: false,
            dang_ky: {},
            dang_nhap: {},
            check_token: {},
            is_login: true,
            list_token: [],
            remove_token: {},
            check_validate: false,
            errors: {},
        };
    },
    mounted() {
        // this.is_login = false;
        this.checkToken();
    },
    methods: {
        dangNhap() {
            axios
                .post("http://127.0.0.1:8000/api/login", this.dang_nhap)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem("token", arr[1]);
                        localStorage.setItem("avt_admin", res.data.avt_admin);
                        localStorage.setItem("name_admin", res.data.name_admin);
                        localStorage.setItem("ten_chuc_vu", res.data.chuc_vu);
                        // console.log(arr[1]);
                        this.checkToken();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    this.check_validate = true;
                    this.errors = res.response.data.errors;
                    // errors.forEach(function(v,k){
                    //         toaster.error(v[0]);
                    // });
                });
        },
        checkToken() {
            axios
                .post(
                    "http://127.0.0.1:8000/api/check",
                    {},
                    {
                        headers: {
                            Authorization: "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((res) => {
                    if (res.status === 200) {
                        this.is_login = true;
                        window.location.href = "/admin";
                    }
                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        removeToken() {
            axios
                .delete(
                    "http://127.0.0.1:8000/api/thong-tin-xoa/" + this.remove_token.id
                )
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        (this.list_token = []), this.checkToken();
                    }
                });
        },
        /// file base 64
        async imageToBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);

                reader.onload = () => resolve(reader.result);
                reader.onerror = (error) => reject(error);
            });
        },

        async handleFileChange(event) {
            const file = event.target.files[0];

            if (file) {
                try {
                    const base64Data = await this.imageToBase64(file);
                    console.log("Base64 Data:", base64Data);
                    this.dang_ky.hinh_anh = base64Data;
                    // Thực hiện các hành động khác với base64Data ở đây
                } catch (error) {
                    console.error("Error converting image to base64:", error);
                }
            }
        },
    },
};
</script>

<style scoped>
.login-container {
    min-height: 100vh;
    /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-wrapper {
    width: 100%;
    max-width: 450px;
}

.login-card {
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    overflow: hidden;
}

.login-logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.login-logo {
    max-width: 120px;
    height: auto;
}

.login-title {
    color: #2c3e50;
    font-weight: 700;
    letter-spacing: 1px;
}

.login-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
</style>