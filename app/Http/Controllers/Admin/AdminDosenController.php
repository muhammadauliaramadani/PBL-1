<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|unique:dosens',
        'jabatan' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi foto dengan ukuran maksimal 10mb
    ]);

    $data = $request->all();

    // Menyimpan foto jika ada
    if ($request->hasFile('foto')) {
        // Menyimpan file di folder 'storage/app/public/images'
        $data['foto'] = $request->file('foto')->store('images', 'public'); // Ubah 'dosens' menjadi 'images'
    }

    Dosen::create($data);

    return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
}

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosens,nip,' . $id,
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi foto dengan ukuran maksimal 10mb
        ]);

        $dosen = Dosen::findOrFail($id);
        $data = $request->all();

        // Menyimpan foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $data['foto'] = $request->file('foto')->store('images', 'public');
        }

        $dosen->update($data);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function delete($id)
    {
        $dosen = Dosen::findOrFail($id);
        // Hapus foto jika ada
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}

