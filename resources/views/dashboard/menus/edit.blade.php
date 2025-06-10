<x-layouts.app :title="('Menus')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update Menu</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Menu Data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
    <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
    <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:input label="Text Menu" name="menu_text" value="{{ $menu->menu_text }}" class="mb-3" />

        <flux:input label="Icon Menu" name="menu_icon" value="{{ $menu->menu_icon }}" class="mb-3" />

        <flux:input label="URL Menu" name="menu_url" value="{{ $menu->menu_url }}" class="mb-3" />

        <flux:input label="Urutan Menu" name="menu_order" type="number" value="{{ $menu->menu_order }}" class="mb-3" />

        <flux:select label="Status" name="status" class="mb-3">
            <option value="1" {{ $menu->status ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$menu->status ? 'selected' : '' }}>Tidak Aktif</option>
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('menus.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>