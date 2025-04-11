<template>
    <div class="card shadow mb-4">
        <div class="card-header text-white">
            <div class="row">
                <div class="col text-center">
                    <h5><b>THỐNG KÊ LƯỢT XEM THEO THỜI GIAN</b></h5>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row mb-3">
                <div class="col-1"></div>
                <div class="col-2">
                    <select v-model="kieuThongKe" class="form-control" @change="loadData">
                        <option value="ngay">Theo ngày</option>
                        <option value="thang">Theo tháng</option>
                        <option value="nam">Theo năm</option>
                    </select>
                </div>
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
                    <Line v-if="loaded" :data="chartData" :options="chartOptions" />
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { Line } from 'vue-chartjs'
import baseRequest from '../../../../core/baseRequest'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, LinearScale, CategoryScale, PointElement } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, CategoryScale, PointElement)

export default {
    components: { Line },
    data() {
        return {
            loaded: false,
            kieuThongKe: 'ngay',
            tuNgay: '',
            denNgay: '',
            chartData: {
                labels: [],
                datasets: [{
                    label: 'Lượt xem',
                    backgroundColor: '#4e73df',
                    borderColor: '#4e73df',
                    data: []
                }]
            },
            chartOptions: {
                responsive: true
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
            baseRequest.post('admin/thong-ke/luot-xem', {
                kieu_thong_ke: this.kieuThongKe,
                tu_ngay: this.tuNgay,
                den_ngay: this.denNgay
            }).then((res) => {
                this.chartData.labels = res.data.labels
                this.chartData.datasets[0].data = res.data.data
                this.loaded = true
            })
        }
    }
}
</script>