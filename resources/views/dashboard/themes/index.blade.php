<x-layouts.app :title="('Themes')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Themes</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage theme data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('themes.create') }}" variant="subtle">Add New Theme</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('successMessage') }}</flux:badge>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Folder</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($themes as $key => $theme)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $theme->name }}</td>
                        <td>{{ $theme->description }}</td>
                        <td>{{ $theme->folder }}</td>
                        <td>
                            @if($theme->status)
                                <flux:badge color="lime">Active</flux:badge>
                            @else
                                <flux:badge color="red">Inactive</flux:badge>
                            @endif
                        </td>
                        <td>{{ $theme->created_at }}</td>
                        <td>
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('themes.edit', $theme->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this theme?')) document.getElementById('delete-form-{{ $theme->id }}').submit();">Delete</flux:menu.item>

                                    <form id="delete-form-{{ $theme->id }}" action="{{ route('themes.destroy', $theme->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>