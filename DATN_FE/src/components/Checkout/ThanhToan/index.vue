<template>
    <div class="container">
        <!-- Start page wrapper -->
        <div class="card mt-3">
            <div class="card-body">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <!-- Breadcrumb hiện không cần -->
                    </div>
                </div>
                <div id="invoice">
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <img src="../../../assets/assets_Anime/img/logo.png" width="200" alt="" />
                                        </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name text-primary"
                                            style="font-family: 'Arial', sans-serif; color: red; font-weight: bold;">
                                            <a target="_blank" href="/" style="text-decoration: none; ">WOPAI</a>
                                        </h2>
                                        <div>Đà Nẵng, Việt Nam</div>
                                        <div>(120) 769-2436</div>
                                        <div><a href="mailto:vietdev2106@gmail.com">vietdev2106@gmail.com</a></div>
                                    </div>
                                </div>
                            </header>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">HÓA ĐƠN TỚI:</div>
                                    <h2 class="to">{{ obj_user.ho_va_ten }}</h2>
                                    <div class="email"><a :href="`mailto:${obj_user.email}`">{{ obj_user.email }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">HÓA ĐƠN</h1>
                                <div class="date">Ngày khởi tạo: {{ new Date().toLocaleDateString('vi-VN') }}</div>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-left">TÊN GÓI</th>
                                    <th class="text-right">GIÁ</th>
                                    <th class="text-right">SỐ THÁNG</th>
                                    <th class="text-right">TỔNG CỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left text-wrap">
                                        <h4 class="text-primary ">{{ obj_goi_vip.ten_goi }}</h4>
                                        Bạn có thể tận hưởng xem phim trong {{ obj_goi_vip.thoi_han }} tháng và không lo
                                        quảng cáo làm phiền
                                    </td>
                                    <td class="unit">{{ number_format(obj_goi_vip.tien_sale > 0 ? obj_goi_vip.tien_sale
                                        : obj_goi_vip.tien_goc) }}
                                    </td>
                                    <td class="qty">{{ obj_goi_vip.thoi_han }}</td>
                                    <td class="total">{{ number_format(obj_goi_vip.tien_sale > 0 ? obj_goi_vip.tien_sale
                                        : obj_goi_vip.tien_goc) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr style="background-color: #f5f5f5;">
                                    <td colspan="2"></td>
                                    <td colspan="1" style="font-weight: bold;">TỔNG THANH TOÁN</td>
                                    <td style="font-weight: bold;">{{ number_format(obj_goi_vip.tien_sale > 0 ?
                                        obj_goi_vip.tien_sale
                                        : obj_goi_vip.tien_goc) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a v-if="check == false" class="btn btn-primary"
                                            :href="`/platform/checkout/qrPayment/${obj_goi_vip.id}`">THANH
                                            TOÁN</a>
                                        <a v-else class="btn btn-primary" @click="messageEror()">THANH
                                            TOÁN</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">CẢM ƠN BẠN!</div>
                        <footer>
                            Hóa đơn được tạo trên máy tính và có giá trị mà không cần chữ ký và con dấu.
                        </footer>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequestUser from '../../../core/baseRequestUser';

export default {
    data() {
        return {
            obj_goi_vip: {},
            obj_hoa_don: {},
            obj_user: {},
            linkQR: '',
            check: false
        }
    },
    mounted() {
        this.getProcess();
        this.$store.dispatch('showLoader');

    },
    methods: {
        number_format(number) {
            if (number !== null && number !== undefined) {
                return number.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
            }
            return '';
        },
        getProcess() {
            var payload = {
                id_goi: this.$route.params.id_goi
            }
            baseRequestUser
                .post('khach-hang/check-out/process', payload)
                .then((res) => {
                    if (res.data.status == true) {
                        // this.$store.dispatch('showSuccess', { description: res.data.message, });
                        this.obj_user = res.data.user;
                        this.obj_goi_vip = res.data.goi;
                        this.check = res.data.check;
                        this.$store.dispatch('hideLoader');
                    } else {
                        this.$store.dispatch('showError', { description: res.data.message, });
                        this.$router.push('/login');
                    }
                });
        },
        messageEror() {
            this.$store.dispatch('showError', { description: 'Bạn đã có gói VIP đang hoạt động. Vui lòng chờ đến khi hết hạn để đăng ký gói mới!' });
        },
    }
};
</script>

<style lang="css">
/* CSS styles nếu cần */
</style>
