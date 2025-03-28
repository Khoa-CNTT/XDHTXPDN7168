<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option" style="background-color: #0b0c2a">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
                        <router-link to="/lich-su-xem"> Lịch sử xem</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad" style="background-color: #0b0c2a; padding-bottom: 400px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-white" style="background-color: #0b0c2adb">
                            <div class="trending__product" style="margin-bottom: 0px">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="section-title">
                                            <h4>LỊCH SỬ XEM PHIM</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="watchHistory.length > 0" class="history-list">
                                <div v-for="item in watchHistory" :key="item.id" class="history-item">
                                    <div class="movie-poster">
                                        <img :src="item.poster" :alt="item.tenPhim">
                                    </div>
                                    <div class="movie-info">
                                        <h3>{{ item.tenPhim }}</h3>
                                        <p>Đã xem: {{ formatDate(item.ngayXem) }}</p>
                                        <p>Thời lượng đã xem: {{ item.thoiLuongXem }} phút</p>
                                        <button @click="xemLaiPhim(item.slug)" class="watch-again-btn">
                                            Xem lại
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div v-else class="empty-history">
                                <p>Bạn chưa xem phim nào.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import baseRequest from "../../../core/baseRequestUser";

export default {
    name: 'LichSuXem',
    setup() {
        const watchHistory = ref([])
        const router = useRouter()

        const fetchWatchHistory = async () => {
            try {
                baseRequest.get(`khach-hang/lich-su-xem`, {
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem("token_user"),
                    },
                })
                    .then((res) => {
                        if (res.data.status) {
                            watchHistory.value = res.data.data
                        }
                    })
            } catch (error) {
                console.error('Lỗi khi lấy lịch sử xem:', error)
            }
        }

        const formatDate = (date) => {
            return new Date(date).toLocaleDateString('vi-VN', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })
        }

        const xemLaiPhim = (slugPhim) => {
            router.push(`/${slugPhim}`)
        }

        onMounted(() => {
            fetchWatchHistory()
        })

        return {
            watchHistory,
            formatDate,
            xemLaiPhim
        }
    }
}
</script>

<style scoped>
.history-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.history-item {
    display: flex;
    background: rgba(35, 33, 33, 0.9);
    border-radius: 8px;
    padding: 15px;
    transition: transform 0.3s ease;
}

.history-item:hover {
    transform: translateY(-5px);
}

.movie-poster {
    width: 120px;
    margin-right: 20px;
}

.movie-poster img {
    width: 100%;
    height: auto;
    border-radius: 4px;
}

.movie-info {
    flex: 1;
}

.movie-info h3 {
    margin: 0 0 10px 0;
    font-size: 18px;
    color: #ffffff;
}

.movie-info p {
    margin: 5px 0;
    color: #b7b7b7;
}

.watch-again-btn {
    background: #e53637;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.3s ease;
}

.watch-again-btn:hover {
    background: #c11c1c;
}

.empty-history {
    text-align: center;
    padding: 40px;
    color: #b7b7b7;
}

.section-title h4 {
    color: #ffffff;
    font-weight: 700;
    line-height: 21px;
    text-transform: uppercase;
    padding-left: 20px;
    position: relative;
}

.section-title h4:after {
    position: absolute;
    left: 0;
    top: -6px;
    height: 32px;
    width: 4px;
    background: #e53637;
    content: "";
}
</style>