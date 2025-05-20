<div class="relative flex flex-col w-full h-full text-slate-300 shadow-md rounded-lg bg-clip-border overflow-x-auto">

    <div class="flex flex-wrap justify-between items-center mx-6 mt-6">
        <div class="flex flex-col mb-4 sm:mb-0">
            <label for="date_range" class="text-black block mb-1">Date:</label>
            <!-- <select wire:model.live="date_range" name="date_range" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <option value="">All</option>     
                <option value="today">Today</option>    
                <option value="yesterday">Yesterday</option>
                <option value="this_week">This Week</option>
                <option value="last_week">Last Week</option>
                <option value="this_month">This Month</option>
                <option value="last_month">Last Month</option>
                <option value="last_year">Last Year</option>
            </select> -->
            <input type="date" wire:model.live="start_date" />
            <input type="date" wire:model.live="end_date" />

        </div>  
        <div class="ml-auto">
            <span class="text-lg font-semibold text-black dark:text-gray-200">Total Price: ₱{{ number_format($totalPrice, 2) }}</span>
        </div>

    </div>

    <div class="mx-6 mt-3">

        <div class="flex flex-wrap items-center mb-4 justify-between">
        <div>
            <div class="flex flex-col mb-4 sm:mb-0">
                <label for="pagination" class="text-black block mb-1">Paginate:</label>
                <select wire:model.live="paginate" name="pagination" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>  
            </div>          
            
            <div>
                <div class="flex justify-center mx-6 mt-3">
                    <h1 class="text-black mb-3">Filter</h1>
                </div>

                

                <div class="flex ml-auto space-x-4">
                
                    <div class="flex flex-col mb-4 sm:mb-0">
                        <label for="search" class="text-black block mb-1">Staff:</label>
                        <select data-column="1" wire:model.live="selectedUser" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <option value="">All</option>
                            @foreach ($load->unique('user') as $ride)
                                <option value="{{ $ride->user }}">{{ $ride->user }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="flex flex-col mb-4 sm:mb-0">
                        <label for="rideType" class="text-black block mb-1">Ride Type:</label>
                        <select data-column="3" wire:model.live="selectedRideType" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <option value="">All</option>
                            @foreach ($load->unique('rideType') as $ride)
                                <option value="{{ $ride->rideType }}">{{ $ride->rideType }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Classification Label and Dropdown -->
                    <div class="flex flex-col mb-4 sm:mb-0">
                        <label for="classification" class="text-black block mb-1">Classification:</label>
                        <select data-column="4" wire:model.live="classification" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <option value="">All</option>
                            @foreach ($load->where('rideType', $selectedRideType)->unique('classification') as $ride)
                                <option value="{{ $ride->classification }}">{{ $ride->classification }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="flex justify-center mt-3">
                <button wire:click="resetFilter" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mb-2 sm:mb-0">
                    Reset Filter
                </button>
                </div>
            </div>
        </div>
    </div>




    <!-- Table Container with Horizontal Scroll Only -->
    <div class="overflow-x-auto"> <!-- Removed vertical overflow control -->
        <table class="text-xs text-gray-500 dark:text-gray-400 mx-6 mb-6 border border-slate-600">
            <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-left uppercase">
                <tr>
                    <th class="p-4 border-b border-slate-600 bg-slate-700 text-center">
                        <p class="text-sm font-normal leading-none text-white">Number</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Staff</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">ID</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Ride Type</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Classification</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Life Jacket</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Duration</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Price</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Time Started</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Time End</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white">Date Created</p>
                    </th>
                    <th class="p-2 border-b border-slate-600 bg-slate-700">
                        <p class="text-sm font-normal leading-none text-white text-center">Action</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rides as $ride)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border border-slate-600 text-gray-500">
                    <td class="px-2 py-2 text-center">{{ ($rides->total() - ($rides->currentPage() - 1) * $rides->perPage()) - $loop->iteration + 1 }}</td>

                        <td class="px-2 py-2">{{ $ride->user }}</td>
                        <td class="px-2 py-2">{{ $ride->id }}</td>
                        <td class="px-2 py-2 rideType">{{ str_replace('_', ' ', $ride->rideType) }}</td>
                        <td class="px-2 py-2 classification">
                            {{ str_replace('_', ' ', $ride->classification) }}
                        </td>
                        <td class="px-3 py-2">{{ $ride->life_jacket_usage }}</td>
                        <td class="px-2 py-2">
                            @if ($ride->duration >= 60)
                                {{ intdiv($ride->duration, 60) }} hr{{ intdiv($ride->duration, 60) > 1 ? 's' : '' }} 
                                @if ($ride->duration % 60 > 0)
                                    {{ $ride->duration % 60 }} min
                                @endif
                            @else
                                {{ $ride->duration }} min
                            @endif
                        </td>
                        <td class="px-2 py-2">{{ $ride->totalPrice }}</td>
                        <td class="px-2 py-2">{{ \Carbon\Carbon::parse($ride->timeStart)->format('h:i A') }}</td>
                        <td class="px-2 py-2 timeEnd">{{ \Carbon\Carbon::parse($ride->timeEnd)->format('h:i A') }}</td>
                        <td class="px-2 py-2">{{ $ride->created_at }}</td>

                        <td class="px-2 py-2 text-center">
                            <div class="inline-flex space-x-2">
                                <button wire:navigate href="/admin/{{$ride->id}}/sales-edit" type="button" 
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-20">
                                    Edit
                                </button>

                                <button wire:click="confirmDelete({{ $ride->id }})" type="button" 
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 w-20">
                                    Delete
                                </button>

                                @if ($showModal)
                                    <div class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center transition-opacity duration-300 ease-in-out opacity-100">
                                        <div class="bg-white rounded-md shadow-md p-6 max-w-md transition-all transform duration-300 ease-in-out">
                                            <div class="text-center">
                                                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">{{ $modalDetails }}</h3>
                                                <button wire:click="deleteRide" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base px-3 py-2.5 mr-2">
                                                    Yes, I'm sure
                                                </button>
                                                <button wire:click="closeModal" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium rounded-lg text-base px-3 py-2.5">
                                                    No, cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(count($rides))
        {{ $rides->links('livewire.livewire-pagination-links') }}
    @endif
</div>

<script>
    Livewire.on('refreshPage', () => {
        location.reload();
    });
</script>