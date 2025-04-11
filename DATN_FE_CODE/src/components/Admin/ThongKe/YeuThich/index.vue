<template>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header text-white">
                    <div class="row">
                        <div class="col text-center">
                            <h5><b>THỐNG KÊ LƯỢT YÊU THÍCH PHIM</b></h5>
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
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h6 class="mb-0">Top Phim Được Yêu Thích Nhất</h6>
                                </div>
                                <div class="card-body">
                                    <Bar v-if="loaded" :data="chartData" :options="chartOptions" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">Chi Tiết Lượt Yêu Thích</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Tên Phim</th>
                                                    <th class="text-center">Số Lượt Yêu Thích</th>
                                                    <th class="text-center">Tỷ Lệ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in favoriteList" :key="index">
                                                    <td class="text-center">{{ index + 1 }}</td>
                                                    <td>{{ item.ten_phim }}</td>
                                                    <td class="text-center">{{ item.so_luot_thich }}</td>
                                                    <td class="text-center">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" 
                                                                 role="progressbar" 
                                                                 :style="{ width: item.ty_le + '%' }" 
                                                                 :aria-valuenow="item.ty_le" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100">
                                                                {{ item.ty_le }}%
                                                            </div>
                                                        </div>
                                                    </td>
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
            loaded: false,
            favoriteList: [],
            chartData: {
                labels: [],
                datasets: [{
                    label: 'Số lượt yêu thích',
                    backgroundColor: '#e74a3b',
                    borderColor: '#e74a3b',
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
            this.loaded = false
            baseRequest.post('admin/thong-ke/yeu-thich', {
                tu_ngay: this.tuNgay,
                den_ngay: this.denNgay
            }).then((res) => {
                this.favoriteList = res.data.list_yeu_thich
                
                // Cập nhật dữ liệu cho biểu đồ
                this.chartData.labels = this.favoriteList.map(item => item.ten_phim)
                this.chartData.datasets[0].data = this.favoriteList.map(item => item.so_luot_thich)
                
                this.loaded = true
            })
        }
    }
}
</script>

<style scoped>
.progress {
    height: 20px;
}
.progress-bar {
    min-width: 2em;
}
</style> 