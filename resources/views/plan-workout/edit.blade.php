<x-app-layout>
    <x-slot:heading>
        Edit {{ $planWorkout->name }}
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Edit From) -->
    <div class="slot-content">
        <form id="editPlanWorkoutForm" method="POST" action="{{ route('plan-workout.update', $planWorkout) }}">
            <!-- csrf: Blade directive to add hidden Cross-Site Request Forgery token field. -->
            @csrf
            @method('PATCH')

            <!-- Name -->
            <x-form-input-text name="name" label="Name" required :value="$planWorkout->name" />
            <!-- Description -->
            <x-form-input-textarea name="description" label="Description" :value="$planWorkout->description" />
        </form>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Cancel and Update button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('plan-workout.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
            <button type="submit" form="editPlanWorkoutForm" class="btn w-24 btn-primary">Update</button>
        </div>
    </div>

</x-app-layout>