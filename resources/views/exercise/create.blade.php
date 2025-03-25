<x-app-layout>
    <x-slot:heading>
        Create Exercise
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Create From) -->
    <div class="slot-content">
        <form id="createExerciseForm" method="POST" action="{{ route('exercise.store') }}">
            @csrf

            @php
                // Hardcoded dropdown values as variables
                $mechanics = ['Compound', 'Isolation', 'Unknown'];
                $levels = ['Beginner', 'Intermediate', 'Expert'];
                $forces = ['Push', 'Pull', 'Static', 'Other'];
                $equipment = ['Bands', 'Barbell', 'Body only', 'Cable', 'Dumbbell', 'Exercise ball', 'E-z curl bar', 'Foam roll', 'Kettlebells', 'Machine', 'Medicine ball', 'Other'];
            @endphp

            <!-- Name -->
            <x-form-input-text name="name" label="Name" required />
            <!-- Exercise Category -->
            <x-form-input-select name="exercise_category_id" label="Exercise Category" :options="$exerciseCategories" />
            <!-- Mechanic -->
            <x-form-input-select name="mechanic" label="Mechanic" :options="$mechanics" />
            <!-- Level -->
            <x-form-input-select name="level" label="Level" :options="$levels" />
            <!-- Force -->
            <x-form-input-select name="force" label="Force" :options="$forces" />
            <!-- Equipment -->
            <x-form-input-select name="equipment" label="Equipment" :options="$equipment" />
            <!-- Primary Muscles -->
            <x-form-input-textarea name="primary_muscles" label="Primary Muscles" required
                placeholder="Chest, Back, Quads, ..." />
            <!-- Secondary Muscles -->
            <x-form-input-textarea name="secondary_muscles" label="Secondary Muscles" required
                placeholder="Delts, Triceps, Biceps, ..." />
            <!-- Instructions -->
            <x-form-input-textarea name="instructions" label="Instructions" required />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Save button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('exercise.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="createExerciseForm" class="btn w-24 btn-primary">Save</button>
        </div>
    </div>

</x-app-layout>