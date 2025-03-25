@props(['name', 'value' => null])

@pushOnce('js_after')
    <script src="/js/components/exercise-input-other.js"></script>
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