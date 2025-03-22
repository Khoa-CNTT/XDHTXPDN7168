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
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">HÓA ĐƠN</h1>
                                    <div class="date">Ngày khởi tạo: {{ new Date().toLocaleDateString('vi-VN') }}</div>
                                </div>
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
                            </tfoot>
                        </table>
                        <div class="payment-methods mt-4">
                            <h3 class="mb-4">Chọn Phương Thức Thanh Toán</h3>
                            
                            <div class="payment-methods-grid">
                                <!-- Chuyển khoản ngân hàng -->
                                <div class="payment-method" 
                                     :class="{ 'active': selectedMethod === 'bank' }" 
                                     @click="selectMethod('bank')">
                                    <div class="method-header">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div class="method-body">
                                        <h4>Chuyển khoản ngân hàng</h4>
                                        <p>Chuyển khoản qua tài khoản ngân hàng</p>
                                    </div>
                                    <div class="method-check">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>

                                <!-- MoMo -->
                                <div class="payment-method"
                                     :class="{ 'active': selectedMethod === 'momo' }"
                                     @click="selectMethod('momo')">
                                    <div class="method-header">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div class="method-body">
                                        <h4>Ví MoMo</h4>
                                        <p>Thanh toán qua ví điện tử MoMo</p>
                                    </div>
                                    <div class="method-check">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>

                                <!-- VNPAY -->
                                <div class="payment-method"
                                     :class="{ 'active': selectedMethod === 'vnpay' }"
                                     @click="selectMethod('vnpay')">
                                    <div class="method-header">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="method-body">
                                        <h4>VNPAY</h4>
                                        <p>Thanh toán qua cổng VNPAY</p>
                                    </div>
                                    <div class="method-check">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-actions text-center mt-4">
                                <button v-if="!check" 
                                        class="btn-payment" 
                                        :disabled="!selectedMethod"
                                        @click="processPayment">
                                    {{ selectedMethod ? 'TIẾP TỤC THANH TOÁN' : 'CHỌN PHƯƠNG THỨC THANH TOÁN' }}
                                </button>
                                <button v-else 
                                        class="btn-payment disabled" 
                                        @click="messageEror">
                                    THANH TOÁN
                                </button>
                            </div>
                        </div>
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
            check: false,
            selectedMethod: ''
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
        selectMethod(method) {
            this.selectedMethod = method;
        },
        async processPayment() {
            try {
                if (this.selectedMethod === 'bank') {
                    this.$router.push(`/platform/checkout/qrPayment/${this.obj_goi_vip.id}`);
                    return;
                }

                if (this.selectedMethod === 'momo') {
                   baseRequestUser.post(`khach-hang/thanh-toan/momo/create`, {
                    id_goi: this.obj_goi_vip.id
                   })
                    .then((res) => {
                        if(res.data.status == true) {
                            window.location.href = res.data.payUrl;   
                        } else {
                            this.$store.dispatch('showError', { description: res.data.message });
                            this.$router.push('/platform/checkout/error-payment/' + this.obj_goi_vip.id);
                        }
                    })
                    return;
                }

                if (this.selectedMethod === 'vnpay') {
                    baseRequestUser.post(`khach-hang/thanh-toan/vnpay/create`, {
                    id_goi: this.obj_goi_vip.id
                   })
                    .then((res) => {
                        if(res.data.status == true) {
                            window.location.href = res.data.payUrl;   
                        } else {
                            this.$store.dispatch('showError', { description: res.data.message });
                            this.$router.push('/platform/checkout/error-payment/' + this.obj_goi_vip.id);
                        }
                    })
                    return;
                }
            } catch (error) {
                this.$store.dispatch('showError', { 
                    description: 'Có lỗi xảy ra khi xử lý thanh toán' 
                });
            }
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
                        this.$store.dispatch('showError', { description: 'Chức năng yêu cầu đăngn nhập'});
                        this.$router.push('/');
                    }
                });
        },
        messageEror() {
            this.$store.dispatch('showError', { description: 'Bạn đã có gói VIP đang hoạt động. Vui lòng chờ đến khi hết hạn để đăng ký gói mới!' });
            setTimeout(() => {
                window.location.href = '/';
            }, 2000);
        },
    }
};
</script>

<style lang="css">
.payment-methods {
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.payment-methods h3 {
    color: #333;
    font-size: 1.5rem;
    margin-bottom: 30px;
    text-align: center;
}

.payment-methods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.payment-method {
    position: relative;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.payment-method:hover {
    transform: translateY(-2px);
    border-color: #e53637;
}

.payment-method.active {
    background: #fff;
    border-color: #e53637;
    box-shadow: 0 4px 15px rgba(229, 54, 55, 0.1);
}

.method-header {
    margin-bottom: 15px;
}

.method-header i {
    font-size: 32px;
    color: #e53637;
    background: rgba(229, 54, 55, 0.1);
    padding: 20px;
    border-radius: 50%;
}

.method-body h4 {
    color: #333;
    font-size: 18px;
    margin-bottom: 8px;
}

.method-body p {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

.method-check {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.method-check i {
    color: #e53637;
    font-size: 20px;
}

.payment-method.active .method-check {
    opacity: 1;
}

.btn-payment {
    background: #e53637;
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-payment:hover {
    background: #d32f2f;
    transform: translateY(-1px);
}

.btn-payment:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
}

/* Responsive styles */
@media (max-width: 768px) {
    .payment-methods {
        padding: 15px;
    }

    .payment-methods-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .payment-method {
        padding: 15px;
    }

    .method-header i {
        font-size: 24px;
        padding: 15px;
    }

    .method-body h4 {
        font-size: 16px;
    }

    .btn-payment {
        width: 100%;
        padding: 12px 20px;
        font-size: 14px;
    }
}
</style>
