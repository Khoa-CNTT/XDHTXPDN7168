<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanPhim extends Model
{
    use HasFactory;
    protected $table = 'binh_luan_phims';
    protected $fillable = [
        'noi_dung',
        'id_phim',
        'id_khach_hang',
        'so_sao',
    ];
}
