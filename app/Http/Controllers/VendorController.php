<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function indexs()
    {
        $tampils = Vendor::orderBy('id','DESC')->get();
        return view('tampil',compact('tampils'));
    }
    public function index()
    {
        $tampils = Vendor::orderBy('id','DESC')->get();
        $response = [
            'message' => "Show data terbaru!",
            'data' => $tampils
        ];
        return response()->json($response,201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
        $barang = new Vendor;
        // $barang->id = $request->id;
        $barang->id_vendor = $request->id_vendor;
        $barang->nama_produk = $request->nama_produk;
        $barang->deskripsi = $request->deskripsi;
        $barang->jumlah = $request->jumlah;
        $barang->harga = $request->harga;
        $barang->save();

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
        //
        $id_vendor = $request->id_vendor;
        $nama = $request->nama_produk;
        $deskripsi = $request->deskripsi;
        $harga = $request->harga;
        $jumlah = $request->jumlah;

        $barang = Vendor::find($id);
        $barang->id_vendor = $id_vendor;
        $barang->nama_produk = $nama;
        $barang->deskripsi = $deskripsi;
        $barang->harga = $harga;
        $barang->jumlah = $jumlah;
        $barang->save();

        return redirect()->route('vendor.index');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $barang = Vendor::find($id);
        $barang->delete();

        return redirect()->route('vendor.index');
    }
    public function add(){
        return view ('add');
    }
    public function edit($id){
        $edit = Vendor::findorFail($id);
        return view('edit', compact('edit'));
    }
}
