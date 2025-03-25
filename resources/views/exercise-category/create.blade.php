<x-app-layout>
    <x-slot:heading>
        Create Exercise Category
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Create From) -->
    <div class="slot-content">
        <form id="createExerciseCategoryForm" method="POST" action="{{ route('exercise-category.store') }}">
            <!-- csrf: Blade directive to add hidden Cross-Site Request Forgery token field. -->
            @csrf

            <!-- Name -->
            <x-form-input-text name="name" label="Name" required />
            <!-- JSON Template -->
            <x-form-input-textarea name="json_template" label="JSON Template" placeholder="{}" required />
            <!-- Description -->
            <x-form-input-textarea name="description" label="Description" required />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Save button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('exercise-category.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="createExerciseCategoryForm" class="btn w-24 btn-primary">Save</button>
        </div>
    </div>

</x-app-layout>