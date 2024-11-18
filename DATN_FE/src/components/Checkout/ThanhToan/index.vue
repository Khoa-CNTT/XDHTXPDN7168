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
                                        <h2 class="name">
                                            <a target="_blank" href="javascript:;">WOPAI</a>
                                        </h2>
                                        <div>Đà Nẵng, Việt Nam</div>
                                        <div>(120) 769-2436</div>
                                        <div>wopai11@gmail.com </div>
                                    </div>
                                </div>
                            </header>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">HÓA ĐƠN TỚI:</div>
                                    <h2 class="from">NETCLUB</h2>
                                    <h2 class="to">Văn Việt</h2>
                                    <!-- <div class="email"><a href="mailto:{{ $user->email }}">{{ $user -> email }}</a> -->
                                    <div class="email"><a>vietvo371@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">HÓA ĐƠN</h1>
                                <div class="date">Ngày khởi tạo: {{ $today }}</div>
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
                                    <!-- <td class="text-left">
                                                <h3>{{ $goi -> ten_goi }}</h3>
                                                Bạn có thể tận hưởng phim trong {{ $goi -> thoi_han }} tháng
                                            </td>
                                            <td class="unit">{{ number_format($goi -> tien_sale > 0 ? $goi -> tien_sale :
                                                $goi->tien_goc) }} VNĐ</td>
                                            <td class="qty">{{ $goi -> thoi_han }}</td>
                                            <td class="total">{{ number_format($goi -> tien_sale > 0 ? $goi -> tien_sale :
                                                $goi->tien_goc) }} VNĐ</td> -->
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">TAX 25%</td>
                                    <td>1,300.00 VNĐ</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="1">TỔNG THANH TOÁN</td>
                                    <!-- <td>{{ number_format($goi -> tien_sale > 0 ? $goi -> tien_sale : $goi -> tien_goc)
                                                }} VNĐ</td> -->
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <a class="btn btn-primary"
                                            href="{{ route('platform.checkout.qrPayment', ['id_goi' => $goi->id]) }}">THANH
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
export default {};
</script>

<style lang="css">
/* CSS styles nếu cần */
</style>
