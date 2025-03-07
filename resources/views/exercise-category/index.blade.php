<x-app-layout>
    <x-slot:heading>
        Exercise Categories
    </x-slot:heading>

    <div class="relative">
        <div class="overflow-y-auto overflow-x-hidden h-full">
            <!-- Table with exercise categories -->
            <table class="min-w-full table">
                <tbody>
                    @foreach($exerciseCategories as $exerciseCategory)
                        <tr class="hover:bg-base-300">
                            <td>
                                <div class="my-1">
                                    <div class="font-bold">{{ $exerciseCategory->name }}</div>
                                    <div class="text-xs">{{ $exerciseCategory->description }}</div>
                                </div>
                            </td>
                            <td>
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
    </div>

    <!-- Footer row with Back and New button -->
    <div class="w-full flex justify-between items-center m-2 px-4">
        <a href="{{ route('admin.selections') }}" class="btn btn-circle">
            <x-icon img="arrow_back_ios_new" />
        </a>
        <div></div>
        <a href="{{ route('exercise-category.create') }}" class="btn btn-circle btn-primary">
            <x-icon img="add" />
        </a>
    </div>

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Exercise Category" />

</x-app-layout>