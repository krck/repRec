
function bodyweightInput(initialData = null) {
    return {
        warmupSets: [],
        feederSets: [],
        workingSets: [],
        intensitySets: [],
        selectedTags: [],
        // Result string json
        exerciseDefinitionJson: '',
        // Hardcoded Tags
        availableTags: ['Strength', 'Hypertrophy', 'Endurance',],

        // Generate a json result string based on the inputs
        // - Update called manually on button presses - add/remove
        // - Update called automatically on input changes - watch
        init() {
            // In case its "edit" and there is initial data - prefill the values
            if (initialData) {
                // If string - parse it, else use the object
                let editData = typeof initialData === 'string' ? JSON.parse(initialData) : initialData;
                this.warmupSets = editData.warmupSets || [];
                this.feederSets = editData.feederSets || [];
                this.workingSets = editData.workingSets || [];
                this.intensitySets = editData.intensitySets || [];
                this.selectedTags = editData.tags || [];
            }
            this.$watch('warmupSets', () => this.updateExerciseDefinitionJson());
            this.$watch('feederSets', () => this.updateExerciseDefinitionJson());
            this.$watch('workingSets', () => this.updateExerciseDefinitionJson());
            this.$watch('intensitySets', () => this.updateExerciseDefinitionJson());
            this.$watch('selectedTags', () => this.updateExerciseDefinitionJson());
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

        // Warmup Set
        addWarmupSet() {
            if (this.warmupSets.length < 5) {
                this.warmupSets.push({
                    reps: 15, // Default Reps value
                    weight: '',
                    rpe_rir: 'rpe',
                    rpe_rir_value: 7
                });
                this.updateExerciseDefinitionJson();
            }
        },
        removeWarmupSet(index) {
            this.warmupSets.splice(index, 1);
            this.updateExerciseDefinitionJson();
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
                this.updateExerciseDefinitionJson();
            }
        },
        removeFeederSet(index) {
            this.feederSets.splice(index, 1);
            this.updateExerciseDefinitionJson();
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
                this.updateExerciseDefinitionJson();
            }
        },
        removeWorkingSet(index) {
            this.workingSets.splice(index, 1);
            this.updateExerciseDefinitionJson();
        },

        // Intensity Set
        addIntensitySet() {
            if (this.intensitySets.length < 3) {
                this.intensitySets.push({
                    reps: '',
                    weight: '',
                    intensity_type: 'dropset', // Default intensity technique
                });
                this.updateExerciseDefinitionJson();
            }
        },
        removeIntensitySet(index) {
            this.intensitySets.splice(index, 1);
            this.updateExerciseDefinitionJson();
        }
    };
}