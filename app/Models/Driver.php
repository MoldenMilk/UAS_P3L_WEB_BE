<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class Driver extends Model
{
    use HasFactory;
    protected $primaykey = 'id_driver';
    protected $fillable = [
        'Nama', 'Email', 'Password', 'Tanggal_Lahir', 'Alamat',
        'Jenis_Kelamin', 'No_Telepon', 'Bahasa'
    ];

    protected $hidden = [
        'Password', 'remember_token',
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
