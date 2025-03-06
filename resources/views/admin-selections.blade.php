<x-app-layout>
    <x-slot:heading>
        Admin Selections
    </x-slot:heading>

    <div>
        <ul class="space-y-4">
            @foreach($selections as $selection)
                <li class="p-2 rounded-lg shadow-md hover:shadow-lg hover:bg-gray-100 transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $selection['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $selection['comment'] }}</p>
                        </div>
                        <x-nav-link class="btn btn-square btn-ghost" href="{{ $selection['link'] }}">
                            <x-icon img="arrow_forward_ios" />
                        </x-nav-link>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>