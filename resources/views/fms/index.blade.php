<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('File Management') }}

            <div class="flex justify-center items-center float-right">
                <a href="javascript:;" id="toggle"
                   class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
                   title="Members List">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span class="hidden md:inline-block ml-2" style="font-size: 14px;">Search Filters</span>
                </a>

            </div>
        </h2>


    </x-slot>
    <div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8" style="display: none;" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">
            <form action="">

                <div class="grid grid-cols-2 gap-4">
                    <label for="telephone" class="block text-gray-700 font-bold mb-2">Telephone:</label>
                    <input type="text" name="filter[telephone]" id="telephone" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Enter telephone number">

                    <label for="exchange" class="block text-gray-700 font-bold mb-2">Exchange:</label>
                    <input type="text" name="filter[exchange_name]" id="exchange" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Enter exchange name">

                    <label for="type" class="block text-gray-700 font-bold mb-2">Select an option:</label>
                        <select id="type" name="filter[type]" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>None</option>
                            <option value="sphone_snet_br">SPHONE/SNET Br</option>
                            <option value="sfiber_br">SFIBER Br</option>
                            <option value="revenue_br">REVENUE Br</option>
                            <option value="recovery_br">RECOVERY Br</option>
                        </select>

                    <div class="col-span-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                            Search
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                @if (session('status'))
                    <div class="mb-4 mt-4 mr-4 ml-4 text-center font-bold text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-solid border-gray-200">
                            Sr.No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-solid border-gray-200">
                            Telephone No
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-solid border-gray-200">
                            Type
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-solid border-gray-200">
                            Exchange
                        </th>
                        <th scope="col"
                            class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-solid border-gray-200">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($fms as $document)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border-solid border-gray-200">
                                {{ (($fms->currentPage() - 1) * $fms->perPage()) + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-solid border-gray-200">{{$document->telephone}}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-solid border-gray-200">
                                @if($document->type == "sphone_snet_br")
                                    SPHONE/SNET Br
                                @elseif($document->type == "sfiber_br")
                                    SFIBER Br
                                @elseif($document->type == "revenue_br")
                                    REVENUE Br
                                @elseif($document->type == "recovery_br")
                                    RECOVERY Br
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-solid border-gray-200">{{$document->exchange_name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-solid border-gray-200 text-center">
                                {{--                                <button onclick="if(confirm('Are you sure you want to delete this item?')){alert('Item deleted.');}else{return false;}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Delete</button>--}}
                                <a href="{{route('fms.show', $document->id)}}"
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">View
                                    Documents</a>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>


            </div>
            <br>
            {{ $fms->links() }}
        </div>
    </div>
    @push('modals')
        <script>
            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };
        </script>
    @endpush
</x-app-layout>
