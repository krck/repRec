<x-app-layout>
    <x-slot:heading>
        Plan new Workout
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Create From) -->
    <div class="slot-content">
        <form id="createPlanWorkoutForm" method="POST" action="{{ route('plan-workout.store') }}">
            <!-- csrf: Blade directive to add hidden Cross-Site Request Forgery token field. -->
            @csrf

            <!-- Name -->
            <x-form-input-text name="name" label="Name" required />
            <!-- Description -->
            <x-form-input-textarea name="description" label="Description" />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Save button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('plan-workout.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="createPlanWorkoutForm" class="btn w-24 btn-primary">Save</button>
        </div>
    </div>

</x-app-layout>