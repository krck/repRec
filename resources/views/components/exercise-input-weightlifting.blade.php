<!-- Component Args -->
@props(['name'])

@pushOnce('js_after')
    <script>
        function weightliftingInput() {
            return {
                // Generate a json result string based on the inputs
                // - Update called manually on button presses - add/remove
                // - Update called automatically on input changes - watch
                exerciseDefinitionJson: '',
                init() {
                    this.$watch('warmupSets', () => this.updateExerciseDefinitionJson());
                    this.$watch('feederSets', () => this.updateExerciseDefinitionJson());
                    this.$watch('workingSets', () => this.updateExerciseDefinitionJson());
                    this.$watch('intensitySets', () => this.updateExerciseDefinitionJson());
                    this.$watch('selectedTags', () => this.updateExerciseDefinitionJson());
                    this.$watch('fixedType', () => this.updateExerciseDefinitionJson());
                    // Generate an empty string on init
                    this.updateExerciseDefinitionJson();
                },
                updateExerciseDefinitionJson() {
                    this.exerciseDefinitionJson = JSON.stringify({
                        warmupSets: this.warmupSets,
                        feederSets: this.feederSets,
                        workingSets: this.workingSets,
                        intensitySets: this.intensitySets,
                        tags: this.selectedTags
                    });
                },

                fixedType: 'reps',
                warmupSets: [],
                feederSets: [],
                workingSets: [],
                intensitySets: [],
                // Array to hold selected tags
                selectedTags: [],
                availableTags: [
                    'Strength',
                    'Hypertrophy',
                    'Endurance',
                    'md:Activation',
                    'md:Explosion',
                    'md:Pump',
                    'md:Stretch',
                ],

                // Function to toggle tags (add or remove)
                toggleTag(tag) {
                    if (this.selectedTags.includes(tag)) {
                        this.selectedTags = this.selectedTags.filter(t => t !== tag);
                    } else {
                        this.selectedTags.push(tag);
                    }
                    updateExerciseDefinitionJson();
                },
                // Function to get the appropriate class for a tag
                getTagClass(tag) {
                    return this.selectedTags.includes(tag)
                        ? 'bg-blue-500 text-white'  // Selected tag
                        : 'bg-gray-200 text-gray-700';  // Unselected tag
                },

                // Warmup Set
                addWarmupSet() {
                    if (this.warmupSets.length < 5) {
                        this.warmupSets.push({
                            reps: 15, // Default Reps value
                            weight: '',
                            rpe_rir: 'rpe',
                            rpe_rir_value: 7
                        });
                        updateExerciseDefinitionJson();
                    }
                },
                removeWarmupSet(index) {
                    this.warmupSets.splice(index, 1);
                    updateExerciseDefinitionJson();
                },

                // Feeder Set
                addFeederSet() {
                    if (this.feederSets.length < 3) {
                        this.feederSets.push({
                            reps: 10, // Default Reps value
                            weight: '',
                            rpe_rir: 'rpe',
                            rpe_rir_value: 8
                        });
                        updateExerciseDefinitionJson();
                    }
                },
                removeFeederSet(index) {
                    this.feederSets.splice(index, 1);
                    updateExerciseDefinitionJson();
                },

                // Working Set
                addWorkingSet() {
                    if (this.workingSets.length < 5) {
                        this.workingSets.push({
                            reps: 10, // Default Reps value
                            weight: '',
                            rpe_rir: 'rpe',
                            rpe_rir_value: 10
                        });
                        updateExerciseDefinitionJson();
                    }
                },
                removeWorkingSet(index) {
                    this.workingSets.splice(index, 1);
                    updateExerciseDefinitionJson();
                },

                // Intensity Set
                addIntensitySet() {
                    if (this.intensitySets.length < 3) {
                        this.intensitySets.push({
                            reps: '',
                            weight: '',
                            intensity_type: 'dropset', // Default intensity technique
                        });
                        updateExerciseDefinitionJson();
                    }
                },
                removeIntensitySet(index) {
                    this.intensitySets.splice(index, 1);
                    updateExerciseDefinitionJson();
                },

            };
        }
    </script>
@endPushOnce

<div class="bg-base-100 shadow-md rounded-md m-1 p-2 border-2 border-solid border-gray-300">
    <div x-data="weightliftingInput()" x-init="init()" class="flex w-full flex-col">
        <!-- Hidden Input to store JSON data -->
        <input type="hidden" id="{{ $name }}" name="{{ $name }}" required x-model="exerciseDefinitionJson">
        <!-- DEBUG output the result JSON -->
        <!-- <p x-text="exerciseDefinitionJson" class="text-xs text-gray-500"></p> -->
        @error($name)
            <p class="text-error text-center text-sm">{{ $message }}</p>
        @enderror

        <!-- Fixed Reps / Fixed Weight Toggle -->
        <div class="mb-2 flex justify-center">
            <div class="flex space-x-4 mt-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="radio" x-model="fixedType" value="reps" class="radio radio-primary">
                    <span>Fixed Reps</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="radio" x-model="fixedType" value="weight" class="radio radio-primary">
                    <span>Fixed Weight</span>
                </label>
            </div>
        </div>

        <!-- Warmup Sets -->
        <div class="divider" style="margin: 4px !important;">Warmup</div>
        <div class="mb-2">
            <template x-for="(warmupSet, index) in warmupSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="warmupSet.reps"
                        x-bind:disabled="fixedType === 'weight'" min="0" max="100">
                    <input type="number" class="input input-bordered w-24 ml-1" placeholder="Weight"
                        x-model="warmupSet.weight" x-bind:disabled="fixedType === 'reps'" min="0" max="1000">
                    <select x-model="warmupSet.rpe_rir" class="select w-24 ml-4 select-bordered">
                        <option value="rpe">RPE</option>
                        <option value="rir">RiR</option>
                    </select>
                    <input type="number" class="input input-bordered w-20 ml-1 mr-4" placeholder="1-10"
                        x-model="warmupSet.rpe_rir_value" min="1" max="10">
                    <button type="button" @click="removeWarmupSet(index)" class="btn btn-error btn-sm">X</button>
                </div>
            </template>

            <button type="button" @click="addWarmupSet()" class="mt-2 btn btn-success btn-sm"
                x-show="warmupSets.length < 5">+
            </button>
        </div>

        <!-- Feeder Sets -->
        <div class="divider" style="margin: 4px !important;">Feeder</div>
        <div class="mb-2">
            <template x-for="(feederSet, index) in feederSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="feederSet.reps"
                        x-bind:disabled="fixedType === 'weight'" min="0" max="100">
                    <input type="number" class="input input-bordered w-24 ml-1" placeholder="Weight"
                        x-model="feederSet.weight" x-bind:disabled="fixedType === 'reps'" min="0" max="1000">
                    <select x-model="feederSet.rpe_rir" class="select w-24 ml-4 select-bordered">
                        <option value="rpe">RPE</option>
                        <option value="rir">RiR</option>
                    </select>
                    <input type="number" class="input input-bordered w-20 ml-1 mr-4" placeholder="1-10"
                        x-model="feederSet.rpe_rir_value" min="1" max="10">
                    <button type="button" @click="removeFeederSet(index)" class="btn btn-error btn-sm">X</button>
                </div>
            </template>

            <button type="button" @click="addFeederSet()" class="mt-2 btn btn-success btn-sm"
                x-show="feederSets.length < 3">+
            </button>
        </div>

        <!-- Working Sets -->
        <div class="divider" style="margin: 4px !important;">Working</div>
        <div class="mb-2">
            <template x-for="(workingSet, index) in workingSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="workingSet.reps"
                        x-bind:disabled="fixedType === 'weight'" min="0" max="100">
                    <input type="number" class="input input-bordered w-24 ml-1" placeholder="Weight"
                        x-model="workingSet.weight" x-bind:disabled="fixedType === 'reps'" min="0" max="1000">
                    <select x-model="workingSet.rpe_rir" class="select w-24 ml-4 select-bordered">
                        <option value="rpe">RPE</option>
                        <option value="rir">RiR</option>
                    </select>
                    <input type="number" class="input input-bordered w-20 ml-1 mr-4" placeholder="1-10"
                        x-model="workingSet.rpe_rir_value" min="1" max="10">
                    <button type="button" @click="removeWorkingSet(index)" class="btn btn-error btn-sm">X</button>
                </div>
            </template>

            <button type="button" @click="addWorkingSet()" class="mt-2 btn btn-success btn-sm"
                x-show="workingSets.length < 5">+
            </button>
        </div>

        <!-- Additional Intensity -->
        <div class="divider" style="margin: 4px !important;">Additional Intensity</div>
        <div class="mb-2">
            <template x-for="(intensitySet, index) in intensitySets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps"
                        x-model="intensitySet.reps" min="0" max="100">
                    <input type="number" class="input input-bordered w-24 ml-1" placeholder="Weight"
                        x-model="intensitySet.weight" min="0" max="1000">
                    <select x-model="intensitySet.intensity_type" class="select w-48 ml-4 mr-4 select-bordered">
                        <option value="dropset">Dropset</option>
                        <option value="myo_rep">Myo-Rep Set</option>
                        <option value="myo_match">Myo-Rep Match</option>
                        <option value="rest_pause">Rest-Pause Set</option>
                        <option value="part_rep">Partial-Rep Set</option>
                    </select>
                    <button type="button" @click="removeIntensitySet(index)" class="btn btn-error btn-sm">X</button>
                </div>
            </template>

            <button type="button" @click="addIntensitySet()" class="mt-2 btn btn-success btn-sm"
                x-show="intensitySets.length < 3">+
            </button>
        </div>

        <!-- Tags -->
        <div class="divider" style="margin: 4px !important;">Tags</div>
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