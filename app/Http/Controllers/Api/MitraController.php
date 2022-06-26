<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Mitra;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mitras = Mitra::all();
        if(count($mitras) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mitras
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
            'Alamat' => 'required',
            'No_Telepon' => 'required',
            'KTP' => 'required',
            'Kontrak_Mulai' => 'required',
            'Kontrak_Selesai' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $mitra = Mitra::create($storeData);
        return response([
            'message' => 'Add Mitra Success',
            'data' => $mitra
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
        $mitra = Mitra::find($id);
        if(!is_null($mitra)){
            return response([
                'message' => 'Retrieve Mitra Success',
                'data' => $mitra
            ], 200);
        }
        return response([
            'message' => 'Mitra Not Found',
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
        $mitra = Mitra::find($id);
        if(is_null($mitra)){
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'Nama' => 'required|max:60',
            'Alamat' => 'required',
            'No_Telepon' => 'required',
            'KTP' => 'required',
            'Kontrak_Mulai' => 'required',
            'Kontrak_Selesai' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $mitra->Nama = $updateData['Nama'];
        $mitra->Alamat = $updateData['Alamat'];
        $mitra->No_Telepon = $updateData['No_Telepon'];
        $mitra->KTP = $updateData['KTP'];
        $mitra->Kontrak_Mulai = $updateData['Kontrak_Mulai'];
        $mitra->Kontrak_Selesai = $updateData['Kontrak_Selesai'];

        if($mitra->save()){
            return response([
                'message' => 'Update Mitra Success',
                'data' => $mitra
            ], 200);
        }
        return response([
            'message' => 'Update Mitra Failed',
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
        $mitra = Mitra::find($id);

        if(is_null($mitra)){
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ], 404);
        }

        if($mitra->delete()){
            return response([
                'message' => 'Delete Mitra Success',
                'data' => $mitra
            ], 200);
        }

        return response([
            'message' => 'Delete Mitra Failed',
            'data' => null,
        ], 400);
    }
}
