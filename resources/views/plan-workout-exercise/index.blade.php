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

    @pushOnce('js_after')
        <script type="module">
            document.addEventListener('DOMContentLoaded', function () {
                // Populate the exerciseData with the initial order of exercises
                let exerciseData = [];
                document.querySelectorAll('.exercise-list').forEach((list) => {
                    let dayIndex = list.dataset.dayIndex;
                    list.querySelectorAll('.exercise-item').forEach((item, order) => {
                        exerciseData.push({
                            id: item.dataset.id,
                            day_index: dayIndex,
                            day_order: order
                        });
                    });
                });

                // Apply SortableJS to each day exercise-list (shared drag-and-drop group)
                document.querySelectorAll('.exercise-list').forEach(list => {
                    new Sortable(list, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'dragging',
                        onEnd: function (evt) {
                            // When a drag-and-drop ends, build the newExerciseData with the new dayIndex/dayOrder
                            let newExerciseData = [];
                            document.querySelectorAll('.exercise-list').forEach((list) => {
                                let dayIndex = list.dataset.dayIndex;
                                list.querySelectorAll('.exercise-item').forEach((item, order) => {
                                    newExerciseData.push({
                                        id: item.dataset.id,
                                        day_index: dayIndex,
                                        day_order: order
                                    });
                                });
                            });

                            // Check for any changes in the order (only send Diff)
                            let changes = newExerciseData.filter((item, index) => {
                                var oldItem = exerciseData.find((e) => e.id === item.id);
                                return (oldItem && (oldItem.day_index !== item.day_index || oldItem.day_order !== item.day_order));
                            });
                            exerciseData = newExerciseData;

                            // Send all changes to the Endpoint to save the new order
                            fetch("{{ route('plan-workout-exercise.saveOrderOnClose') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({ exercises: changes })
                            });
                        }
                    });
                });
            });
        </script>
    @endPushOnce

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        @foreach($planWorkoutExerciseLookup as $planWorkoutExercises)
            <div class="flex items-center justify-center border rounded-lg pl-1 pt-1 pr-1 bg-gray-100 min-h-16 mb-2">
                <!-- DAY-SLOT with day name and exercise list -->
                <ul class="exercise-list w-full" id="day-{{ $loop->index }}" data-day-index="{{ $loop->index }}">
                    <h3 class="text-center text-sm text-gray-400 mb-1">{{ $planWorkoutExercises['day'] }}</h3>
                    @foreach ($planWorkoutExercises['data'] as $planWorkoutExercise)
                        <!-- EXERCISE-ITEM that can be dragged and dropped in any DAY-SLOT -->
                        <li class="exercise-item p-2 bg-neutral-content rounded-lg cursor-move text-center mb-1"
                            data-id="{{ $planWorkoutExercise->id }}">
                            <div class="flex justify-between items-center">
                                <!-- Drag Indicator, Exercise name and Dropdown Menu -->
                                <x-icon img="drag_indicator" />
                                <div class="flex flex-row items-start">
                                    <p class="text-gray-400 mr-2">
                                        [{{ App\Common\Enums\EnumExerciseCategory::getAcronymByKey($planWorkoutExercise->exercise->exercise_category_id)  }}]
                                    </p>
                                    <p>{{ $planWorkoutExercise->exercise->name }}</p>
                                </div>
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
                        </li>
                    @endforeach
                </ul>
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