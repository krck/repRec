
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