<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // Tampilkan daftar member
    public function index()
    {
        $members = Member::paginate(20);
        return view('members.index', compact('members'));
    }

    public function adminIndex()
    {
        $members = Member::paginate(20);
        return view('admin.members.index', compact('members'));
    }
    // Form tambah (admin)
    public function create()
    {
        return view('admin.members.create');
    }

    // Simpan member baru (admin)
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'foto.image' => 'File yang diunggah harus berupa gambar.',
                'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
                'foto.max' => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('members', 'public');
        }

        Member::create($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan!');
    }

    // Form edit (admin)
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    // Update member (admin)
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate(
            [
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'foto.image' => 'File yang diunggah harus berupa gambar.',
                'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
                'foto.max' => 'Ukuran gambar maksimal 2MB.',
            ]
        );


        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil diupdate!');
    }

    // Hapus member (admin)
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        //hapus foto di perangkat
        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus!');
    }
}
