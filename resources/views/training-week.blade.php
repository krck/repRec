<x-app-layout>
    <x-slot:heading>
        Training Week
    </x-slot:heading>

    <div class="slot-content">
        @if (Auth::guest())
            <!-- If not logged in -->
            <div class="flex justify-center m-2">
                <p>Please <b>Login</b> or <b>Register</b> to use RepRec</p>
            </div>
        @else
            <!-- If logged in, but no data -->
            <div class="m-2">
                <div class="flex flex-col justify-center mb-8 p-2">
                    <p class="text-center text-gray-600 mb-1">
                        In case you have not set an active Workout for this week, you can schedule a workout using the
                        Training-Year view
                    </p>
                    <a class="btn btn-primary" href="/training-year">Schedule Workout</a>
                </div>

                <div class="flex flex-col justify-center mb-8 p-2">
                    <p class="text-center text-gray-600 mb-1">
                        In case you have no workouts available, you can go ahead and plan your first (or current) workout
                        here
                    </p>
                    <a class="btn btn-primary" href="/plan-workout">Plan Workout</a>
                </div>

                <div class="flex flex-col justify-center mb-8 p-2">
                    <p class="text-center text-gray-600 mb-1">If you need more guidance, you can check out the documentation
                        with examples here
                    </p>
                    <a class="btn btn-soft" href="/user-howto">Read the Guide</a>
                </div>
            </div>

            <!-- If logged in and data exists -->
            <div>
                <!-- ... -->
            </div>
        @endif
    </div>
</x-app-layout>