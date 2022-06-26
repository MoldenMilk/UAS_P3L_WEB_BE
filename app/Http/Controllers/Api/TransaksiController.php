<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $transaksi = Transaksi::find($id);
        if(is_null($pesanan)){
            return response([
                'message' => 'Pesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            // 'id_customer' => 'required',
            // 'tgl_mulai' => 'required|date',
            // 'tgl_selesai' => 'required|date',
            // 'id_mobil' => 'required',
            // 'id_promo' => 'nullable',
            // 'id_driver' => 'nullable',
            // 'id_pegawai' => 'required',
            'status' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $transaksi->status = $updateData['status'];

        if($transaksi->save()){
            return response([
                'message' => 'Update Status Pesanan Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Update Status Pesanan Failed',
            'data' => null,
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTransaksi()
    {
        $transaksi = DB::table('transaksis')
        ->join('customers','customers.id_customer', '=', 'transaksis.id_customer')
        ->join('pegawais','pegawais.id_pegawai', '=', 'transaksis.id_pegawai')
        ->leftjoin('drivers','drivers.id_driver', '=', 'transaksis.id_driver')
        ->join('mobils','mobils.id_mobil', '=', 'transaksis.id_mobil')
        ->leftjoin('promos','promos.id_promo', '=', 'transaksis.id_promo')
        ->select('transaksis.id_transaksi', 'transaksis.tgl_mulai', 'transaksis.tgl_selesai', 'customers.id_customer', 
        'drivers.Nama', 'mobils.Nama_Mobil', 'promos.kodePromo', 'transaksis.status', 'transaksis.durasi')
        ->get();

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Transaksi Success',
                'data' => $transaksi
            ], 200);
        }
        return response([
            'message' => 'Transaksi Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
