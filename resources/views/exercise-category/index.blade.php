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
                                    <!-- Delete form (Post - Method hint: DELETE) -->
                                    <form method="POST" action="{{ route('exercise-category.destroy', $exerciseCategory) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-circle btn-ghost">
                                            <x-icon img="delete" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer row with New button -->
        <div class="w-full flex justify-between items-center m-2 px-4">
            <div></div>
            <a href="{{ route('exercise-category.create') }}" class="btn btn-circle btn-primary">
                <x-icon img="add" />
            </a>
        </div>
    </div>

</x-app-layout>