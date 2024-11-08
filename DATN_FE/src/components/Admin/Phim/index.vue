<template>
    <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Phim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Tên Phim</b>
                                </label>
                                <input v-model="obj_add_phim.ten_phim" @keyup="addSlug()" @change="kiemTraSlug()"
                                    type="text" class="form-control" placeholder="Nhập tên phim..." />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Mô Tả</b>
                                </label>
                                <input v-model="obj_add_phim.mo_ta" type="text" class="form-control"
                                    placeholder="Nhập mô tả..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Slug Phim</b>
                                </label>
                                <input v-model="obj_add_phim.slug_phim" type="text" disabled class="form-control"
                                    placeholder="slug phim..." />
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Loại Phim</b>
                                </label>
                                <select v-model="obj_add_phim.id_loai_phim" name="" id="" class="form-control">
                                    <template v-for="(v, k) in list_loai_phim" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_loai_phim }}</option>
                                    </template>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="form-label mb-1 mt-1">
                                    <b>Đạo diễn</b>
                                </label>
                                <input v-model="obj_add_phim.dao_dien" type="text" class="form-control"
                                    placeholder="Nhập tên đạo diễn..">
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Tình Trạng</b>
                                        </label>
                                        <select v-model="obj_add_phim.tinh_trang" class="form-control mb-3">
                                            <option value="0">Tạm Dừng</option>
                                            <option value="1">Hiển Thị</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Số Tập</b>
                                        </label>
                                        <input v-model="obj_add_phim.so_tap_phim" class="form-control" type="number"
                                            placeholder="VD: 12..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Thời lượng (phút)</b>
                                        </label>
                                        <input v-model="obj_add_phim.thoi_gian_chieu" class="form-control" type="number"
                                            placeholder="VD: 120...">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Năm sản xuất</b>
                                        </label>
                                        <input v-model="obj_add_phim.nam_san_xuat" class="form-control" type="number"
                                            placeholder="VD: 2024...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1"><b>Quốc gia</b></label>
                                        <select v-model="obj_add_phim.quoc_gia" class="form-control">
                                            <option value="Ấn Độ">Ấn Độ</option>
                                            <option value="Anh">Anh</option>
                                            <option value="Âu Mỹ">Âu Mỹ</option>
                                            <option value="Đài Loan">Đài Loan</option>
                                            <option value="Đức">Đức</option>
                                            <option value="Hàn Quốc">Hàn Quốc</option>
                                            <option value="Hồng Kông">Hồng Kông</option>
                                            <option value="Nhật Bản">Nhật Bản</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Thái Lan">Thái Lan</option>
                                            <option value="Thổ Nhĩ Kỳ">Thổ Nhĩ Kỳ</option>
                                            <option value="Trung Quốc">Trung Quốc</option>
                                            <option value="Việt Nam">Việt Nam</option>
                                            <option value="Áo">Áo</option>
                                            <option value="Ý">Ý</option>
                                            <option value="Pháp">Pháp</option>
                                            <option value="Tây Ban Nha">Tây Ban Nha</option>
                                            <option value="Bồ Đào Nha">Bồ Đào Nha</option>
                                            <option value="Nga">Nga</option>
                                            <option value="Úc">Úc</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Cộng hòa Séc">Cộng hòa Séc</option>
                                            <option value="Ba Lan">Ba Lan</option>
                                            <option value="Hà Lan">Hà Lan</option>
                                            <option value="Thụy Điển">Thụy Điển</option>
                                            <option value="Thụy Sĩ">Thụy Sĩ</option>
                                            <option value="Bỉ">Bỉ</option>
                                            <option value="Áo">Áo</option>
                                            <option value="Ý">Ý</option>
                                            <option value="Hy Lạp">Hy Lạp</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="New Zealand">New Zealand</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label mb-1 mt-1">
                                            <b>Công ty sản xuất</b>
                                        </label>
                                        <input v-model="obj_add_phim.cong_ty_san_xuat" class="form-control" type="text"
                                            placeholder="VD: Tên công ty..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label mb-1 mt-1">
                                    <b>Hình Ảnh</b>
                                </label>
                                <input type="file" @change="handleFile($event, true)" class="form-control" />
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1 mt-1">
                                    <b>Thể Loại</b>
                                </label>
                                <select v-model="choice" class="form-control" v-on:change="addDanhMuc()">
                                    <template v-for="(v, k) in list_the_loai" :key="k">
                                        <option v-bind:value="v.id">{{ v.ten_the_loai }}</option>
                                    </template>
                                </select>
                                <hr>
                                <template v-for="(value, index) in list_the_loai" :key="index">
                                    <div class="chip" v-if="list_chon.includes(value.id)"> {{ value.ten_the_loai }}
                                        <span class="closebtn" v-on:click="removeDanhMuc(list_chon.indexOf(value.id))"
                                            onclick="this.parentElement.style.display='none'">×</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Thoát
                    </button>
                    <button v-if="is_create == 0" disabled class="btn btn-danger">Thêm Mới</button>
                    <button v-else v-on:click="taoDataPhim()" class="btn btn-primary" data-bs-dismiss="modal">Thêm
                        Mới</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-12">
            <div class="card border-5 border-primary border-top">
                <div class="card-header d-flex justify-content-between">
                    <h5><b>DANH SÁCH PHIM</b></h5>
                    <div></div>
                    <button class="btn btn-outline-primary px-4 py-0" data-bs-toggle="modal"
                        data-bs-target="#themMoiModal">
                        <b>Thêm Mới</b>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3">
                                            <input v-on:keyup.enter="searchPhim(1)" v-model="key_tim.key" type="text"
                                                class="form-control" placeholder="Nhập thông tin cần tìm" />
                                            <button class="btn btn-primary" v-on:click="searchPhim(1)">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-left">Tên phim</th>
                                    <th class="text-center align-middle text-nowrap">Hình ảnh</th>
                                    <th class="text-center align-middle text-nowrap">Loai phim</th>
                                    <th class="text-center align-middle text-nowrap">Số tập</th>
                                    <th class="text-center align-middle text-nowrap">Thể loại</th>
                                    <th class="text-center align-middle text-nowrap">Tình trạng</th>
                                    <th class="text-center align-middle text-nowrap">Xem chi tiết</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_phim" :key="k">
                                    <td class="text-center align-middle text-nowrap">
                                        {{ k + 1 }}
                                    </td>
                                    <td class="align-middle text-wrap">{{ tenLimited(v.ten_phim) }}</td>
                                    <td>
                                        <img v-bind:src="v.hinh_anh" class="product-img-2 ms-3" alt="product img">
                                    </td>
                                    <td class="align-middle text-wrap text-center ">{{ v.ten_loai_phim }} </td>
                                    <td class="align-middle text-wrap text-center">{{ v.so_tap_phim }}</td>
                                    <td class="align-middle text-wrap text-primary">{{ theloaisLimited(v.the_loais) }}
                                    </td>
                                    <td class="text-center align-middle text-nowrap text-center">
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Hoạt Động
                                        </button>
                                        <button @click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                            class="badge rounded-pill text-warning bg-light-success p-2 text-uppercase px-3"
                                            style="border: none;">
                                            Tạm Dừng
                                        </button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <button @click="Object.assign(obj_chi_tiet, v)" type="button"
                                            data-bs-toggle="modal" data-bs-target="#ChiTiet"
                                            class="btn btn-primary btn-sm radius-30 px-4">Xem chi
                                            tiết</button>
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <i @click="Object.assign(obj_update_phim, v); list_chon_update = v.idS;"
                                            type="button" data-bs-toggle="modal" data-bs-target="#Chinhsua"
                                            class="fa-solid fa-pen-to-square fa-2x text-warning me-2"></i>

                                        <i @click="Object.assign(obj_delete_phim, v)" data-bs-target="#Xoa"
                                            type="button" data-bs-toggle="modal"
                                            class="fa-solid fa-trash fa-2x text-danger"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" class="mb-0 text-headings">
                            <div class="card-footer text-end text-nowrap">
                                <button @click="changPage(pagination.current_page - 1)"
                                    :disabled="pagination.current_page <= 1" class="btn btn-secondary btn-sm me-2">
                                    Previous
                                </button>
                                <button class="btn btn-secondary btn-sm me-2" v-for="page in pageNumbers" :key="page"
                                    @click="page !== '...' && changPage(page)"
                                    :class="{ active: page === pagination.current_page }">
                                    {{ page }}
                                </button>
                                <button @click="changPage(pagination.current_page + 1)"
                                    :disabled="pagination.current_page >= pagination.last_page"
                                    class="btn btn-secondary btn-sm me-2">
                                    Next
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="modal fade" id="ChiTiet" tabindex="-1" aria-labelledby="ChiTietLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ChiTietLabel">Chi Tiết Phim</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Hình ảnh</th>
                                                <td>
                                                    <img v-bind:src="obj_chi_tiet.hinh_anh" class="img" alt="..."
                                                        style="max-height: 200px; max-width: 100px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Tên phim</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.ten_phim }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Thời lượng</th>
                                                <td colspan="6">{{ obj_chi_tiet.thoi_gian_chieu }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Năm sản xuất</th>
                                                <td colspan="6">{{ obj_chi_tiet.nam_san_xuat }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Số lượng tập</th>
                                                <td colspan="6">{{ obj_chi_tiet.so_tap_phim }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Loại phim</th>
                                                <td colspan="6">{{ obj_chi_tiet.ten_loai_phim }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Mô tả</th>
                                                <td colspan="6" class="text-wrap">{{ obj_chi_tiet.mo_ta }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Đạo diễn</th>
                                                <td colspan="6">{{ obj_chi_tiet.dao_dien != '' ? obj_chi_tiet.dao_dien :
                                                    'Đang cập nhật' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Quốc gia</th>
                                                <td colspan="6">{{ obj_chi_tiet.quoc_gia }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Thể loại</th>
                                                <td colspan="6">
                                                    <template v-for="(v, k) in obj_chi_tiet.the_loais" :key="k">
                                                        {{ v.ten_the_loai }},
                                                    </template>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Công ty sản xuất</th>
                                                <td colspan="6">{{ obj_chi_tiet.cong_ty_san_xuat }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-nowrap" scope="row">Trạng thái</th>
                                                <td colspan="6">
                                                    <a class="text">{{ obj_chi_tiet.tinh_trang == 1 ? 'Hoạt động' : 'Tạm tắt' }} </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Chinhsua" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        CHỈNH SỬA PHIM
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Tên Phim</b>
                                                </label>
                                                <input v-model="obj_update_phim.ten_phim" @keyup="addSlugUpdate()"
                                                    @change="kiemTraSlugUpdate()" type="text" class="form-control"
                                                    placeholder="Nhập tên phim..." />
                                            </div>
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Mô Tả</b>
                                                </label>
                                                <input v-model="obj_update_phim.mo_ta" type="text" class="form-control"
                                                    placeholder="Nhập mô tả..." />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Slug Phim</b>
                                                </label>
                                                <input v-model="obj_update_phim.slug_phim" type="text" disabled
                                                    class="form-control" placeholder="slug phim..." />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Loại Phim</b>
                                                </label>
                                                <select v-model="obj_update_phim.id_loai_phim" name="" id=""
                                                    class="form-control">
                                                    <template v-for="(v, k) in list_loai_phim" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_loai_phim }}</option>
                                                    </template>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Đạo diễn</b>
                                                </label>
                                                <input v-model="obj_update_phim.dao_dien" type="text"
                                                    class="form-control" placeholder="Nhập tên đạo diễn..">
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Tình Trạng</b>
                                                        </label>
                                                        <select v-model="obj_update_phim.tinh_trang"
                                                            class="form-control mb-3">
                                                            <option value="0">Tạm Dừng</option>
                                                            <option value="1">Hiển Thị</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Số Tập</b>
                                                        </label>
                                                        <input v-model="obj_update_phim.so_tap_phim"
                                                            class="form-control" type="number"
                                                            placeholder="VD: 12..." />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Thời lượng (phút)</b>
                                                        </label>
                                                        <input v-model="obj_update_phim.thoi_gian_chieu"
                                                            class="form-control" type="number" placeholder="VD: 120...">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Năm sản xuất</b>
                                                        </label>
                                                        <input v-model="obj_update_phim.nam_san_xuat"
                                                            class="form-control" type="number"
                                                            placeholder="VD: 2024...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1"><b>Quốc gia</b></label>
                                                        <select v-model="obj_update_phim.quoc_gia" class="form-control">
                                                            <option value="Ấn Độ">Ấn Độ</option>
                                                            <option value="Anh">Anh</option>
                                                            <option value="Âu Mỹ">Âu Mỹ</option>
                                                            <option value="Đài Loan">Đài Loan</option>
                                                            <option value="Đức">Đức</option>
                                                            <option value="Hàn Quốc">Hàn Quốc</option>
                                                            <option value="Hồng Kông">Hồng Kông</option>
                                                            <option value="Nhật Bản">Nhật Bản</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Thái Lan">Thái Lan</option>
                                                            <option value="Thổ Nhĩ Kỳ">Thổ Nhĩ Kỳ</option>
                                                            <option value="Trung Quốc">Trung Quốc</option>
                                                            <option value="Việt Nam">Việt Nam</option>
                                                            <option value="Áo">Áo</option>
                                                            <option value="Ý">Ý</option>
                                                            <option value="Pháp">Pháp</option>
                                                            <option value="Tây Ban Nha">Tây Ban Nha</option>
                                                            <option value="Bồ Đào Nha">Bồ Đào Nha</option>
                                                            <option value="Nga">Nga</option>
                                                            <option value="Úc">Úc</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Cộng hòa Séc">Cộng hòa Séc</option>
                                                            <option value="Ba Lan">Ba Lan</option>
                                                            <option value="Hà Lan">Hà Lan</option>
                                                            <option value="Thụy Điển">Thụy Điển</option>
                                                            <option value="Thụy Sĩ">Thụy Sĩ</option>
                                                            <option value="Bỉ">Bỉ</option>
                                                            <option value="Áo">Áo</option>
                                                            <option value="Ý">Ý</option>
                                                            <option value="Hy Lạp">Hy Lạp</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label mb-1 mt-1">
                                                            <b>Công ty sản xuất</b>
                                                        </label>
                                                        <input v-model="obj_update_phim.cong_ty_san_xuat"
                                                            class="form-control" type="text"
                                                            placeholder="VD: Tên công ty..." />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label mb-1 mt-1">
                                                    <b>Hình Ảnh</b>
                                                </label>
                                                <input type="file" @change="handleFile($event, false)"
                                                    class="form-control" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label mb-1 mt-1">
                                                    <b>Thể Loại</b>
                                                </label>
                                                <select v-model="choice" class="form-control"
                                                    v-on:change="addDanhMucUpdate()">
                                                    <template v-for="(v, k) in list_the_loai" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_the_loai }}</option>
                                                    </template>
                                                </select>
                                                <hr>
                                                <template v-for="(value, index) in list_the_loai" :key="index">
                                                    <div class="chip" v-if="list_chon_update.includes(value.id)"> {{
                                                        value.ten_the_loai }}
                                                        <span class="closebtn"
                                                            v-on:click="removeDanhMucUpdate(list_chon_update.indexOf(value.id))"
                                                            onclick="this.parentElement.style.display='none'">×</span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button v-if="is_update == 0" disabled class="btn btn-danger">Lưu</button>
                                    <button v-else v-on:click="updatePhim()" class="btn btn-primary"
                                        data-bs-dismiss="modal">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- {{-- // modol xoa --}} -->
                    <div class="modal fade" id="Xoa" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Xoá Phim
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn có muốn xoá Phim <b>{{ obj_delete_phim.ten_phim }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                        Đóng
                                    </button>
                                    <button @click="deletePhim()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">
                                        Vẫn Xoá
                                    </button>
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
import axios from "axios";
import baseRequest from "../../../core/baseRequest";
import functionBasic from "../../../core/functionBasic";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    position: "top-right",
});
export default {
    data() {
        return {
            is_create: 0,
            is_update: 1,
            choice: 0,
            list_chon: [],
            list_chon_update: [],
            list_loai_phim: [],
            obj_chi_tiet: {},
            list_the_loai: [],
            list_tac_gia: [],
            list_phim: [],
            obj_add_phim: {},
            key_tim: {},
            obj_update_phim: {},
            obj_delete_phim: {},
            pagination: {
                last_page: "",
                per_page: "",
                current_page: "",
                last_page: "",
                from: "",
                to: "",
            },
            check_page: 0,
            maxChars: 20
        };
    },
    computed: {

        pageNumbers() {
            let pages = [];
            for (let i = 1; i <= this.pagination.last_page; i++) {
                pages.push(i);
            }
            return pages;
        },

        // Tính toán các số trang để hiển thị
        pageNumbers() {
            let pages = [];
            if (this.pagination.last_page <= 3) {
                // Nếu tổng số trang <= 3, hiển thị tất cả các trang
                for (let i = 1; i <= this.pagination.last_page; i++) {
                    pages.push(i);
                }
            } else {
                if (this.pagination.current_page <= 3) {
                    // Người dùng đang ở ba trang đầu
                    let maxPage = Math.min(3, this.pagination.last_page); // Đảm bảo không vượt quá tổng số trang
                    for (let i = 1; i <= maxPage; i++) {
                        pages.push(i);
                    }
                    if (this.pagination.last_page > 3) {
                        pages.push("...");
                        pages.push(this.pagination.last_page);
                    }
                } else if (
                    this.pagination.current_page >=
                    this.pagination.last_page - 2
                ) {
                    // Người dùng đang ở ba trang cuối
                    pages.push(1);
                    if (this.pagination.last_page > 3) {
                        pages.push("...");
                    }
                    let minPage = Math.max(this.pagination.last_page - 3, 1); // Đảm bảo không nhỏ hơn trang đầu tiên
                    for (let i = minPage; i <= this.pagination.last_page; i++) {
                        pages.push(i);
                    }
                } else {
                    // Người dùng đang ở các trang giữa
                    pages.push(1);
                    pages.push("...");
                    for (
                        let i = this.pagination.current_page - 1;
                        i <= this.pagination.current_page + 1;
                        i++
                    ) {
                        pages.push(i);
                    }
                    pages.push("...");
                    pages.push(this.pagination.last_page);
                }
            }
            return pages;
        },
    },
    mounted() {
        this.laydataPhim(1);
    },
    methods: {
        updateDetails(v) {
            Object.assign(this.obj_update_phim, v);
            this.list_chon_update = v.idS;
        },
        handleFile(e, isCreate) {
            let files = e.target.files || e.dataTransfer.files;
            this.file = files;
            if (!files.length) return;
            // File type validation
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp'];
            if (!validImageTypes.includes(files[0].type)) {
                alert('Vui lòng chọn đúng file hình ảnh');
                return;
            }
            else {
                this.createImage(files[0], isCreate);
            }
        },
        createImage(file, isCreate) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                // vm.banner = e.target.result;
                if (isCreate == true) {
                    vm.obj_add_phim.hinh_anh = file;
                } else {
                    vm.obj_update_phim.hinh_anh = file;
                }
            };
            reader.readAsDataURL(file);
        },
        addDanhMuc() {
            if (!this.list_chon.includes(this.choice)) {
                this.list_chon.push(this.choice);
            }
        },
        addDanhMucUpdate() {
            if (!this.list_chon_update.includes(this.choice)) {
                this.list_chon_update.push(this.choice);
            }
        },
        removeDanhMuc(index) {
            this.list_chon.splice(index, 1)
        },
        removeDanhMucUpdate(index) {
            this.list_chon_update.splice(index, 1)
        },
        tenphimLimited(tenphim) {
            if (tenphim.length > this.maxChars) {
                return tenphim.substring(0, this.maxChars) + '...';
            }
            return tenphim;
        },
        tenLimited(tenqg) {
            if (tenqg && tenqg.length > this.maxChars) {
                return tenqg.substring(0, 15) + '...';
            }
            return tenqg || ''; // Return an empty string if tenqg is undefined or null
        },
        theloaisLimited(theLoais) {
            if (!Array.isArray(theLoais)) {
                return ''; // Hoặc một giá trị mặc định khác nếu theLoais không phải là mảng
            }

            let concatenatedString = theLoais.map(t => t.ten_the_loai).join(', ');
            if (concatenatedString.length > this.maxChars) {
                return concatenatedString.substring(0, this.maxChars) + '...';
            }
            return concatenatedString;
        },
        changPage(page) {
            if (this.check_page == 0) {
                this.laydataPhim(page);
            } else if (this.check_page == 1) {
                this.searchPhim(page);
            }
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            str = str.replace(/[đĐ]/g, "d");
            str = str.replace(/([^0-9a-z-\s])/g, "");
            str = str.replace(/(\s+)/g, "-");
            str = str.replace(/-+/g, "-");
            str = str.replace(/^-+|-+$/g, "");
            return str;
        },
        addSlug() {
            this.obj_add_phim.slug_phim = this.convertToSlug(
                this.obj_add_phim.ten_phim
            );
        },

        addSlugUpdate() {
            this.obj_update_phim.slug_phim = this.convertToSlug(
                this.obj_update_phim.ten_phim
            );
        },

        kiemTraSlug() {
            var payload = {
                slug: this.obj_add_phim.slug_phim,
            };
            baseRequest.post("admin/phim/kiem-tra-slug", payload).then((res) => {
                if (res.data.status) {
                    toaster.success(res.data.message);
                    this.is_create = 1;
                } else {
                    toaster.error(res.data.message);
                    this.is_create = 0;
                }
            })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        kiemTraSlugUpdate() {
            var payload = {
                slug: this.obj_update_phim.slug_phim,
                id: this.obj_update_phim.id,
            };
            baseRequest
                .post("admin/phim/kiem-tra-slug-update", payload)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.is_update = 1;

                    } else {
                        toaster.error(res.data.message);
                        this.is_update = 1;

                    }
                });
        },
        laydataPhim(page) {
            baseRequest.get("admin/phim/lay-du-lieu?page=" + page).then((res) => {
                if (res.data.status == false) {
                    toaster.error(res.data.message);
                } else {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                    this.list_the_loai = res.data.the_loai_admin;
                    this.list_tac_gia = res.data.tac_gia_admin;
                    this.list_loai_phim = res.data.loai_phim_admin;

                    this.list_phim.forEach((value, index) => {
                        value.idS = value.the_loais.map(obj => obj.id);
                    });
                }
            });
        },
        taoDataPhim() {
            this.obj_add_phim.the_loais = this.list_chon;
            const formData = new FormData();
            for (let key in this.obj_add_phim) {
                formData.append(key, this.obj_add_phim[key]);
            }
            baseRequest
                .post("admin/phim/thong-tin-tao", formData)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.obj_add_phim = {};
                        this.list_chon = [];
                        this.laydataPhim(1);

                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        searchPhim(page) {
            this.check_page = 1;
            baseRequest
                .post("admin/phim/thong-tin-tim?page=" + page, this.key_tim)
                .then((res) => {
                    this.list_phim = res.data.phim_admin.dataAdmin.data;
                    this.pagination = res.data.phim_admin.pagination;
                    this.list_the_loai = res.data.the_loai_admin;
                    this.list_tac_gia = res.data.tac_gia_admin;
                    this.list_loai_phim = res.data.loai_phim_admin;

                    this.list_phim.forEach((value, index) => {
                        value.idS = value.the_loais.map(obj => obj.id);
                    });
                });
        },
        deletePhim() {
            baseRequest
                .delete("admin/phim/thong-tin-xoa/" + this.obj_delete_phim.id)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                });
        },
        updatePhim() {
            this.obj_update_phim.the_loais = this.list_chon_update;
            const formData = new FormData();
            for (let key in this.obj_update_phim) {
                formData.append(key, this.obj_update_phim[key]);
            }
            baseRequest
                .post("admin/phim/thong-tin-cap-nhat", formData)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.danger("Thông báo<br>" + res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },

        doiTrangThai(xyz) {

            baseRequest
                .put("admin/phim/thong-tin-thay-doi-trang-thai", xyz)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success("Thông báo<br>" + res.data.message);
                        this.changPage(this.pagination.current_page);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
                .catch((res) => {
                    var errors = Object.values(res.response.data.errors);
                    toaster.error(errors[0]);
                });
        },
        // handleFile(event) {
        //     const file = event.target.files[0];
        //     const cloudName = "dltbjoii4";
        //     const uploadPreset = "yvvll2k0";

        //     const formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("upload_preset", uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: "POST",
        //         body: formData,
        //     })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             this.imageUrl = data.secure_url;
        //             this.obj_add_phim.hinh_anh = data.secure_url;
        //             toaster.success("Thêm ảnh thành công!");
        //         })
        //         .catch((error) => {
        //             toaster.error("Thêm ảnh không thành công!");
        //             console.error("Error uploading image:", error);
        //         });
        // },
        // handleFileUpload(event) {
        //     const file = event.target.files[0];
        //     const cloudName = "dltbjoii4";
        //     const uploadPreset = "yvvll2k0";
        //     const formData = new FormData();
        //     formData.append("file", file);
        //     formData.append("upload_preset", uploadPreset);

        //     fetch(`https://api.cloudinary.com/v1_1/${cloudName}/image/upload`, {
        //         method: "POST",
        //         body: formData,
        //     })
        //         .then((response) => response.json())
        //         .then((data) => {
        //             this.imageUrl = data.secure_url;
        //             this.obj_update_phim.hinh_anh = data.secure_url;
        //             toaster.success("Thêm ảnh thành công!");
        //         })
        //         .catch((error) => {
        //             console.error("Error uploading image:", error);
        //             toaster.error("Thêm ảnh không thành công!");
        //         });
        // },
    },
};
</script>
<style lang=""></style>
