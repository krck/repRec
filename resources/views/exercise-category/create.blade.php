<x-app-layout>
    <x-slot:heading>
        Create Exercise Category
    </x-slot:heading>

    <div class="relative">
        <!-- Input Form -->
        <div class="overflow-y-auto overflow-x-hidden h-full">
            <form method="POST" action="{{ route('exercise-category.store') }}">
                @csrf
                <!-- Name -->
                <fieldset class="fieldset mb-2 p-2">
                    <legend class="fieldset-legend">Name</legend>
                    <input type="text" id="name" name="name" class="input input-accent w-full" placeholder="..."
                        value="{{ old('name') }}" required />
                    @error('name')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>
                <!-- JSON Template -->
                <fieldset class="fieldset mb-2 p-2">
                    <legend class="fieldset-legend">JSON Template</legend>
                    <textarea id="json_template" name="json_template" class="textarea textarea-accent h-24 w-full"
                        placeholder="{}" required>{{ old('json_template') }}</textarea>
                    @error('json_template')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>
                <!-- Description -->
                <fieldset class="fieldset mb-2 p-2">
                    <legend class="fieldset-legend">Description</legend>
                    <textarea id="description" name="description" class="textarea textarea-accent h-24 w-full"
                        placeholder="..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <!--
                    INFOs:
                    - csrf: Blade directive to add hidden Cross-Site Request Forgery token field.
                    - old('field_name'): Helper function to retrieve the old input value in case of validation errors.
                    - error('field_name'): Blade directive to display the error message for the given field.

                    If validation fails, Laravel will redirect back to the form and display the error messages automatically
                -->

                <!-- Buttons -->
                <div class="flex justify-between items-center m-4 px-4">
                    <a href="{{ route('exercise-category.index') }}" class="btn w-24 btn-soft btn-accent">Cancel</a>
                    <button type="submit" class="btn w-24 btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>