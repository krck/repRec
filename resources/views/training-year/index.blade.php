<x-app-layout>
    <x-slot:heading>
        Training Year
    </x-slot:heading>

    @php
        // Dynamic years (from 2020 to "current + 1")
        $years = collect(range(2020, now()->year + 1))->map(function ($year) {
            return (object) ['id' => $year, 'name' => $year];
        });

        function getWeekDateRangeStr($year, $cw): string
        {
            // Using the current ISO Date to jump to the first/last day of any given week
            $today = new DateTime('today');
            $firstDayStr = $today->setISODate($year, $cw, 0)->format('d.m');
            $lastDayStr = $today->setISODate($year, $cw, 6)->format('d.m');
            return ($firstDayStr . '-' . $lastDayStr);
        }
    @endphp
    @pushOnce('js_after')
        <script type="module" nonce="{{ $cspNonce }}">
            $(document).ready(function () {
                $('#yearSelect').change(function () {
                    var selectedYear = $(this).val();
                    window.location.href = "{{ route('training-year.index') }}?year=" + selectedYear;
                });
            });
        </script>
    @endPushOnce

    <!-- Slot Header: Fixed at the top (Year Selection) -->
    <div class="slot-header ">
        <div class="mr-2 ml-2 mb-2">
            <select id="yearSelect" class="select select-accent w-full">
                @foreach ($years as $year)
                    <option value="{{ $year->id }}" {{ $year->id == $selectedYear ? 'selected' : '' }}>{{ $year->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        <div class="m-2">
            @for($cw = 1; $cw <= $maxWeek; $cw++)
                <div class="flex items-center justify-center border rounded-lg pl-1 pt-1 pr-1 bg-gray-100 min-h-16 mb-2">
                    <!-- WEEK-SLOT with date-range or Workout -->
                    <ul class="workout-slot w-full" id="cw-{{ $cw }}" cw-index="{{ $cw }}">
                        <h3 class="text-center text-sm text-gray-400 mb-1">
                            <b>Week {{ ($cw < 10 ? "0" : "") }}{{ $cw }}</b> - {{ getWeekDateRangeStr($selectedYear, $cw) }}
                        </h3>

                    </ul>
                </div>
            @endfor
        </div>
    </div>
    <!-- Slot Footer: Fixed at the bottom (Add Workout Button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <div><!-- empty --></div>
            <a href="{{ route('training-year.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

</x-app-layout>