
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