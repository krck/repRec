<x-app-layout>
    <x-slot:heading>
        {{ $planWorkout->name }} Exercises
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        <div class="grid grid-rows-7 gap-2">
            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <div class="day-slot border rounded-lg p-4 bg-gray-100" data-day="{{ $day }}">
                    <h3 class="text-center">{{ $day }}</h3>
                    <div class="exercise-list" id="day-{{ $loop->index }}">
                        <!-- Exercises for this day will be injected here -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Back and New button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('plan-workout.index') }}" class="btn btn-circle">
                <x-icon img="arrow_back_ios_new" />
            </a>
            <a href="{{ route('plan-workout-exercise.create', $planWorkout->id) }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

</x-app-layout>