<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Customer;
use App\Models\Transaksi;
use Carbon\Carbon;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        if(count($customers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
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
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'Nama' => 'required|max:60',
            'Email' => 'required|unique',
            'Password' => 'required',
            'Tanggal_Lahir' => 'required',
            'Alamat' => 'required',
            'Jenis_Kelamin' => 'required',
            'SIM' => 'required',
            'KTP' => 'required',
            'No_Telepon' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $customer = Customer::create($storeData);
        return response([
            'message' => 'Add Customer Success',
            'data' => $customer
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if(!is_null($customer)){
            return response([
                'message' => 'Retrieve Customer Success',
                'data' => $customer
            ], 200);
        }
        return response([
            'message' => 'Customer Not Found',
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
        $customer = Customer::find($id);
        if(is_null($customer)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'Nama' => 'required|max:60',
            'Email' => 'required',
            'Password' => 'required',
            'Tanggal_Lahir' => 'required',
            'Alamat' => 'required',
            'Jenis_Kelamin' => 'required',
            'SIM' => 'required',
            'KTP' => 'required',
            'No_Telepon' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $customer->Nama = $updateData['Nama'];
        $customer->Email = $updateData['Email'];
        $customer->Password = $updateData['Password'];
        $customer->Tanggal_Lahir = $updateData['Tanggal_Lahir'];
        $customer->Alamat = $updateData['Alamat'];
        $customer->Jenis_Kelamin = $updateData['Jenis_Kelamin'];
        $customer->SIM = $updateData['SIM'];
        $customer->KTP = $updateData['KTP'];
        $customer->No_Telepon = $updateData['No_Telepon'];

        if($customer->save()){
            return response([
                'message' => 'Update Customer Success',
                'data' => $customer
            ], 200);
        }
        return response([
            'message' => 'Update Customer Failed',
            'data' => null,
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404);
        }

        if($customer->delete()){
            return response([
                'message' => 'Delete Customer Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Delete Customer Failed',
            'data' => null,
        ], 400);
    }

    public function addTransaksi(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_customer' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'id_mobil' => 'required',
            'id_promo' => 'nullable',
            'id_driver' => 'nullable',
            'id_pegawai' => 'required',
            'status' => 'required|numeric'
        ]);

        $startdate = Carbon::parse($request->tgl_mulai);
        $enddate = Carbon::parse($request->tgl_selesai);
        $duration = $enddate->diffInDays($startdate);
        $dt = Carbon::now()->format('ymd');
        $storeData ['durasi'] = $duration;

        $count = DB::table('transaksis')->count()+1;
        if($count<10){
            $zero = '00';
        }else{
            $zero = '0';
        }

        if($request -> id_driver == NULL){
            $dri = "02";
        }else{
            $dri = "01";
        }
        
        $storeData ['id_transaksi'] = 'TRN'.$dt.$dri."-".$zero.$count;
        $transaksi = Transaksi::create($storeData);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
            
        return response([
            'message' => 'Add Transaksi Success',
            'data' => $transaksi
        ], 200);
    }
}
