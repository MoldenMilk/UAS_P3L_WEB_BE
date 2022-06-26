<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;
    protected $primaykey = 'id_customer';
    protected $fillable = [
        'id_customer', 'Nama', 'email', 'Tanggal_Lahir', 'Alamat',
        'Jenis_Kelamin', 'SIM', 'KTP', 'No_Telepon'
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
