<?php
namespace App\Http\Controllers;
use App\Models\BarangKeluar;
use App\Models\Merek;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all()->pluck('nama_barang', 'id');
        $merek = Merek::all()->pluck("nama_merek", 'id');

        $pageTitle = 'Barang Keluar';

        $barangkeluars = BarangKeluar::all();

        return view('barangkeluar.index', [
            'barangkeluars' => $barangkeluars,
            'barang' => $barang,
            'pageTitle' =>$pageTitle,
            'merek' => $merek,
        ]);
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    {
        $barangs = Barang::all();
        $pageTitle = "Barang Keluar";


        return view('barangkeluar.create', compact( 'pageTitle','barangs'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',

        ];

        $validator = Validator::make($request->all(), [

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        BarangKeluar::create($request->all());
        $barangs = Barang::findOrFail($request->barang_id);
        $barangs->stok -= $request->stok;
        $barangs->save();
        return redirect()->route('barangkeluar.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
