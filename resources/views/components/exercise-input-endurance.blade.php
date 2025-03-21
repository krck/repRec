@props(['name', 'value' => null]) 

@pushOnce('js_after')
    <script>
        function enduranceInput(initialData = null) {
            return {
                duration: '',
                distance: '',
                targetHrZone: '',
                selectedTags: [],
                notes: '',
                calculatedPace: '',
                // Result string json
                exerciseDefinitionJson: '',
                // Hardcoded Tags
                availableTags: ["Aerobic Base", "Intervals", "Tempo Run", "Long Run", "Sprint Workout"],

                // Generate a json result string based on the inputs
                // - Update called manually on button presses - add/remove
                // - Update called automatically on input changes - watch
                init() {
                    if (initialData) {
                        let editData = typeof initialData === 'string' ? JSON.parse(initialData) : initialData;
                        this.duration = editData.duration || '';
                        this.distance = editData.distance || '';
                        this.targetHrZone = editData.targetHrZone || '';
                        this.selectedTags = editData.tags || [];
                        this.notes = editData.notes || '';
                    }
                    this.$watch('duration', () => this.updateExerciseDefinitionJson());
                    this.$watch('distance', () => this.updateExerciseDefinitionJson());
                    this.$watch('targetHrZone', () => this.updateExerciseDefinitionJson());
                    this.$watch('selectedTags', () => this.updateExerciseDefinitionJson());
                    this.$watch('notes', () => this.updateExerciseDefinitionJson());
                    this.updateExerciseDefinitionJson();
                },

                // Function to toggle tags (add or remove)
                toggleTag(tag) {
                    if (this.selectedTags.includes(tag)) {
                        this.selectedTags = this.selectedTags.filter(t => t !== tag);
                    } else {
                        this.selectedTags.push(tag);
                    }
                    this.updateExerciseDefinitionJson();
                },
                // Function to get the appropriate class for a tag
                getTagClass(tag) {
                    return this.selectedTags.includes(tag)
                        ? 'bg-blue-500 text-white'  // Selected tag
                        : 'bg-gray-200 text-gray-700';  // Unselected tag
                },

                updateExerciseDefinitionJson() {
                    // Auto-calculate pace if possible
                    if (this.duration && this.distance) {
                        this.calculatedPace = this.calculatePace(this.duration, this.distance);
                    } else {
                        this.calculatedPace = '';
                    }

                    // Update JSON
                    this.exerciseDefinitionJson = JSON.stringify({
                        duration: this.duration,
                        distance: this.distance,
                        targetHrZone: this.targetHrZone,
                        tags: this.selectedTags,
                        notes: this.notes
                    });
                },

                calculatePace(time, distance) {
                    if (!time || !distance || distance == 0) return '';

                    let [hh, mm] = time.split(':').map(Number);
                    let totalMinutes = hh * 60 + mm;
                    let pace = totalMinutes / distance;

                    let paceMinutes = Math.floor(pace);
                    let paceSeconds = Math.round((pace - paceMinutes) * 60);

                    return `${paceMinutes}:${paceSeconds.toString().padStart(2, '0')} min/km`;
                }
            };
        }
    </script>
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