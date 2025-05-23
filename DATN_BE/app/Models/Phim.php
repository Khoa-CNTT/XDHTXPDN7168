<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    use HasFactory;
    protected $table = 'phims';
    protected $fillable = [
        'ten_phim',
        'slug_phim',
        'hinh_anh',
        'mo_ta',
        'thoi_gian_chieu',
        'nam_san_xuat',
        'quoc_gia',
        'id_loai_phim',
        'the_loai_thanh_toan',
        'id_the_loai',
        'dao_dien',
        'so_tap_phim',
        'tong_luot_xem',
        'tinh_trang',
        'ngon_ngu',
        'poster_img',
        'trailer_url',
        'is_slide',
        'chat_luong',
        'is_hoan_thanh'
    ];

    CONST TINH_TRANG_HOAT_DONG = 1;
    CONST TINH_TRANG_KHOA = 0;

}

