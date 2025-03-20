<x-app-layout>
    <x-slot:heading>
        Edit Plan Workout Exercise
    </x-slot:heading>

    @pushOnce('js_after')
        <script type="module">
            $(document).ready(function () {
                $('#exercise_category_id').on('change', function () {
                    var selectedCategory = $(this).val();

                    // Loop through each exercise option (<select id=exercise_id>, <option> elements)
                    // (and simply show/hide the option tag, if the "filter-category" attribute matches the selected category)
                    $('#exercise_id option').each(function () {
                        var exerciseCategory = $(this).attr('filter-category');
                        if (!selectedCategory || exerciseCategory == selectedCategory) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    // Reset exercise selection
                    $('#exercise_id').val('');
                });
            });
        </script>
    @endPushOnce

    <!-- Slot Content: This is the part that scrolls (Edit From) -->
    <div class="slot-content">
        <form id="editPlanWorkoutExerciseForm" method="POST" x-data="{ selectedCategory: null }"
            action="{{ route('plan-workout-exercise.update', $planWorkoutExercise) }}">
            @csrf
            @method('PATCH')

            @php
                // Hardcoded dropdown - array with "id" and "name"
                $weekdays = [
                    ['id' => 0, 'name' => 'Monday'],
                    ['id' => 1, 'name' => 'Tuesday'],
                    ['id' => 2, 'name' => 'Wednesday'],
                    ['id' => 3, 'name' => 'Thursday'],
                    ['id' => 4, 'name' => 'Friday'],
                    ['id' => 5, 'name' => 'Saturday'],
                    ['id' => 6, 'name' => 'Sunday'],
                ];
            @endphp

            <!-- Exercise Category Select -->
            <x-form-input-select name="exercise_category_id" :options="$exerciseCategories"
                :value="$planWorkoutExercise->exercise_category_id" x-model="selectedCategory" />
            <!-- Exercise Select (Filtered) 
                 Not using component because of the custom JavaScript to show/hide dropdown options, based on exercise_category_id -->
            <fieldset class="fieldset mb-1 p-1">
                <select class="select select-accent w-full" id="exercise_id" name="exercise_id">
                    @foreach ($exercises as $exercise)
                        <option value="{{ $exercise->id }}" filter-category="{{ $exercise->exercise_category_id }}"
                            {{ $planWorkoutExercise->exercise_id == $exercise->id ? 'selected' : '' }} >
                            {{ $exercise->name }}
                        </option>
                    @endforeach
                </select>
                @error('exercise_id')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Weekday -->
            <x-form-input-select name="day_index" :options="$weekdays"
                :value="$planWorkoutExercise->day_index" />
            <!-- Dynamic Input -->
            <div class="mt-2">
                <!-- Default, Weightlifting 1, OlympicLifting 2, Strongman 3 -->
                <template x-if="(selectedCategory == null || ['1', '2', '3'].includes(selectedCategory))">
                    <x-exercise-input-weightlifting name="exercise_definition_json" 
                    :value="$planWorkoutExercise->exercise_definition_json"/>
                </template>
                <!-- Calisthenics 4, Plyometrics 5 -->
                <template x-if="['4', '5'].includes(selectedCategory)">
                    <x-exercise-input-bodyweight />
                </template>
                <!-- Stretching 6, EnduranceTraining 7 -->
                <template x-if="['6', '7'].includes(selectedCategory)">
                    <x-exercise-input-endurance />
                </template>
                <!-- PhysicalExercises 8, OtherActivities 9 -->
                <template
                    x-if="(selectedCategory != null && !(['1', '2', '3', '4', '5', '6', '7'].includes(selectedCategory)))">
                    <x-exercise-input-other />
                </template>
            </div>
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Update button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('plan-workout-exercise.index', $planWorkoutExercise->plan_workout_id) }}"
                class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="editPlanWorkoutExerciseForm" class="btn w-24 btn-primary">Update</button>
        </div>
    </div>

</x-app-layout>