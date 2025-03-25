@props(['name', 'value' => null])

@pushOnce('js_after')
    <script src="/js/components/exercise-input-endurance.js"></script>
@endPushOnce

<div class="bg-base-100 shadow-md rounded-md m-1 p-2 border-2 border-solid border-gray-300">
    <div x-data="enduranceInput({{ $value ? $value : 'null' }})" class="flex w-full flex-col">
        <!-- Hidden Input to store JSON data -->
        <input type="hidden" id="{{ $name }}" name="{{ $name }}" x-model="exerciseDefinitionJson" required>
        @error($name)
            <p class="text-error text-center text-sm">{{ $message }}</p>
        @enderror

        <div class="flex justify-between items-center">
            <div class="min-w-40 mr-2">
                <!-- Duration Input -->
                <label class="mt-2">Duration</label>
                <input type="time" min='00:00:01' max='10:00:00' step="any" class="input input-bordered w-full"
                    x-model="duration">
            </div>
            <div class="min-w-40 mr-2">
                <!-- Distance Input -->
                <label class="mt-2">Distance (km/mi)</label>
                <input type="number" class="input input-bordered w-full" x-model="distance" min="0" max="100"
                    step="0.1">
            </div>
            <div>
                <!-- Auto-Calculated Pace -->
                <label class="mt-2">Pace</label>
                <input type="text" class="input input-bordered w-full bg-gray-200" x-model="calculatedPace" readonly>
            </div>
        </div>

        <!-- Target HR Zone -->
        <label class="mt-2">Target Heart Rate Zone</label>
        <select x-model="targetHrZone" class="select select-bordered w-full">
            <option value="Z1">Zone 1 (50-60%) - Recovery</option>
            <option value="Z2">Zone 2 (60-70%) - Endurance</option>
            <option value="Z3">Zone 3 (70-80%) - Tempo</option>
            <option value="Z4">Zone 4 (80-90%) - Threshold</option>
            <option value="Z5">Zone 5 (90-100%) - Max Effort</option>
        </select>

        <!-- Notes -->
        <label class="mt-2">Notes</label>
        <textarea class="textarea textarea-bordered w-full" x-model="notes"></textarea>

        <!-- Workout Tags -->
        <label class="mt-2">Workout Type</label>
        <div class="m-2">
            <div class="flex flex-wrap gap-2">
                <template x-for="(tag, index) in availableTags" :key="index">
                    <button type="button" @click="toggleTag(tag)" :class="getTagClass(tag)"
                        class="px-4 py-2 rounded-lg text-sm focus:outline-none">
                        <span x-text="tag"></span>
                    </button>
                </template>
            </div>
        </div>
    </div>
</div>