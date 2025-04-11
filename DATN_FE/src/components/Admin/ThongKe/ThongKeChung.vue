<template>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng số phim</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ tongPhim }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng lượt xem</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ tongLuotXem }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tổng người dùng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ tongNguoiDung }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Bình luận mới</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ binhLuanMoi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequest from '../../../core/baseRequest'

export default {
    data() {
        return {
            tongPhim: 0,
            tongLuotXem: 0,
            tongNguoiDung: 0,
            binhLuanMoi: 0
        }
    },
    mounted() {
        this.loadThongKeChung()
    },
    methods: {
        loadThongKeChung() {
            baseRequest.get('admin/thong-ke/thong-ke-chung')
                .then((res) => {
                    this.tongPhim = res.data.tong_phim
                    this.tongLuotXem = res.data.tong_luot_xem
                    this.tongNguoiDung = res.data.tong_nguoi_dung
                    this.binhLuanMoi = res.data.binh_luan_moi
                })
        }
    }
}
</script> 