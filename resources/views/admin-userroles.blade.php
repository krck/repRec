<x-app-layout>
    <x-slot:heading>
        Admin User-Roles
    </x-slot:heading>

    <div>
        <!-- UserRoles Table -->
        <div class="overflow-x-auto">
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
        <!-- Pagination Buttons -->
        <div class="mx-4 my-2">
            {{ $userRoles->links() }}
        </div>
    </div>

</x-app-layout>