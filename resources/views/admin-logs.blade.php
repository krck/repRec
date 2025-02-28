<x-app-layout>
    <x-slot:heading>
        Admin Logs
    </x-slot:heading>

    <div class="overflow-x-auto">
        <table class="table table-xs">
            <thead>
                <tr>
                    @foreach(['level' => 'level', 'exceptionType' => 'Exception Type', 'timestamp' => 'Timestamp'] as $field => $label)
                        <th>
                            {{ $label }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->level }}</td>
                        <td>{{ $log->exceptionType }}</td>
                        <td>{{ $log->timestamp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>