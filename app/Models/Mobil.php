<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mobil extends Model
{
    use HasFactory;
    protected $primaykey = 'id_mobil';
    protected $fillable = [
        'Nama_Mobil', 'Tipe_Mobil', 'Transmisi','Plat_Nomor', 'Warna_Mobil',
        'Kapasitas', 'Fasilitas', 'Tanggal_Servis', 'Bahan_Bakar', 'Volume_Bahan_Bakar',
        'Harga_Sewa', 'No_STNK'
    ];

    public function getCreatedAtAttribute() {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute() {
        if(!is_null($this->attributes['updated_at'])) {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
