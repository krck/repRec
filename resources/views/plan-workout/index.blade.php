<x-app-layout>
    <x-slot:heading>
        Plan Workouts
    </x-slot:heading>

    @pushOnce('js_after')
    <script src="/js/components/dlg-global.js"></script>
    <script type="module" nonce="{{ $cspNonce }}">
        // Delete buttons with "unique" class for identification - add click event listener here, for CSP
        document.querySelectorAll('.unique-delete-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                var deleteUrl = '{{ route('plan-workout.destroy', ':id') }}'.replace(':id', this.getAttribute('data-id'));
                openDeleteModal(deleteUrl);
            });
        });
    </script>
    @endpushOnce

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        @if(!$planWorkouts->count())
            <p class="alert alert-notice text-center">
                <b>No Workouts found</b>
                Plan your first one now, by clicking the [+] button below
            </p>
        @endif
        <table class="w-full table">
            <tbody>
                @foreach($planWorkouts as $planWorkout)
                    <tr class="hover:bg-gray-100">
                        <td class="w-[50%]">
                            <div class="my-1 font-bold">{{ $planWorkout->name }}</div>
                        </td>
                        <td class="w-[20%]">
                            <div class="my-1">{{ $planWorkout->created_at->format('Y-m-d') }}</div>
                        </td>
                        <td class="w-[30%] text-right">
                            <div>
                                <!-- Dropdown Menu -->
                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="btn btn-circle"><x-icon img="more_vert" /></div>
                                    <ul tabindex="0"
                                        class="dropdown-content menu bg-base-100 rounded-box z-10 w-40 shadow-md">
                                        <li>
                                            <!-- Link to Edit -->
                                            <a href="{{ route('plan-workout.edit', $planWorkout) }}"
                                                class="btn btn-ghost flex justify-start">
                                                <x-icon img="edit" />Edit
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Link to Duplicate -->
                                            <a href="{{ route('plan-workout.edit', $planWorkout) }}"
                                                class="btn btn-ghost flex justify-start" disabled>
                                                <x-icon img="file_copy" />Duplicate
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Link to Share -->
                                            <a href="{{ route('plan-workout.edit', $planWorkout) }}"
                                                class="btn btn-ghost flex justify-start" disabled>
                                                <x-icon img="ios_share" />Share
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Delete Button calling modal dialog -->
                                            <button type="button" class="btn btn-ghost flex justify-start unique-delete-btn"
                                                data-id="{{ $planWorkout->id }}">
                                                <x-icon img="delete" class="text-error" />Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Link to Plan Workout Exercises -->
                                <x-nav-link class="btn btn-circle"
                                    href="{{ route('plan-workout-exercise.index', $planWorkout->id) }}">
                                    <x-icon img=" arrow_forward_ios" />
                                </x-nav-link>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Back and New button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <div><!-- empty --></div>
            <a href="{{ route('plan-workout.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Plan Workout" />

</x-app-layout>