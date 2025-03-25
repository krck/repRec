<!-- Component Args -->
@props(['name', 'value' => null])

@pushOnce('js_after')
    <script src="/js/components/exercise-input-bodyweight.js"></script>
@endPushOnce

<div class="bg-base-100 shadow-md rounded-md m-1 p-2 border-2 border-solid border-gray-300">
    <div x-data="bodyweightInput({{ $value ? $value : 'null' }})" x-init="init()" class="flex w-full flex-col">
        <!-- Hidden Input to store JSON data -->
        <input type="hidden" id="{{ $name }}" name="{{ $name }}" required value="{{ old($name, $value) }}"
            x-model="exerciseDefinitionJson">
        <!-- DEBUG output the result JSON -->
        <!-- <p x-text="exerciseDefinitionJson" class="text-xs text-gray-500"></p> -->
        @error($name)
            <p class="text-error text-center text-sm">{{ $message }}</p>
        @enderror

        <!-- Warmup Sets -->
        <div class="divider m-[4px]">Warmup</div>
        <div class="mb-2">
            <template x-for="(warmupSet, index) in warmupSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="warmupSet.reps"
                        min="0" max="100">
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
        <div class="divider m-[4px]">Feeder</div>
        <div class="mb-2">
            <template x-for="(feederSet, index) in feederSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="feederSet.reps"
                        min="0" max="100">
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
        <div class="divider m-[4px]">Working</div>
        <div class="mb-2">
            <template x-for="(workingSet, index) in workingSets" :key="index">
                <div class="flex items-center mt-2">
                    <input type="number" class="input input-bordered w-24" placeholder="Reps" x-model="workingSet.reps"
                        min="0" max="100">
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
        <div class="divider m-[4px]">Additional Intensity</div>
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
        <div class="divider m-[4px]">Tags</div>
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