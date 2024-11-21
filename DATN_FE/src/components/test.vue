<script>
import baseRequestUser from '../core/baseRequestUser';

export default {
    data() {
        return {
            status: "loading",
        };
    },
    mounted() {
        this.getQRThanhToan();
    },
    methods: {
        handleRefresh() {
            this.status = "loading";
            setTimeout(() => {
                this.status = "scanned";
            }, 2000);
        },
        getQRThanhToan() {
            var payload = {
                id_goi: this.$route.params.id_goi
            }
            baseRequestUser
                .post('khach-hang/check-out/qr-payment', payload)
                .then((res) => {
                    this.status = "true";

                    // if (res.data.status == true) {
                    //     // this.$store.dispatch('showSuccess', { description: res.data.message, });
                    //     this.obj_user = res.data.user;
                    //     this.obj_hoa_don = res.data.hoaDon;
                    //     this.linkQR = res.data.link;
                    // } else {
                    //     this.$store.dispatch('showError', { description: res.data.message, });
                    //     this.$router.push('/login');
                    // }
                });
        },
    },
};
</script>

<template>
    <a-qrcode value="https://img.vietqr.io/image/mb-0708585120-compact2.jpg?amount=5000&addInfo=HDbf304&accountName=VO_VAN_VIET" :status="status" @refresh="handleRefresh" />
</template>


