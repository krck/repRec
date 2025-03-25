<x-app-layout>
    <x-slot:heading>
        Exercise Categories
    </x-slot:heading>

    @pushOnce('js_after')
    <script src="/js/components/dlg-global.js"></script>
    <script type="module" nonce="{{ $cspNonce }}">
        // Delete buttons with "unique" class for identification - add click event listener here, for CSP
        document.querySelectorAll('.unique-delete-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                var deleteUrl = '{{ route('exercise-category.destroy', ':id') }}'.replace(':id', this.getAttribute('data-id'));
                openDeleteModal(deleteUrl);
            });
        });
    </script>
    @endpushOnce

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        <table class="w-full table">
            <tbody>
                @foreach($exerciseCategories as $exerciseCategory)
                    <tr class="hover:bg-base-100">
                        <td class="w-[60%]">
                            <div class="my-1">
                                <div class="font-bold">{{ $exerciseCategory->name }}</div>
                                <div class="text-xs">{{ $exerciseCategory->description }}</div>
                            </div>
                        </td>
                        <td class="w-[40%] text-right">
                            <div>
                                <!-- Link to Edit -->
                                <a href="{{ route('exercise-category.edit', $exerciseCategory) }}"
                                    class="btn btn-circle btn-ghost">
                                    <x-icon img="edit" />
                                </a>
                                <!-- Delete Button calling modal dialog -->
                                <button type="button" class="btn btn-circle btn-ghost unique-delete-btn"
                                    data-id="{{ $exerciseCategory->id }}">
                                    <x-icon img="delete" class="text-error" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Back and New button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('admin.selections') }}" class="btn btn-circle">
                <x-icon img="arrow_back_ios_new" />
            </a>
            <div></div>
            <a href="{{ route('exercise-category.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Exercise Category" />

</x-app-layout>