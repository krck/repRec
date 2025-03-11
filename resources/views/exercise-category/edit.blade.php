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
            <x-form-input-text name="name" label="Name" required :value="$exerciseCategory->name" />
            <!-- JSON Template -->
            <x-form-input-textarea name="json_template" label="JSON Template" placeholder="{}" required
                :value="$exerciseCategory->json_template" />
            <!-- Description -->
            <x-form-input-textarea name="description" label="Description" required
                :value="$exerciseCategory->description" />
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