<x-app-layout>
    <x-slot:heading>
        Admin Logs
    </x-slot:heading>

    <!-- Slot Header: Sticks to the top (Filter Buttons) -->
    <div class="slot-header ">
        <div class="flex justify-center mb-4">
            <a href="{{ route('admin.logs', ['filterType' => 1]) }}" class="btn btn-primary mx-2">Last Hour</a>
            <a href="{{ route('admin.logs', ['filterType' => 2]) }}" class="btn btn-primary mx-2">Last Day</a>
            <a href="{{ route('admin.logs', ['filterType' => 3]) }}" class="btn btn-primary mx-2">Last Week</a>
        </div>
    </div>

    <!-- Slot Content: This is the part that scrolls (Table) -->
    <div class="slot-content">
        <!-- Logs Table -->
        <div class="overflow-x-auto">
            <table class="table table-xs">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Source</th>
                        <th>User</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->timestamp }}</td>
                            <td>{{ $log->level }}</td>
                            <td>{{ $log->exceptionType }}</td>
                            <td>{{ $log->source }}</td>
                            <td>{{ $log->userName }}</td>
                            <td class="td-truncate" title="{{ $log->message }}">{{ Str::limit($log->message, 30) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with default Pagination-Buttons) -->
    <div class="slot-footer">
        <div class="m-2 px-4">
            {{ $logs->links() }}
        </div>
    </div>

</x-app-layout>