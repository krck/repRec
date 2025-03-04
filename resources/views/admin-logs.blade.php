<x-app-layout>
    <x-slot:heading>
        Admin Logs
    </x-slot:heading>

    <div>
        <!-- Filter Buttons -->
        <div class="flex justify-center mb-4">
            <a href="{{ route('admin.logs', ['filterType' => 1]) }}" class="btn btn-primary mx-2">Last Hour</a>
            <a href="{{ route('admin.logs', ['filterType' => 2]) }}" class="btn btn-primary mx-2">Last Day</a>
            <a href="{{ route('admin.logs', ['filterType' => 3]) }}" class="btn btn-primary mx-2">Last Week</a>
        </div>
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
        <!-- Pagination Buttons -->
        <div class="mx-4 my-2">
            {{ $logs->links() }}
        </div>
    </div>

</x-app-layout>