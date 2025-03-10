<x-app-layout>
    <x-slot:heading>
        Edit {{ $exerciseCategory->name }}
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Edit From) -->
    <div class="slot-content">
        <form id="editExerciseCategoryForm" method="POST"
            action="{{ route('exercise-category.update', $exerciseCategory) }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Name</legend>
                <input type="text" id="name" name="name" class="input input-accent w-full" placeholder="..."
                    value="{{ $exerciseCategory->name }}" required />
                @error('name')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- JSON Template -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">JSON Template</legend>
                <textarea id="json_template" name="json_template" class="textarea textarea-accent h-24 w-full"
                    placeholder="{}" required>{{ $exerciseCategory->json_template }}</textarea>
                @error('json_template')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
            <!-- Description -->
            <fieldset class="fieldset mb-2 p-2">
                <legend class="fieldset-legend">Description</legend>
                <textarea id="description" name="description" class="textarea textarea-accent h-24 w-full"
                    placeholder="..." required>{{ $exerciseCategory->description }}</textarea>
                @error('description')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror
            </fieldset>
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Update button) -->
    <div class="slot-footer">
        <div class="w-full flex justify-between items-center m-2 px-4">
            <a href="{{ route('exercise-category.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="editExerciseCategoryForm" class="btn w-24 btn-primary">Update</button>
        </div>
    </div>

</x-app-layout>