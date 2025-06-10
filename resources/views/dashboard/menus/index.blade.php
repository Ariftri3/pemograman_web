<x-layouts.app :title="('Menus')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Menus</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage menu data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('menus.create') }}" variant="subtle">Add New Menu</flux:link>
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
                    <th>Menu Text</th>
                    <th>Menu Icon</th>
                    <th>Menu URL</th>
                    <th>Menu Order</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $key => $menu)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menu->menu_text }}</td>
                        <td>{{ $menu->menu_icon }}</td>
                        <td>{{ $menu->menu_url }}</td>
                        <td>{{ $menu->menu_order }}</td>
                        <td>
                            @if($menu->status)
                                <flux:badge color="lime">Active</flux:badge>
                            @else
                                <flux:badge color="red">Inactive</flux:badge>
                            @endif
                        </td>
                        <td>{{ $menu->created_at }}</td>
                        <td>
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('menus.edit', $menu->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this menu?')) document.getElementById('delete-form-{{ $menu->id }}').submit();">Delete</flux:menu.item>

                                    <form id="delete-form-{{ $menu->id }}" action="{{ route('menus.destroy', $menu->id) }}" method="POST">
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

        <div class="mt-4">
            {{ $menus->links() }}
        </div>
    </div>
</x-layouts.app>