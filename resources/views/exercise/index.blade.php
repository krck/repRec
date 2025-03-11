<x-app-layout>
    <x-slot:heading>
        Exercises
    </x-slot:heading>

    <!-- Slot Content: This is the part that scrolls (Accordion with Tables) -->
    <div class="slot-content">
        <div class="w-full join join-vertical bg-base-100">
            @foreach($exerciseGroups as $exerciseGroup)
                <div class="collapse collapse-arrow join-item border-base-300 border">
                    <input type="checkbox" />
                    <div class="collapse-title font-semibold">{{ $exerciseGroup["name"] }}</div>
                    <div class="collapse-content text-sm">
                        <!-- Table with exercise categories -->
                        <table class="table">
                            <tbody>
                                @foreach(collect($exerciseGroup["exercises"])->sortBy('name') as $exercise)
                                    <tr class="hover:bg-base-100">
                                        <td class="w-[70%]">
                                            <div class="my-1">
                                                <div class="font-bold">{{ $exercise->name }}</div>
                                                <div class="text-xs">{{ $exercise->exercise_category->name }}</div>
                                            </div>
                                        </td>
                                        <td class="w-[30%] text-right">
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
            @endforeach
        </div>
    </div>

    <!-- Slot Footer: Sticks to the bottom (with Back and New button) -->
    <div class="slot-footer">
        <div class="flex justify-between items-center m-2 px-4">
            <a href="{{ route('admin.selections') }}" class="btn btn-circle">
                <x-icon img="arrow_back_ios_new" />
            </a>
            <a href="{{ route('exercise.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

    <!-- Delete Modal Dialog -->
    <x-dlg-confirm-delete deleteObjName="Exercise" />

</x-app-layout>