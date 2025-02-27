<x-app-layout>
    <x-slot:heading>
        User HowTo
    </x-slot:heading>

    <div>
        <h1 class="fg-accent-500">RepRec</h1>

        <p>Quickstart Guide (HowTo) for RepRec</p>

        <h2 class="fg-accent-500">About</h2>

        <p>RepRec is a fitness planning and tracking app that helps you to keep an eye on your progress and your
            workouts.
            It is designed to be simple and easy to use, so you can focus on your training and not on the app.</p>

        <p>The app is divided into two main sections for all users: Training and Planning.</p>

        <p>More details can be found in the RepRec <a href="https://github.com/krck/repRec-frontend/wiki"
                target="_blank" class="fg-accent-500 underline">Wiki</a>
        </p>

        <h2 class="fg-accent-500" id="planning">Planning</h2>

        <p>In the Planning section, you can create and plan your own workouts and share them with others. The core
            building
            block of all planning within RepRec is a <b class="fg-accent-500">Workout</b>. A Workout is a collection of
            exercises that you can perform in a single week. The <b class="fg-accent-500">weekly aspect</b> of a Workout
            is important and will be carried over to the Training section and all other sections of the app.</p>

        <p>You can create a weekly workout by adding exercises to it and saving it for later use. There is no limitation
            to the kind of exercises you can add to a workout, making it a easy and flexible way to create a workout
            that
            fits your needs. A simple example would be a Push/Pull/Legs split, interwoven with some cardio. The planned
            workout would look something like this:</p>

        <mat-accordion>
            <mat-expansion-panel>
                <mat-expansion-panel-header>
                    <mat-panel-title>
                        Workout Example
                    </mat-panel-title>
                </mat-expansion-panel-header>
                <p>
                    <b class="fg-accent-500">Monday:</b>
                    <br>- (Push) Exercise 1
                    <br>- (Push) Exercise 2
                    <br>- (Push) Exercise 3
                    <br>- ...
                    <br>
                    <br><b class="fg-accent-500">Tuesday:</b>
                    <br>- Cardio Exercise 1 (in the Morning)
                    <br>- Cardio Exercise 2 (in the Evening)
                    <br>
                    <br><b class="fg-accent-500">Wednesday:</b>
                    <br>- (Pull) Exercise 1
                    <br>- (Pull) Exercise 2
                    <br>- (Pull) Exercise 3
                    <br>- ...
                    <br>
                    <br><b class="fg-accent-500">Thursday:</b>
                    <br>- Cardio Exercise 1 (in the Morning)
                    <br>- Cardio Exercise 2 (in the Evening)
                    <br>
                    <br><b class="fg-accent-500">Friday:</b>
                    <br>- (Legs) Exercise 1
                    <br>- (Legs) Exercise 2
                    <br>- (Legs) Exercise 3
                    <br>- ...
                </p>
            </mat-expansion-panel>
        </mat-accordion>

        <p><br>Once created, the Workout is now a <b class="fg-accent-500">Template</b> that can be used in the Training
            section. It can be used once (for one week), or more likely, it can be used multiple times, for multiple
            weeks.
            The Workout will be copied to the Training section, where you can work through the exercises and track your
            progress.
        </p>

        <p>You can also update, duplicate or delete the Workout template at any time. In addition, you can share your
            Workout with other RepRec users, so they can use it as well.</p>

        <h2 class="fg-accent-500" id="training">Training</h2>

        <p>The Training part is split into three view:
            <br>- A Training-<b class="fg-accent-500">Week</b> view, where the currently active Workout template is
            executed
            (exercises are tracked)
            <br>- A Training-<b class="fg-accent-500">Year</b> view, where Workout templates can be scheduled for each
            week
            of the year
            <br>- A Training-<b class="fg-accent-500">Progress</b> view, where the progress of each exercise can be
            visualized over time
            <br>
            <br>Each view is designed to give you simple access before, during and after training, to help you to stay
            on
            track with your training goals.
        </p>

        <p>...</p>

    </div>

</x-app-layout>