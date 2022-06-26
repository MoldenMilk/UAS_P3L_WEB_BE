<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        if(count($drivers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $drivers
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
            'Email' => 'required',
            'Password' => 'required',
            'Tanggal_Lahir' => 'required',
            'Alamat' => 'required',
            'Jenis_Kelamin' => 'required',
            'No_Telepon' => 'required',
            'Bahasa' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $driver = Driver::create($storeData);
        return response([
            'message' => 'Add Driver Success',
            'data' => $driver
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
        $driver = Driver::find($id);
        if(!is_null($driver)){
            return response([
                'message' => 'Retrieve Driver Success',
                'data' => $driver
            ], 200);
        }
        return response([
            'message' => 'Driver Not Found',
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
        $driver = Driver::find($id);
        if(is_null($driver)){
            return response([
                'message' => 'Driver Not Found',
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
            'No_Telepon' => 'required',
            'Bahasa' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $driver->Nama = $updateData['Nama'];
        $driver->Email = $updateData['Email'];
        $driver->Password = $updateData['Password'];
        $driver->Tanggal_Lahir = $updateData['Tanggal_Lahir'];
        $driver->Alamat = $updateData['Alamat'];
        $driver->Jenis_Kelamin = $updateData['Jenis_Kelamin'];
        $driver->No_Telepon = $updateData['No_Telepon'];
        $driver->Bahasa = $updateData['Bahasa'];

        if($driver->save()){
            return response([
                'message' => 'Update Driver Success',
                'data' => $driver
            ], 200);
        }
        return response([
            'message' => 'Update Driver Failed',
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
        $driver = Driver::find($id);

        if(is_null($driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }

        if($driver->delete()){
            return response([
                'message' => 'Delete Driver Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Delete Driver Failed',
            'data' => null,
        ], 400);
    }
}
