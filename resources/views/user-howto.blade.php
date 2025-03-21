<x-app-layout>
    <x-slot:heading>
        User Guide
    </x-slot:heading>

    <div class="slot-content">

        <div class="max-w-3xl mx-auto">
            <!-- Title -->
            <h1 class="text-4xl font-bold text-secondary-content text-center">RepRec - Guide</h1>
            <p class="mt-2 text-secondary-content text-center">Your complete guide to workout planning and
                tracking with RepRec - for additional information you can 📚 <a
                    href="https://github.com/krck/repRec-frontend/wiki" target="_blank"
                    class="text-secondary-content underline">Visit the RepRec Wiki</a></p>

            <!-- About Section -->
            <section id="about" class="mt-10">
                <h2 class="text-2xl font-bold text-secondary">📖 About RepRec</h2>
                <p class="mt-2">RepRec is a workout planning and tracking app designed to help you create,
                    manage and execute your workouts easily.</p>
                <ul class="list-disc ml-6 mt-2">
                    <li><b>Training Tracking</b>- Log exercises on the fly</li>
                    <li><b>Workout Planning</b>- Create structured weekly workout plans</li>
                    <li><b>Workout Sharing</b>- Share your workout templates with others</li>
                    <li><b>Progress Analysis</b>- Track progress and analyze performance</li>
                </ul>
            </section>

            <!-- Planning Section -->
            <section id="planning" class="mt-10">
                <h2 class="text-2xl font-bold text-secondary">🏋️ Plan Workouts</h2>
                <p class="mt-2">The <b>Planning</b> section allows you to create and structure your weekly workouts.
                    Each <b>Workout Template</b> consists of exercises that span a single <b>week</b>. This is a core
                    concept of planning with RepRec - create a weekly workout template that can then be slotted into
                    your Training Week view.</p>
                </p>
                <p class="mt-4"><b>💡 Tip:</b> Workouts are <b>not limited</b> to specific exercises. Customize them
                    freely based on your goals and create weekly Workouts that include Weight Training,
                    Endurance/Cardio, sports classes and other indoor/outdoor activities!</p>
                <h3 class="text-lg font-semibold mt-4">📝 Creating a Weekly Workout Plan</h3>
                <ul class="list-decimal ml-6 mt-2">
                    <li>Create and name your new Workout Plan</li>
                    <li>Add exercises to your weekly workout</li>
                    <li>Drag, drop and sort exercises within the day slots</li>
                    <li>Reuse & Modify this Workout Plan anytime</li>
                    <li>Share it with other RepRec users</li>
                </ul>
                <!-- Workout Example -->
                <div class="mt-6">
                    <details class="collapse bg-base-200 rounded-lg">
                        <summary class="collapse-title text-lg font-bold">🔽 Workout Example (Push/Pull/Legs + Cardio)
                        </summary>
                        <div class="collapse-content mt-2 p-2">
                            <p><b class="text-secondary-content">✅ Monday (Push Day)</b></p>
                            <ul class="list-disc ml-6">
                                <li>Bench Press</li>
                                <li>Shoulder Press</li>
                                <li>Tricep Dips</li>
                            </ul>
                            <p class="mt-2"><b class="text-secondary-content">✅ Tuesday (Cardio Day)</b></p>
                            <ul class="list-disc ml-6">
                                <li>Morning: Running</li>
                                <li>Evening: Cycling</li>
                            </ul>
                            <p class="mt-2"><b class="text-secondary-content">✅ Wednesday (Pull Day)</b></p>
                            <ul class="list-disc ml-6">
                                <li>Pull-ups</li>
                                <li>Barbell Rows</li>
                                <li>Bicep Curls</li>
                            </ul>
                            <p class="mt-2"><b class="text-secondary-content">✅ Thursday (Cardio Day)</b></p>
                            <ul class="list-disc ml-6">
                                <li>Morning: Jump Rope</li>
                                <li>Evening: Swimming</li>
                            </ul>
                            <p class="mt-2"><b class="text-secondary-content">✅ Friday (Leg Day)</b></p>
                            <ul class="list-disc ml-6">
                                <li>Squats</li>
                                <li>Deadlifts</li>
                                <li>Lunges</li>
                            </ul>
                        </div>
                    </details>
                </div>
                <p class="mt-4">Once created, a <b class="text-secondary-content">Workout Template</b> can be used in
                    the <b>Training</b> section, by scheduling it for specific week(s).</p>
                </p>
            </section>

            <!-- Training Section -->
            <section id="training" class="mt-10">
                <h2 class="text-2xl font-bold text-secondary">🏆 Training & Tracking</h2>
                <p class="mt-2">The <b>Training</b> section, where planned workouts are performed and tracked, consists
                    of three key views:</p>
                <ul class="list-decimal ml-6 mt-2">
                    <li>Training Year View</li>
                    <li>Training Week View</li>
                    <li>Training Progress View</li>
                </ul>

                <p><br>📌 <b>Training Year View:</b> Once a workout is planned, the template of this workout (and every
                    other available workout - be it self created or shared to you) is now available and can be scheduled
                    into calendar week slots for each year.
                </p>
                <p class="mt-4">📌 <b>Training Week View:</b> This is the <b>central view for RepRec</b> - Planned
                    workouts are performed here and the exercise data is tracked for each day. The currently active
                    workout template will be shown automatically, with the specific day selected. <b>💡 Important:</b>
                    All sets, reps, weights, times, etc. will be logged in this view, during a workout.
                </p>
                <p class="mt-4">📌 <b>Training Progress View: </b> View progress charts for each exercise and analyze
                    your performance over time to identify strength gains and weaknesses. Plateaus, regressions, or more
                    likely great gains and new personal bests!</p>
            </section>

            <!-- Conclusion -->
            <section id="conclusion" class="mt-10">
                <h2 class="text-2xl font-bold text-secondary">🚀 Start Training Today!</h2>
                <p class="mt-2">Now that you know the basics of planning, scheduling and performing workouts you can
                    start using <b>RepRec</b> and take control of your fitness journey.</p>
                <p class="mt-4">📚 Need more detailed help? Visit the <a
                        href="https://github.com/krck/repRec-frontend/wiki" target="_blank"
                        class="text-secondary-content underline">Wiki</a> or reach out to the developers!
                </p>
            </section>
        </div>
    </div>

</x-app-layout>