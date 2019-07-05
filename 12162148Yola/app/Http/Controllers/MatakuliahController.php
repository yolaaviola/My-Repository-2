<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Matakuliah;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = Matakuliah::orderBy('created_at', 'DESC')->paginate(10);
        return view('matakuliah.index', compact('matakuliahs'));
    }

public function create()
    {
        return view('matakuliah.add');
    }

public function save(Request $request)
    {

        $this->validate($request, [
            'namamk' => 'required|string',
            'sks' => 'required|string',
            'kurikulum' => 'required|string',
            'jam'=> 'required|string'
        ]);
    
        try {
            $matakuliah = Matakuliah::create([
                'namamk' => $request->namamk,
                'sks' => $request->sks,
                'kurikulum' => $request->kurikulum,
                'jam' => $request->jam,
            ]);
            return redirect('/matakuliah')->with(['success' => 'Data telah disimpan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
public function edit($id)
    {
        $matakuliah = Matakuliah::find($id);
        return view('matakuliah.edit', compact('matakuliah'));
    }

public function update(Request $request, $id)
{
    $this->validate($request, [
        'nmmk' => 'required|string',
        'sks' => 'required|string',
        'kurikulum' => 'required|string',
        'jam'=> 'required|string'
        ]);
    try {
        $matakuliah = Matakuliah::find($id);
        $matakuliah->update([
            'nmmk' => $request->namamk,
            'sks' => $request->sks,
            'kurikulum' => $request->kurikulum,
            'jam' => $request->jam,
        ]);
        return redirect('/matakuliah')->with(['success' => 'Data telah diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}

public function destroy($id)
    {
        $matakuliah = Matakuliah::find($id);
        $matakuliah->delete();
        return redirect()->back()->with(['success' => '<strong>' . $matakuliah->namamk . '</strong> Telah dihapus']);
    }
}
