<template>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header text-white">
                    <div class="row">
                        <div class="col text-center">
                            <h5><b>THỐNG KÊ BÌNH LUẬN VÀ ĐÁNH GIÁ PHIM</b></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-1"></div>
                        <div class="col-lg-1 text-end">
                            <p class="mt-2">Từ Ngày:</p>
                        </div>
                        <div class="col-lg-3">
                            <input type="date" v-model="tuNgay" class="form-control" @change="loadData">
                        </div>
                        <div class="col-lg-1 text-end">
                            <p class="mt-2">Đến Ngày:</p>
                        </div>
                        <div class="col-lg-3">
                            <input type="date" v-model="denNgay" class="form-control" @change="loadData">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Top Phim Được Bình Luận Nhiều Nhất</h6>
                                </div>
                                <div class="card-body">
                                    <Bar v-if="loadedComment" :data="chartDataComment" :options="chartOptions" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Top Phim Có Đánh Giá Cao Nhất</h6>
                                </div>
                                <div class="card-body">
                                    <Bar v-if="loadedRating" :data="chartDataRating" :options="chartOptions" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Bình Luận Gần Đây</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Người Dùng</th>
                                                    <th>Phim</th>
                                                    <th>Nội Dung</th>
                                                    <th>Thời Gian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="comment in recentComments" :key="comment.id">
                                                    <td>{{ comment.ten_nguoi_dung }}</td>
                                                    <td>{{ comment.ten_phim }}</td>
                                                    <td>{{ comment.noi_dung }}</td>
                                                    <td>{{ formatDate(comment.created_at) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import baseRequest from '../../../../core/baseRequest'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    components: { Bar },
    data() {
        return {
            tuNgay: '',
            denNgay: '',
            loadedComment: false,
            loadedRating: false,
            recentComments: [],
            chartDataComment: {
                labels: [],
                datasets: [{
                    label: 'Số lượng bình luận',
                    backgroundColor: '#4e73df',
                    data: []
                }]
            },
            chartDataRating: {
                labels: [],
                datasets: [{
                    label: 'Điểm đánh giá trung bình',
                    backgroundColor: '#1cc88a',
                    data: []
                }]
            },
            chartOptions: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
    },
    mounted() {
        const date = new Date()
        this.denNgay = date.toISOString().slice(0, 10)
        date.setDate(date.getDate() - 30)
        this.tuNgay = date.toISOString().slice(0, 10)
        this.loadData()
    },
    methods: {
        loadData() {
            this.loadedComment = false
            this.loadedRating = false
            
            baseRequest.post('admin/thong-ke/binh-luan', {
                tu_ngay: this.tuNgay,
                den_ngay: this.denNgay
            }).then((res) => {
                // Cập nhật dữ liệu biểu đồ bình luận
                this.chartDataComment.labels = res.data.top_comments.map(item => item.ten_phim)
                this.chartDataComment.datasets[0].data = res.data.top_comments.map(item => item.so_binh_luan)
                this.loadedComment = true

                // Cập nhật dữ liệu biểu đồ đánh giá
                this.chartDataRating.labels = res.data.top_ratings.map(item => item.ten_phim)
                this.chartDataRating.datasets[0].data = res.data.top_ratings.map(item => item.diem_trung_binh)
                this.loadedRating = true

                // Cập nhật danh sách bình luận gần đây
                this.recentComments = res.data.recent_comments
            })
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString('vi-VN', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            })
        }
    }
}
</script> 