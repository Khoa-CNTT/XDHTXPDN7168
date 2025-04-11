<template>
    <div class="row justify-content-center">
        <div class="card shadow-sm">
            <div class="card-header text-white">
                <div class="row">
                    <div class="col text-center">
                        <h5><b>THỐNG KÊ DOANH THU TỪNG GÓI THEO NGÀY</b></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-1 text-end">
                        <p class="mt-2">Từ Ngày:</p>
                    </div>
                    <div class="col-lg-3">
                        <input v-on:change="loadData()" v-model="thong_ke.begin" type="date" class="form-control">
                    </div>
                    <div class="col-lg-1 text-end">
                        <p class="mt-2">Đến Ngày:</p>
                    </div>
                    <div class="col-lg-3">
                        <input v-on:change="loadData()" v-model="thong_ke.end" type="date" class="form-control">
                    </div>
                    <div class="col-lg-2">
                        <button @click="loadData()" class="btn btn-primary">Thống Kê</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <Bar v-if="loaded" :data="chartData" />
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
import baseRequest from '../../../../core/baseRequest';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
export default {
    components: { Bar },
    data() {
        return {
            loaded: false,
            chartData: null,
            thong_ke: { begin: '', end: '' },
            chartData: {
                labels: [],
                datasets: [
                    {
                        label: 'Thống Kê Số Tập Theo Loại Phim',
                        backgroundColor: [
                            "#C0392B", "#1ABC9C", "#F1C40F", "#E67E22", "#8E44AD", "#2980B9", "#27AE60"
                        ],
                        data: []
                    }
                ]
            },
            chartOptions: {
                responsive: true
            }
        }
    },
    async mounted() {
        this.loaded = false;
        var date = new Date();
        var subday = new Date(date.setDate(date.getDate() - 0));
        this.thong_ke.begin = subday.toISOString().slice(0, 10);
        this.thong_ke.end = new Date().toISOString().slice(0, 10);
        this.loadData();
    },
    methods: {
        loadData() {
            this.loaded = false
            baseRequest
                .post('admin/thong-ke/data-thong-ke-danh-thu', this.thong_ke)
                .then((res) => {
                    if (res.data.status === false) {
                        toaster.error(res.data.message);
                        return;
                    }
                    this.chartData.labels = res.data.list_label;
                    console.log(this.chartData.labels);
                    this.chartData.datasets[0].data = res.data.list_data;
                    this.loaded = true;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        }
    },
}
</script>
<style></style>
