<template>
    <div class="anime-details spad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-white fw-bold">NÂNG CẤP TÀI KHOẢN VIP</h2>
                <p class="text-light mt-3">Trải nghiệm không giới hạn với các đặc quyền dành riêng cho thành viên VIP</p>
            </div>

            <!-- VIP Benefits Section -->
            <div class="row mb-5">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-film fa-2x text-primary"></i>
                        </div>
                        <h5 class="text-white">Xem Không Giới Hạn</h5>
                        <p class="text-light">Truy cập tất cả nội dung độc quyền</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-ban fa-2x text-primary"></i>
                        </div>
                        <h5 class="text-white">Không Quảng Cáo</h5>
                        <p class="text-light">Trải nghiệm xem phim không gián đoạn</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-video fa-2x text-primary"></i>
                        </div>
                        <h5 class="text-white">Chất Lượng Cao</h5>
                        <p class="text-light">Xem phim với chất lượng tốt nhất</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-headset fa-2x text-primary"></i>
                        </div>
                        <h5 class="text-white">Hỗ Trợ 24/7</h5>
                        <p class="text-light">Đội ngũ hỗ trợ luôn sẵn sàng giúp đỡ</p>
                    </div>
                </div>
            </div>

            <!-- VIP Packages Section -->
            <div class="row justify-content-center">
                <template v-for="(value, index) in list_goi_vip" :key="index">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="vip-package-card" 
                            :class="{'featured': value.thoi_han === 12}">
                            <div class="package-header">
                                <span v-if="value.thoi_han === 12" class="featured-badge">
                                    Phổ biến nhất
                                </span>
                                <h3>{{ value.thoi_han }} Tháng</h3>
                                <div class="price-section">
                                    <span class="original-price">{{ convertVND(value.tien_goc) }}</span>
                                    <div class="sale-price">
                                        <span class="sale-label">Giảm giá</span>
                                        <span class="price">{{ convertVND(value.tien_sale) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="package-features">
                                <ul>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ value.thoi_han }} tháng xem không giới hạn</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>Không quảng cáo</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>Chất lượng video cao nhất</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>Hỗ trợ kỹ thuật ưu tiên</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="package-action">
                                <button v-if="is_login" 
                                    @click="redirectToCheckout(value.id)"
                                    class="btn-subscribe">
                                    Đăng ký ngay
                                </button>
                                <button v-else 
                                    @click="showLoginRequired"
                                    class="btn-subscribe">
                                    Đăng ký ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section mt-5">
                <h3 class="text-white text-center mb-4">Câu hỏi thường gặp</h3>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq1">
                                        Làm sao để trở thành thành viên VIP?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Bạn chỉ cần chọn gói VIP phù hợp và thanh toán. Sau khi thanh toán thành công, 
                                        tài khoản của bạn sẽ được nâng cấp ngay lập tức.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2">
                                        Tôi có thể hủy đăng ký VIP không?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Bạn có thể hủy đăng ký bất cứ lúc nào. Tuy nhiên, chúng tôi không hoàn tiền cho 
                                        thời gian còn lại của gói VIP.
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
import baseRequest from '../../../core/baseRequestUser';

export default {
    data() {
        return {
            list_goi_vip: [],
            is_login: false
        }
    },
    mounted() {
        this.loadVipPackages();
        this.checkLoginStatus();
        this.$store.dispatch('showLoader');
    },
    methods: {
        convertVND(money) {
            return money.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
        },
        loadVipPackages() {
            baseRequest.get("lay-data-goi-vip-open")
                .then((res) => {
                    this.list_goi_vip = res.data.data;
                    this.$store.dispatch('hideLoader');
                })
                .catch((error) => {
                    console.error('Error loading VIP packages:', error);
                    this.$store.dispatch('showError', { 
                        description: 'Không thể tải thông tin gói VIP' 
                    });
                    this.$store.dispatch('hideLoader');
                });
        },
        checkLoginStatus() {
            baseRequest.post('khach-hang/check')
                .then((res) => {
                    if (res.status === 200) {
                        this.is_login = true;
                    }
                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        showLoginRequired() {
            this.$store.dispatch('showError', { 
                description: 'Vui lòng đăng nhập để sử dụng chức năng này'
            });
        },
        redirectToCheckout(id) {
            // Implement the logic to redirect to checkout page
            window.location.href = `/platform/checkout/process/${id}`;
        }
    }
}
</script>

<style scoped>
.anime-details {
    padding-top: 60px;
}

.section-title {
    margin-bottom: 30px;
}

.section-title h4 {
    color: #ffffff;
    font-weight: 700;
    line-height: 1;
    text-transform: uppercase;
    padding-left: 20px;
    position: relative;
    font-family: "Oswald", sans-serif;
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

.feature-item {
    transition: all 0.3s;
}

.feature-item:hover {
    transform: translateX(5px);
}

.benefit-item {
    background: rgba(255, 255, 255, 0.05);
    padding: 25px;
    border-radius: 10px;
    transition: transform 0.3s;
}

.benefit-item:hover {
    transform: translateY(-5px);
}

.benefit-icon {
    height: 60px;
    width: 60px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.vip-package-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 30px;
    height: 100%;
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
}

.vip-package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.featured {
    border: 2px solid #007bff;
}

.featured-badge {
    position: absolute;
    top: 20px;
    right: -35px;
    background: #007bff;
    color: white;
    padding: 8px 40px;
    transform: rotate(45deg);
    font-size: 14px;
}

.package-header {
    text-align: center;
    margin-bottom: 30px;
}

.package-header h3 {
    color: white;
    font-size: 24px;
    margin-bottom: 20px;
}

.price-section {
    margin-bottom: 20px;
}

.original-price {
    display: block;
    color: #888;
    text-decoration: line-through;
    font-size: 18px;
    margin-bottom: 10px;
}

.sale-price {
    color: #007bff;
    font-size: 28px;
    font-weight: bold;
}

.sale-label {
    display: block;
    color: #e53637;
    font-size: 16px;
    margin-bottom: 5px;
}

.package-features ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.package-features li {
    color: #fff;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.package-features i {
    color: #28a745;
    margin-right: 10px;
}

.btn-subscribe {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 8px;
    background: #007bff;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 20px;
}

.btn-subscribe:hover {
    background: #0056b3;
}

.accordion-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 10px;
}

.accordion-button {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.accordion-button:not(.collapsed) {
    background: #007bff;
    color: white;
}

.accordion-body {
    color: #fff;
    background: rgba(255, 255, 255, 0.05);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .benefit-item {
        margin-bottom: 20px;
    }

    .vip-package-card {
        margin-bottom: 30px;
    }

    .featured-badge {
        font-size: 12px;
        padding: 6px 30px;
    }

    .package-header h3 {
        font-size: 20px;
    }

    .sale-price {
        font-size: 24px;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 0 15px;
        margin-top: 100px;
    }

    .benefit-icon {
        height: 50px;
        width: 50px;
    }

    .vip-package-card {
        padding: 20px;
    }

    .package-features li {
        font-size: 14px;
    }
}
</style>
