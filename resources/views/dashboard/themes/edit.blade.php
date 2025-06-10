<x-layouts.app :title="('Themes')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update Theme</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Theme Data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('themes.update', $theme->id) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:input label="Nama Theme" name="name" value="{{ $theme->name }}" class="mb-3" />

        <flux:textarea label="Deskripsi" name="description" class="mb-3">{{ $theme->description }}</flux:textarea>

        <flux:input label="Folder Theme" name="folder" value="{{ $theme->folder }}" class="mb-3" />

        <flux:select label="Status" name="status" class="mb-3">
            <option value="1" {{ $theme->status ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$theme->status ? 'selected' : '' }}>Tidak Aktif</option>
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('themes.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>