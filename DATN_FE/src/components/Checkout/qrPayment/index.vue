<template>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <main>
                                <div class="row contacts">
                                    <div class="col">
                                        <router-link to="/">
                                            <a href="javascript:;">
                                                <img src="../../../assets/assets_Anime/img/logo.png" width="200"
                                                    alt="" />
                                            </a>
                                        </router-link>
                                    </div>
                                    <div class="col invoice-to">
                                        <div class="text-gray-light fs-5">TỔNG THANH TOÁN: </div>
                                        <h2 class="to text-primary fs-3">{{ number_format(obj_hoa_don.tong_tien) }}</h2>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id text-nowrap">QUÉT MÃ ĐỂ THANH TOÁN</h1>
                                        <div class="date text-gray-light fs-6">Ngày khởi tạo:
                                            {{ new Date().toLocaleDateString('vi-VN') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Spinner hiển thị khi đang tải -->
                                <div v-if="isLoading" class="text-center d-block mt-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>

                                <!-- Mã QR hiển thị khi tải xong -->
                                <div v-else class="text-center d-block mt-3">
                                    <img :src="linkQR" alt="QR THANH TOÁN" class="img-thumbnail"
                                        style="max-width: 320px;">
                                </div>

                                <div class="mt-3 d-flex justify-content-center">
                                    <div class="invoice-to text-center">
                                        <p class="text-muted fs-7 fst-italic">Vui lòng không chỉnh sửa nội dung chuyển
                                            khoản, nếu sai chúng tôi sẽ không thể xác nhận thanh toán của bạn!</p>
                                        <div class="text-gray-light fs-6 mt-3">Bạn đã thanh toán xong ?</div>
                                        <a class="btn btn-primary mt-2" href="#" @click.prevent="checkThanhToan()">Tôi
                                            đã
                                            thanh toán xong</a>
                                    </div>
                                </div>
                            </main>
                            <footer class="text-center text-gray-light fs-6">
                                Hóa đơn được tạo trên máy tính và có giá trị mà không cần chữ ký và con dấu.
                            </footer>
                            <!-- Modal -->
                            <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="loadingModalLabel">Đang xử lý</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="spinner-border text-primary me-2" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            Vui lòng đợi, Hóa đơn của bạn đang được xử lý...
                                        </div>
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
import axios from 'axios';
import baseRequestUser from '../../../core/baseRequestUser';

export default {
    data() {
        return {
            obj_goi_vip: {},
            obj_hoa_don: {},
            obj_user: {},
            linkQR: '',
            isLoading: true, // Trạng thái loading
        }
    },
    mounted() {
        this.$store.dispatch('showLoader');
        this.getQRThanhToan();
    },
    methods: {
        number_format(number) {
            if (number !== null && number !== undefined) {
                return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            }
            return '';
        },
        getQRThanhToan() {
            var payload = {
                id_goi: this.$route.params.id_goi
            };
            baseRequestUser
                .post('khach-hang/check-out/qr-payment', payload)
                .then((res) => {
                    if (res.data.status == true) {
                        this.obj_user = res.data.user;
                        this.obj_hoa_don = res.data.hoaDon;
                        this.linkQR = res.data.link;
                    } else {
                        this.$router.push('/');
                        this.$store.dispatch('showError', { description: res.data.message, });
                        // window.location.href = '/platform/checkout/process/' + this.$route.params.id_goi;
                    }
                })
                .catch((error) => {
                    console.error('Lỗi khi tải dữ liệu QR:', error);
                    this.$store.dispatch('showError', { description: 'Đã xảy ra lỗi khi tải dữ liệu!' });
                    this.$router.push('/');

                })
                .finally(() => {
                    // Kết thúc loading
                    this.isLoading = false;
                });
        },
        async checkThanhToan() {
            var myModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
                keyboard: false,
                backdrop: 'static'
            });
            myModal.show();

            // Thêm setTimeout 10 giây
            await new Promise(resolve => setTimeout(resolve, 10000)); // đợi 10 giây

            try {
                const res = await axios.get(import.meta.env.VITE_API_URL + 'transation');
                if (res.data.status == true) {
                    myModal.hide();
                    this.$router.push('/platform/checkout/success-payment/' + this.obj_hoa_don.tong_tien + '/' + this.obj_hoa_don.ma_giao_dich);
                } else {
                    await axios.post(import.meta.env.VITE_API_URL + 'transation/set-status', this.obj_hoa_don);
                    // this.$store.dispatch('showError', { description: "Đã xảy ra lỗi", });
                    myModal.hide();
                    // this.$router.push('/platform/checkout/error-payment/' + this.$route.params.id_goi);
                    this.$router.push('/platform/checkout/success-payment/' + this.obj_hoa_don.tong_tien + '/' + this.obj_hoa_don.ma_giao_dich);
                }
            } catch (error) {
                // myModal.hide();
                // this.$store.dispatch('showError', { description: 'Đã xảy ra lỗi khi tải dữ liệu!' });
                // this.$router.push('/platform/checkout/error-payment/' + this.$route.params.id_goi);
                await axios.post(import.meta.env.VITE_API_URL + 'transation/set-status', this.obj_hoa_don);
                // this.$store.dispatch('showError', { description: "Đã xảy ra lỗi", });
                myModal.hide();
                // this.$router.push('/platform/checkout/error-payment/' + this.$route.params.id_goi);
                this.$router.push('/platform/checkout/success-payment/' + this.obj_hoa_don.tong_tien + '/' + this.obj_hoa_don.ma_giao_dich);
            }
        },
        // showModal() {
        //     var myModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
        //         keyboard: false,
        //         backdrop: 'static'
        //     });
        //     myModal.show();
        //     setTimeout(function () {

        //         myModal.hide();
        //     }, 10000);
        // },
    },
};
</script>


<style lang="css">
.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.25rem;
}
</style>
