<x-app-layout>
    <x-slot:heading>
        Edit {{ $exercise->name }}
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Edit From) -->
    <div class="slot-content">
        <form id="editExerciseForm" method="POST" action="{{ route('exercise.update', $exercise) }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" id="name" name="name" class="input input-accent w-full" placeholder="..."
                    value="{{ $exercise->name }}" required />
                @error('name')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Exercise Category -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Exercise Category</legend>
                <select class="select select-accent w-full" id="exercise_category_id" name="exercise_category_id">
                    @foreach ($exerciseCategories as $exerciseCategory)
                        <option value="{{ $exerciseCategory->id }}" {{ $exerciseCategory->id == $exercise->exercise_category_id ? 'selected' : '' }}>
                            {{ $exerciseCategory->name }}
                        </option>
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
                    <option {{ $exercise->mechanic == 'Compound' ? 'selected' : '' }}>Compound</option>
                    <option {{ $exercise->mechanic == 'Isolation' ? 'selected' : '' }}>Isolation</option>
                    <option {{ $exercise->mechanic == 'Unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('mechanic')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Level -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Level</legend>
                <select class="select select-accent w-full" id="level" name="level">
                    <option {{ $exercise->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option {{ $exercise->level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option {{ $exercise->level == 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>
                @error('level')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Force -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Force</legend>
                <select class="select select-accent w-full" id="force" name="force">
                    <option {{ $exercise->force == 'Push' ? 'selected' : '' }}>Push</option>
                    <option {{ $exercise->force == 'Pull' ? 'selected' : '' }}>Pull</option>
                    <option {{ $exercise->force == 'Static' ? 'selected' : '' }}>Static</option>
                    <option {{ $exercise->force == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('force')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Equipment -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Equipment</legend>
                <select class="select select-accent w-full" id="equipment" name="equipment">
                    <option {{ $exercise->equipment == 'Bands' ? 'selected' : '' }}>Bands</option>
                    <option {{ $exercise->equipment == 'Barbell' ? 'selected' : '' }}>Barbell</option>
                    <option {{ $exercise->equipment == 'Body only' ? 'selected' : '' }}>Body only</option>
                    <option {{ $exercise->equipment == 'Cable' ? 'selected' : '' }}>Cable</option>
                    <option {{ $exercise->equipment == 'Dumbbell' ? 'selected' : '' }}>Dumbbell</option>
                    <option {{ $exercise->equipment == 'Exercise ball' ? 'selected' : '' }}>Exercise ball</option>
                    <option {{ $exercise->equipment == 'E-z curl bar' ? 'selected' : '' }}>E-z curl bar</option>
                    <option {{ $exercise->equipment == 'Foam roll' ? 'selected' : '' }}>Foam roll</option>
                    <option {{ $exercise->equipment == 'Kettlebells' ? 'selected' : '' }}>Kettlebells</option>
                    <option {{ $exercise->equipment == 'Machine' ? 'selected' : '' }}>Machine</option>
                    <option {{ $exercise->equipment == 'Medicine ball' ? 'selected' : '' }}>Medicine ball</option>
                    <option {{ $exercise->equipment == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('equipment')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Primary Muscles -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Primary Muscles</legend>
                <textarea id="primary_muscles" name="primary_muscles" class="textarea textarea-accent h-24 w-full"
                    placeholder="Chest, Back, Quads, ..." required>{{ $exercise->primary_muscles }}</textarea>
                @error('primary_muscles')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Secondary Muscles -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Secondary Muscles</legend>
                <textarea id="secondary_muscles" name="secondary_muscles" class="textarea textarea-accent h-24 w-full"
                    placeholder="Delts, Triceps, Biceps, ...">{{ $exercise->secondary_muscles }}</textarea>
                @error('secondary_muscles')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Instructions -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Instructions</legend>
                <textarea id="instructions" name="instructions" class="textarea textarea-accent h-24 w-full"
                    placeholder="...">{{ $exercise->instructions }}</textarea>
                @error('instructions')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>

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