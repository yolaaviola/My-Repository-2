<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('created_at', 'DESC')->paginate(10);
        return view('dosen.index', compact('dosens'));
    }

public function create()
    {
        return view('dosen.add');
    }

public function save(Request $request)
    {

        $this->validate($request, [
            'nm_dosen' => 'required|string',
            'sts_dosen' => 'required|string',
            'golongan' => 'required|string',
            'jab_tung'=> 'required|string',
            'id_sdk_jari' => 'required|string'
        ]);
    
        try {
            $dosen = Dosen::create([
                'nm_dosen' => $request->nm_dosen,
                'sts_dosen' => $request->sts_dosen,
                'golongan' => $request->golongan,
                'jab_tung' => $request->jab_tung,
                'id_sdk_jari' => $request->id_sdk_jari
            ]);
            return redirect('/dosen')->with(['success' => 'Data telah disimpan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
public function edit($id)
    {
        $dosen = Dosen::find($id);
        return view('dosen.edit', compact('dosen'));
    }

public function update(Request $request, $id)
{
    $this->validate($request, [
        'nm_dosen' => 'required|string',
        'sts_dosen' => 'required|string',
        'golongan' => 'required|string',
        'jab_tung'=> 'required|string',
        'id_sdk_jari' => 'required|string'
        ]);
    try {
        $dosen = Dosen::find($id);
        $dosen->update([
            'nm_dosen' => $request->nm_dosen,
            'sts_dosen' => $request->sts_dosen,
            'golongan' => $request->golongan,
            'jab_tung' => $request->jab_tung,
            'id_sdk_jari' => $request->id_sdk_jari
        ]);
        return redirect('/dosen')->with(['success' => 'Data telah diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}

public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        return redirect()->back()->with(['success' => '<strong>' . $dosen->nm_dosen . '</strong> Telah dihapus']);
    }
}
