<template>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="text-wrap">
                            <p class="mb-0 text-secondary">Tổng doanh thu</p>
                            <h4 class="my-1 text-info"> {{ doanhThuCount }} VNĐ</h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class=" text-wrap">
                            <p class="mb-0 text-secondary">Tổng lượt xem</p>
                            <h4 class="my-1 text-danger">{{ viewCount }} </h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                class='bx bx-low-vision'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="px-2" style="border-right: 2px solid black;margin: 0 10px 0 10px;">
                            <p class="mb-0 text-secondary" style="margin-right: 10;">Phim hiển thị</p>
                            <h4 class="my-1 text-success " style="margin-right: 10;">{{ activeFilms }}<i
                                    class="bx bx-film"></i></h4>
                        </div>
                        <div>
                            <p class="mb-0 text-secondary">Phim ẩn</p>
                            <h4 class="my-1 text-success">{{ inactiveFilms }}<i class="bx bx-film"></i></h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='bx bxs-bar-chart-alt-2'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary" style="margin-right: 10;">Tài khoản kích hoạt</p>
                            <h4 class="my-1 text-warning" style="margin-right: 10;">{{ activeCustomers }}<i
                                    class="bx bx-user"></i></h4>
                        </div>

                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Thống Kê Doanh Thu Tháng {{ month }} </h3>
                        </div>
                    </div>
                    <hr>
                    <Bar v-if="loaded1" :data="chartData1" />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Thống Kê Lượt Xem Tháng {{ month }} </h3>
                        </div>
                    </div>
                    <hr>
                    <Line v-if="loaded" :data="chartData" />
                </div>
            </div>
        </div>
    </div>

</template>
<script>

import baseRequest from '../../../core/baseRequest';
import { Bar } from 'vue-chartjs'
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement)
export default {
    components: { Bar , Line},
    data() {
        return {
            CustomerCountThangs: [],
            topphim: [],
            viewCountThangs: [],
            activeCustomers: 0,
            activeFilms: 0,
            doanhThuCount: 0,
            inactiveCustomers: 0,
            inactiveFilms: 0,
            viewCount: 0,
            loaded: false,
            loaded1: false,
            begin: '',
            end : '',
            month : '',
            year : '',
            chartData: {
                datasets: [
                    {
                        label: 'Lượt Xem',
                        backgroundColor: [
                             "#27AE60"
                        ],
                        data: []
                    }
                ]
            },
            chartData1: {
                datasets: [
                    {
                        label: 'Doanh Thu',
                        backgroundColor: [
                            "#F1C40F"
                        ],
                        data: []
                    },

                ]
            },
            chartOptions: {
                responsive: true
            }

        };
    },

    mounted() {
        this.loaded = false;
        this.loaded1 = false;
        var date        = new Date();
        var subday      = new Date(date.getFullYear(), date.getMonth(), 2);
        this.month      = (date.getMonth() + 1).toString().padStart(2, '0');
        this.year       = date.getFullYear();
        this.begin      = subday.toISOString().slice(0, 10);
        this.end        = new Date().toISOString().slice(0, 10);
        this.loadDataDashbord();
        this.loadDataDoanhThu();
        this.loadDataLuotXem();

    },
    methods: {
        formatNumber(num) {
            if (num >= 1000 && num < 1000000) {
                return (num / 1000).toFixed(1) + 'K';
            } else if (num >= 1000000 && num < 1000000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000000000) {
                return (num / 1000000000).toFixed(1) + 'B';
            } else {
                return num;
            }
        },
        loadDataDashbord() {
            baseRequest
                .get('admin/dashboard')
                .then((res) => {
                    this.viewCountThangs = res.data.viewCountThangs;
                    this.activeCustomers = this.formatNumber(res.data.activeCustomers);
                    this.activeFilms = this.formatNumber(res.data.activeFilms);
                    this.doanhThuCount = this.formatNumber(res.data.doanhThuCount);
                    this.inactiveCustomers = this.formatNumber(res.data.inactiveCustomers);
                    this.inactiveFilms = this.formatNumber(res.data.inactiveFilms);
                    this.viewCount = this.formatNumber(res.data.viewCount);
                });
        },
        loadDataDoanhThu() {
            this.loaded1 = false
            baseRequest
                .get('admin/dashboard/thong-ke-doanh-thu/' + this.begin + '/' + this.end)
                .then((res) => {
                    this.chartData1.labels = res.data.list_lable;
                    this.chartData1.datasets[0].data = res.data.list_data;
                    this.loaded1 = true;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        loadDataLuotXem() {
            this.loaded = false
            baseRequest
                .get('admin/dashboard/thong-ke-luot-xem/' + this.begin + '/' + this.end)
                .then((res) => {
                    this.chartData.labels = res.data.list_lable;
                    this.chartData.datasets[0].data = res.data.list_data;
                    this.loaded = true;
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
    },

};
</script>
<style></style>
