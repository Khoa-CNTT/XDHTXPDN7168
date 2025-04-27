<template>
    <div class="payment-success">
        <div class="success-container">
            <div class="icon-container">
                <i class="fas fa-check-circle success-icon" style="color: #28a745;"></i>
            </div>
            <h2 class="title">THANH TOÁN THÀNH CÔNG</h2>
            <p class="message">Cảm ơn bạn đã hoàn tất thanh toán. Gói dịch vụ của bạn đã được kích hoạt thành công.</p>

            <div class="details">
                <p><strong>Số tiền:</strong> {{  formatCurrency(money) }} đ</p>
                <p><strong>Mã giao dịch:</strong> {{ ma_giao_dich == "undefined" ? "HD241512" : ma_giao_dich }}</p>
                <p>
                    <strong>Ngân hàng:</strong> Ngân hàng MB
                </p>
                <p><strong>Phương thức:</strong> Thanh toán trực tuyến </p>
                <p><strong>Thời gian:</strong> {{ formattedDate }}</p>
            </div>

            <div class="info-section">
                <p>Chúng tôi đã gửi thông tin chi tiết đến email của bạn</p>
                <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ:</p>
                <p>Email: <a href="mailto:vietdev2106@gmail.com">vietdev2106@gmail.com</a></p>
                <p>SĐT: 0905.123.456</p>
            </div>

            <div class="action-buttons">
                <router-link :to="'/'" class="btn btn-primary">
                    Trở về trang chủ
                </router-link>
                <router-link :to="'/profile'" class="btn btn-outline">
                    Xem tài khoản
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import baseRequestUser from '../../../core/baseRequestUser';

export default {
    name: "ThanhToanThanhCong",
    data() {
        return {
            money: this.$route.params.money,
            ma_giao_dich: this.$route.params.ma_giao_dich,
            transactionTime: new Date()
        };
    },
    computed: {

        formattedDate() {
            return this.transactionTime.toLocaleString('vi-VN', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }
    },
    mounted() {
    },
    methods: {
        formatCurrency(amount) {
            return amount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
    }
};
</script>

<style lang="css">
.payment-success {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f5f9fc;
    font-family: Arial, sans-serif;
    padding: 20px;
}

.success-container {
    text-align: center;
    padding: 40px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 90%;
}

.icon-container {
    margin-bottom: 25px;
}

.success-icon {
    font-size: 80px;
    color: #28a745;
}

.title {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
}

.message {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}

.details {
    margin: 25px 0;
    text-align: left;
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #28a745;
}

.details p {
    font-size: 16px;
    margin: 10px 0;
    color: #333;
}

.info-section {
    margin: 20px 0;
    font-size: 14px;
    color: #777;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-outline {
    background-color: transparent;
    color: #007bff;
    border: 1px solid #007bff;
}

.btn-outline:hover {
    background-color: #f0f7ff;
}

@media (max-width: 768px) {
    .success-container {
        padding: 30px 20px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }

    .title {
        font-size: 24px;
    }

    .success-icon {
        font-size: 60px;
    }
}
</style>