<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Menampilkan daftar semua themes dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $themes = Theme::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                      ->orWhere('folder', 'like', '%' . $request->q . '%');
            })
            ->paginate(10);

        return view('dashboard.themes.index', [
            'themes' => $themes,
            'q' => $request->q
        ]);
    }

    /**
     * Menampilkan form tambah theme.
     */
    public function create()
    {
        return view('dashboard.themes.create');
    }

    /**
     * Menyimpan data theme baru.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'folder' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errors' => $validator->errors(),
                'errorMessage' => 'Validasi Error, silakan periksa kembali.'
            ]);
        }

        $theme = new Theme();
        $theme->fill($request->only([
            'name', 'description', 'folder', 'status'
        ]));
        $theme->save();

        return redirect()->route('themes.index')->with('successMessage', 'Theme berhasil disimpan.');
    }

    /**
     * Menampilkan form edit theme.
     */
    public function edit(string $id)
    {
        $theme = Theme::findOrFail($id);
        return view('dashboard.themes.edit', compact('theme'));
    }

    /**
     * Mengupdate data theme.
     */
    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'folder' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errors' => $validator->errors(),
                'errorMessage' => 'Validasi Error, silakan periksa kembali.'
            ]);
        }

        $theme = Theme::findOrFail($id);
        $theme->fill($request->only([
            'name', 'description', 'folder', 'status'
        ]));
        $theme->save();

        return redirect()->route('themes.index')->with('successMessage', 'Theme berhasil diperbarui.');
    }

    /**
     * Menghapus data theme.
     */
    public function destroy(string $id)
    {
        $theme = Theme::findOrFail($id);
        $theme->delete();

        return redirect()->route('themes.index')->with('successMessage', 'Theme berhasil dihapus.');
    }
}
