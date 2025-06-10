<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $menus = Menu::when($q, function ($query) use ($q) {
            $query->where('menu_text', 'like', '%' . $q . '%');
        })->paginate(10);

        return view('dashboard.menus.index', compact('menus', 'q'));
    }

    public function create()
    {
        return view('dashboard.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string|max:255',
            'menu_url' => 'required|string|max:255',
            'menu_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        Menu::create($validated);

        return redirect()->route('menus.index')->with('successMessage', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit', ['menu' => $menu]);
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string|max:255',
            'menu_url' => 'required|string|max:255',
            'menu_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $menu->update($validated);

        return redirect()->route('menus.index')->with('successMessage', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('successMessage', 'Menu berhasil dihapus.');
    }
}
