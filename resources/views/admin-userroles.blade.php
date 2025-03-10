<x-app-layout>
    <x-slot:heading>
        Admin User-Roles
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Table) -->
    <div class="slot-content">
        <table class="table table-xs">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userRoles as $userRole)
                    <tr>
                        <td>{{ $userRole->id }}</td>
                        <td>{{ $userRole->name }}</td>
                        <td>{{ $userRole->email }}</td>
                        <td>{{ $userRole->verified }}</td>
                        <td>{{ $userRole->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with default Pagination-Buttons) -->
    <div class="slot-footer">
        <div class="m-2 px-4">
            {{ $userRoles->links() }}
        </div>
    </div>

</x-app-layout>