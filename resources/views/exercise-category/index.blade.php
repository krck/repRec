<x-app-layout>
    <x-slot:heading>
        Exercise Categories
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Table element) -->
    <div class="slot-content">
        <table class="w-full table">
            <tbody>
                @foreach($exerciseCategories as $exerciseCategory)
                    <tr class="hover:bg-base-100">
                        <td class="w-[70%]">
                            <div class="my-1">
                                <div class="font-bold">{{ $exerciseCategory->name }}</div>
                                <div class="text-xs">{{ $exerciseCategory->description }}</div>
                            </div>
                        </td>
                        <td class="w-[30%] text-right">
                            <div>
                                <!-- Link to Edit -->
                                <a href="{{ route('exercise-category.edit', $exerciseCategory) }}"
                                    class="btn btn-circle btn-ghost">
                                    <x-icon img="edit" />
                                </a>
                                <!-- Delete Button calling modal dialog -->
                                <button type="button" class="btn btn-circle btn-ghost"
                                    onclick="openDeleteModal('{{ route('exercise-category.destroy', $exerciseCategory->id) }}')">
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