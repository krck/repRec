<x-app-layout>
    <x-slot:heading>
        Create Exercise
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Create From) -->
    <div class="slot-content">
        <form id="createExerciseForm" method="POST" action="{{ route('exercise.store') }}">
            @csrf

            <!-- Name -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" id="name" name="name" class="input input-accent w-full" placeholder="..."
                    value="{{ old('name') }}" required />
                @error('name')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Exercise Category -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Exercise Category</legend>
                <select class="select select-accent w-full" id="exercise_category_id" name="exercise_category_id">
                    @foreach ($exerciseCategories as $exerciseCategory)
                        <option value="{{ $exerciseCategory->id }}">{{ $exerciseCategory->name }}</option>
                    @endforeach
                </select>
                @error('exercise_category_id')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Mechanic -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Mechanic</legend>
                <select class="select select-accent w-full" id="mechanic" name="mechanic">
                    <option>Compound</option>
                    <option>Isolation</option>
                    <option>Unknown</option>
                </select>
                @error('mechanic')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Level -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Level</legend>
                <select class="select select-accent w-full" id="level" name="level">
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Expert</option>
                </select>
                @error('level')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Force -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Force</legend>
                <select class="select select-accent w-full" id="force" name="force">
                    <option>Push</option>
                    <option>Pull</option>
                    <option>Static</option>
                    <option>Other</option>
                </select>
                @error('force')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Equipment -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Equipment</legend>
                <select class="select select-accent w-full" id="equipment" name="equipment">
                    <option>Bands</option>
                    <option>Barbell</option>
                    <option>Body only</option>
                    <option>Cable</option>
                    <option>Dumbbell</option>
                    <option>Exercise ball</option>
                    <option>E-z curl bar</option>
                    <option>Foam roll</option>
                    <option>Kettlebells</option>
                    <option>Machine</option>
                    <option>Medicine ball</option>
                    <option>Other</option>
                </select>
                @error('equipment')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Primary Muscles -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Primary Muscles</legend>
                <textarea id="primary_muscles" name="primary_muscles" class="textarea textarea-accent h-24 w-full"
                    placeholder="Chest, Back, Quads, ..." required>{{ old('primary_muscles') }}</textarea>
                @error('primary_muscles')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Secondary Muscles -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Secondary Muscles</legend>
                <textarea id="secondary_muscles" name="secondary_muscles" class="textarea textarea-accent h-24 w-full"
                    placeholder="Delts, Triceps, Biceps, ...">{{ old('secondary_muscles') }}</textarea>
                @error('secondary_muscles')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Instructions -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Instructions</legend>
                <textarea id="instructions" name="instructions" class="textarea textarea-accent h-24 w-full"
                    placeholder="...">{{ old('instructions') }}</textarea>
                @error('instructions')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>

        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Save button) -->
    <div class="slot-footer">
        <div class="w-full flex justify-between items-center m-2 px-4">
            <a href="{{ route('exercise.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="createExerciseForm" class="btn w-24 btn-primary">Save</button>
        </div>
    </div>

</x-app-layout>