<x-app-layout>
    <x-slot:heading>
        {{ $planWorkout->name }}
    </x-slot:heading>

    @php
        // Split all plan workout exercises by day index
        $planWorkoutExerciseLookup = [
            ['day' => 'Monday', 'data' => $planWorkoutExercises->where('day_index', 0)],
            ['day' => 'Tuesday', 'data' => $planWorkoutExercises->where('day_index', 1)],
            ['day' => 'Wednesday', 'data' => $planWorkoutExercises->where('day_index', 2)],
            ['day' => 'Thursday', 'data' => $planWorkoutExercises->where('day_index', 3)],
            ['day' => 'Friday', 'data' => $planWorkoutExercises->where('day_index', 4)],
            ['day' => 'Saturday', 'data' => $planWorkoutExercises->where('day_index', 5)],
            ['day' => 'Sunday', 'data' => $planWorkoutExercises->where('day_index', 6)],
        ];
    @endphp

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        @foreach($planWorkoutExerciseLookup as $planWorkoutExercises)
            <div class="day-slot flex items-center justify-center border rounded-lg pl-1 pt-1 pr-1 bg-gray-100 min-h-16 mb-2"
                data-day="{{ $planWorkoutExercises['day'] }}">
                @if($planWorkoutExercises['data']->isEmpty())
                    <!-- DAY NAME (in case no exercises exist) -->
                    <h3 class="text-center text-gray-400">{{ $planWorkoutExercises['day'] }}</h3>
                @else
                    <!-- DAY EXERCISES -->
                    <div class="exercise-list w-full" id="day-{{ $loop->index }}">
                        @foreach ($planWorkoutExercises['data'] as $planWorkoutExercise)
                            <div class="exercise-item p-2 bg-neutral-content rounded-lg cursor-move text-center mb-1"
                                data-id="{{ $planWorkoutExercise->id }}" data-day="{{ $loop->index }}">
                                <div class="flex justify-between items-center">
                                    <x-icon img="drag_indicator" />
                                    <p>{{ $planWorkoutExercise->exercise->name }}</p>
                                    <!-- Dropdown Menu -->
                                    <div class="dropdown dropdown-end">
                                        <div tabindex="0" role="button" class="btn btn-circle"><x-icon img="more_vert" /></div>
                                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-10 w-40 shadow-md">
                                            <li>
                                                <a href="{{ route('plan-workout-exercise.edit', $planWorkoutExercise) }}"
                                                    class="btn btn-ghost flex justify-start">
                                                    <x-icon img="edit" />Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="btn btn-ghost flex justify-start"
                                                    onclick="openDeleteModal('{{ route('plan-workout-exercise.destroy', $planWorkoutExercise->id) }}')">
                                                    <x-icon img="delete" class="text-error" />Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
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

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Exercise" />

</x-app-layout>