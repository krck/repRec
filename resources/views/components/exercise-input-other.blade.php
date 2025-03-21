@props(['name', 'value' => null])

@pushOnce('js_after')
    <script>
        function otherInput(initialData = null) {
            return {
                trackingStat: '',
                selectedTags: [],
                notes: '',
                // Result string json
                exerciseDefinitionJson: '',
                // Hardcoded Tags
                availableTags: [
                    "Mobility & Flexibility",
                    "Balance & Stability",
                    "Body Control",
                    "Breathwork",
                    "Mind-Body Connection",
                    "Outdoor Adventure",
                    "Recovery & Relaxation",
                    "Functional Movement",
                    "Low-Impact Training",
                    "Play & Agility"
                ],

                // Generate a json result string based on the inputs
                // - Update called manually on button presses - add/remove
                // - Update called automatically on input changes - watch
                init() {
                    if (initialData) {
                        let editData = typeof initialData === 'string' ? JSON.parse(initialData) : initialData;
                        this.trackingStat = editData.trackingStat || '';
                        this.selectedTags = editData.tags || [];
                        this.notes = editData.notes || '';
                    }
                    this.$watch('trackingStat', () => this.updateExerciseDefinitionJson());
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
                    this.exerciseDefinitionJson = JSON.stringify({
                        trackingStat: this.trackingStat,
                        tags: this.selectedTags,
                        notes: this.notes
                    });
                },
            };
        }
    </script>
@endPushOnce

<div class="bg-base-100 shadow-md rounded-md m-1 p-2 border-2 border-solid border-gray-300">
    <div x-data="otherInput({{ $value ? $value : 'null' }})" class="flex w-full flex-col">
        <!-- Hidden Input to store JSON data -->
        <input type="hidden" id="{{ $name }}" name="{{ $name }}" x-model="exerciseDefinitionJson" required>
        @error($name)
            <p class="text-error text-center text-sm">{{ $message }}</p>
        @enderror

        <!-- Important Tracking Stat -->
        <label class="mt-2">Important Tracking Stat</label>
        <input type="text" class="input input-bordered w-full" x-model="trackingStat">

        <!-- Notes -->
        <label class="mt-2">Notes</label>
        <textarea class="textarea textarea-bordered w-full" x-model="notes"></textarea>

        <!-- Activity Tags -->
        <label class="mt-2">Activity Type</label>
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