<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Mobil;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobils = Mobil::all();
        if(count($mobils) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mobils
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
            'Nama_Mobil' => 'required|max:60',
            'Tipe_Mobil' => 'required',
            'Transmisi' => 'required',
            'Plat_Nomor' => 'required',
            'Warna_Mobil' => 'required',
            'Kapasitas' => 'required',
            'Fasilitas' => 'required',
            'Tanggal_Servis' => 'required',
            'Bahan_Bakar' => 'required',
            'Volume_Bahan_Bakar' => 'required',
            'Harga_Sewa'  => 'required', 
            'No_STNK'  => 'required', 
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $mobil = Mobil::create($storeData);
        return response([
            'message' => 'Add Mobil Success',
            'data' => $mobil
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
        $mobil = Mobil::find($id);
        if(!is_null($mobil)){
            return response([
                'message' => 'Retrieve Mobil Success',
                'data' => $mobil
            ], 200);
        }
        return response([
            'message' => 'Mobil Not Found',
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
        $mobil = Mobil::find($id);
        if(is_null($mobil)){
            return response([
                'message' => 'Mobil Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'Nama_Mobil' => 'required|max:60',
            'Tipe_Mobil' => 'required',
            'Transmisi' => 'required',
            'Plat_Nomor' => 'required',
            'Warna_Mobil' => 'required',
            'Kapasitas' => 'required',
            'Fasilitas' => 'required',
            'Tanggal_Servis' => 'required',
            'Bahan_Bakar' => 'required',
            'Volume_Bahan_Bakar' => 'required',
            'Harga_Sewa'  => 'required', 
            'No_STNK'  => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $mobil->Nama_Mobil = $updateData['Nama_Mobil'];
        $mobil->Tipe_Mobil = $updateData['Tipe_Mobil'];
        $mobil->Transmisi = $updateData['Transmisi'];
        $mobil->Plat_Nomor = $updateData['Plat_Nomor'];
        $mobil->Warna_Mobil = $updateData['Warna_Mobil'];
        $mobil->Kapasitas = $updateData['Kapasitas'];
        $mobil->Fasilitas = $updateData['Fasilitas'];
        $mobil->Tanggal_Servis = $updateData['Tanggal_Servis'];
        $mobil->Bahan_Bakar = $updateData['Bahan_Bakar'];
        $mobil->Volume_Bahan_Bakar = $updateData['Volume_Bahan_Bakar'];
        $mobil->Harga_Sewa = $updateData['Harga_Sewa'];
        $mobil->No_STNK = $updateData['No_STNK'];

        if($mobil->save()){
            return response([
                'message' => 'Update Mobil Success',
                'data' => $mobil
            ], 200);
        }
        return response([
            'message' => 'Update Mobil Failed',
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
        $mobil = Mobil::find($id);

        if(is_null($mobil)){
            return response([
                'message' => 'Mobil Not Found',
                'data' => null
            ], 404);
        }

        if($mobil->delete()){
            return response([
                'message' => 'Delete Mobil Success',
                'data' => $mobil
            ], 200);
        }

        return response([
            'message' => 'Delete Mobil Failed',
            'data' => null,
        ], 400);
    }
}
