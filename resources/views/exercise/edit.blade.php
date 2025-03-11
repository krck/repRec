<x-app-layout>
    <x-slot:heading>
        Edit {{ $exercise->name }}
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Edit From) -->
    <div class="slot-content">
        <form id="editExerciseForm" method="POST" action="{{ route('exercise.update', $exercise) }}">
            @csrf
            @method('PATCH')

            @php
                // Hardcoded dropdown values as variables
                $mechanics = ['Compound', 'Isolation', 'Unknown'];
                $levels = ['Beginner', 'Intermediate', 'Expert'];
                $forces = ['Push', 'Pull', 'Static', 'Other'];
                $equipment = ['Bands', 'Barbell', 'Body only', 'Cable', 'Dumbbell', 'Exercise ball', 'E-z curl bar', 'Foam roll', 'Kettlebells', 'Machine', 'Medicine ball', 'Other'];
            @endphp

            <!-- Name -->
            <x-form-input-text name="name" label="Name" required :value="$exercise->name" />
            <!-- Exercise Category -->
            <x-form-input-select name="exercise_category_id" label="Exercise Category" :options="$exerciseCategories"
                :value="$exercise->exercise_category_id" />
            <!-- Mechanic -->
            <x-form-input-select name="mechanic" label="Mechanic" :options="$mechanics" :value="$exercise->mechanic" />
            <!-- Level -->
            <x-form-input-select name="level" label="Level" :options="$levels" :value="$exercise->level" />
            <!-- Force -->
            <x-form-input-select name="force" label="Force" :options="$forces" :value="$exercise->force" />
            <!-- Equipment -->
            <x-form-input-select name="equipment" label="Equipment" :options="$equipment"
                :value="$exercise->equipment" />
            <!-- Primary Muscles -->
            <x-form-input-textarea name="primary_muscles" label="Primary Muscles" required
                placeholder="Chest, Back, Quads, ..." :value="$exercise->primary_muscles" />
            <!-- Secondary Muscles -->
            <x-form-input-textarea name="secondary_muscles" label="Secondary Muscles" required
                placeholder="Delts, Triceps, Biceps, ..." :value="$exercise->secondary_muscles" />
            <!-- Instructions -->
            <x-form-input-textarea name="instructions" label="Instructions" :value="$exercise->instructions" />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Update button) -->
    <div class="slot-footer">
        <div class="w-full flex justify-between items-center m-2 px-4">
            <a href="{{ route('exercise.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="editExerciseForm" class="btn w-24 btn-primary">Update</button>
        </div>
    </div>

</x-app-layout>