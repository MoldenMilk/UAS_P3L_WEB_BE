<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'=>'christianpyb@gmail.com',
            'password'=>'$2a$12$ZodktsOmMHEiCzqid.oWsO.Iq2h9zz2d6TNk6W8B3BVALAH75mwf6',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }
}
