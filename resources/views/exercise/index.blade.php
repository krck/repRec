<x-app-layout>
    <x-slot:heading>
        Exercises
    </x-slot:heading>

    <div class="relative">
        <div class="join join-vertical bg-base-100">
            @foreach($exerciseGroups as $exerciseGroup)
                <div class="collapse collapse-arrow join-item border-base-300 border">
                    <input type="checkbox" />
                    <div class="collapse-title font-semibold">{{ $exerciseGroup["name"] }}</div>
                    <div class="collapse-content text-sm">
                        <div class="overflow-y-auto overflow-x-hidden h-full">
                            <!-- Table with exercise categories -->
                            <table class="min-w-full table">
                                <tbody>
                                    @foreach($exerciseGroup["exercises"] as $exercise)
                                        <tr class="hover:bg-base-300">
                                            <td>
                                                <div class="my-1">
                                                    <div class="font-bold">{{ $exercise->name }}</div>
                                                    <div class="text-xs">{{ $exercise->exercise_category->name }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <!-- Link to Edit -->
                                                    <a href="{{ route('exercise.edit', $exercise) }}"
                                                        class="btn btn-circle btn-ghost">
                                                        <x-icon img="edit" />
                                                    </a>
                                                    <!-- Delete Button calling modal dialog -->
                                                    <button type="button" class="btn btn-circle btn-ghost"
                                                        onclick="openDeleteModal('{{ route('exercise.destroy', $exercise->id) }}')">
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
                </div>
            @endforeach
        </div>

        <!-- Footer row with Back and New button -->
        <div class="w-full flex justify-between items-center m-2 px-4">
            <a href="{{ route('admin.selections') }}" class="btn btn-circle">
                <x-icon img="arrow_back_ios_new" />
            </a>
            <div></div>
            <a href="{{ route('exercise.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Exercise" />

</x-app-layout>