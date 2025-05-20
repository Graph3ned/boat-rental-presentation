<div class="min-h-full p-4">
  <div class="w-full rounded-lg relative overflow-hidden">

    

    <!-- Decorative wave elements -->
    <div class="absolute top-0 left-0 right-0 h-1"></div>

    <div class="w-full">
  

    <div class="flex flex-col lg:flex-row lg:space-x-4">
      <!-- Sidebar Section -->
      <div class="w-full lg:w-1/4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-4 ml-4 border border-gray-100 transition-all duration-300 hover:shadow-xl">
          <!-- Card Header -->
          <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-4">
            <div class="flex justify-between items-center">
              <h3 class="text-white text-lg font-semibold tracking-wide">Filter Options</h3>
              <button wire:click="resetFilter" 
                      class="inline-flex items-center px-4 py-1.5 bg-white/20 hover:bg-white/30 active:bg-white/40 rounded-lg 
                             transition-all duration-200 text-white text-sm font-medium backdrop-blur-sm group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-rotate-45 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset
              </button>
            </div>
          </div>

          <!-- Card Body -->
          <div class="p-6 space-y-6">
            <!-- Staff Select -->
            <div class="space-y-2">
              <label class="flex items-center text-gray-700 font-medium text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Staff
              </label>
              <select wire:model.live="selectedUser" 
                      class="w-full text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white hover:bg-gray-50/80
                             focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                <option value="">All Staff</option>
                @foreach ($load->unique('user') as $ride)
                  <option value="{{ $ride->user }}" class="py-2">{{ $ride->user }}</option>
                @endforeach
              </select>
            </div>

            <!-- Ride Type & Classification Group -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Ride Type Select -->
              <div class="space-y-2">
                <label class="flex items-center text-gray-700 font-medium text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                  </svg>
                  Ride Type
                </label>
                <select wire:model.live="selectedRideType" 
                        class="w-full text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white hover:bg-gray-50/80
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                  <option value="">All Types</option>
                  @foreach ($load->unique('rideType') as $ride)
                    <option value="{{ $ride->rideType }}" class="py-2">{{ str_replace('_', ' ', $ride->rideType) }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Classification Select -->
              <div class="space-y-2">
                <label class="flex items-center text-gray-700 font-medium text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                  </svg>
                  Classification
                </label>
                <select wire:model.live="classification" 
                        class="w-full text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white hover:bg-gray-50/80
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                  <option value="">All Classifications</option>
                  @foreach ($load->where('rideType', $selectedRideType)->unique('classification') as $ride)
                    <option value="{{ $ride->classification }}" class="py-2">{{ str_replace('_', ' ', $ride->classification) }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <!-- Date Range Section -->
            <div class="space-y-2">
              <label class="flex items-center text-gray-700 font-medium text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Date Range
              </label>
              <select wire:model.live="dateRange" 
                      class="w-full text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white hover:bg-gray-50/80
                             focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="select_day">Select Day</option>
                <option value="select_month">Select Month</option>
                <option value="this_month" selected>Current Month</option>
                <option value="custom">Custom Date Range</option>
              </select>

              @if($dateRange === 'select_month')
                <div class="mt-4 space-y-4 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                    <div class="space-y-2">
                        <label class="flex items-center text-gray-700 font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select Month
                        </label>
                        <input x-data
                               x-init="flatpickr($el, {
                                   plugins: [new monthSelectPlugin({
                                       shorthand: true,
                                       dateFormat: 'Y-m',
                                       altFormat: 'F Y',
                                       theme: 'material_blue'
                                   })],
                                   dateFormat: 'Y-m',
                                   altInput: true,
                                   altFormat: 'F Y',
                               })"
                               wire:model.live="selected_month" 
                               type="text"
                               placeholder="Select a month..."
                               class="w-full text-sm rounded-lg border-blue-200/50 bg-white/70 
                                      focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 
                                      hover:border-blue-300 hover:bg-white
                                      transition-all duration-200 cursor-pointer">
                    </div>
                </div>
              @endif

              @if($dateRange === 'select_day')
                <div class="mt-4 space-y-4 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                    <div class="space-y-2">
                        <label class="flex items-center text-gray-700 font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select Date
                        </label>
                        <input x-data
                               x-init="flatpickr($el, {
                                   dateFormat: 'Y-m-d',
                                   altInput: true,
                                   altFormat: 'F j, Y',
                                   theme: 'material_blue'
                               })"
                               wire:model.live="selected_day" 
                               type="text"
                               placeholder="Select a date..."
                               class="w-full text-sm rounded-lg border-blue-200/50 bg-white/70 
                                      focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 
                                      hover:border-blue-300 hover:bg-white
                                      transition-all duration-200 cursor-pointer">
                    </div>
                </div>
              @endif

              @if($dateRange === 'custom')
                <div class="mt-4 space-y-4 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                    <div class="space-y-4">
                        <!-- From Date -->
                        <div class="space-y-2">
                            <label class="flex items-center text-gray-700 font-medium text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                From
                            </label>
                            <input x-data
                                   x-init="flatpickr($el, {
                                       dateFormat: 'Y-m-d',
                                       altInput: true,
                                       altFormat: 'F j, Y',
                                       theme: 'material_blue'
                                   })"
                                   wire:model.live="start_date" 
                                   type="text"
                                   placeholder="Select start date..."
                                   class="w-full text-sm rounded-lg border-blue-200/50 bg-white/70 
                                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 
                                          hover:border-blue-300 hover:bg-white
                                          transition-all duration-200 cursor-pointer">
                        </div>

                        <!-- To Date -->
                        <div class="space-y-2">
                            <label class="flex items-center text-gray-700 font-medium text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                To
                            </label>
                            <input x-data
                                   x-init="flatpickr($el, {
                                       dateFormat: 'Y-m-d',
                                       altInput: true,
                                       altFormat: 'F j, Y',
                                       theme: 'material_blue'
                                   })"
                                   wire:model.live="end_date" 
                                   type="text"
                                   placeholder="Select end date..."
                                   class="w-full text-sm rounded-lg border-blue-200/50 bg-white/70 
                                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 
                                          hover:border-blue-300 hover:bg-white
                                          transition-all duration-200 cursor-pointer">
                        </div>
                    </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content Section -->
      <div class="w-full lg:w-3/4 p-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl">
          <!-- Card Header with gradient background -->
          <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
              <!-- Sales Info -->
              <div class="space-y-1">
                <p class="text-white/80 text-sm font-medium">Total Sales</p>
                <h5 class="text-3xl font-bold text-white">₱{{ number_format($totalPrice, 2) }}</h5>
              </div>
              
              <!-- Date Range Control -->
              <div class="space-y-1">
              <!-- <button wire:click="refreshChart" 
                      class="inline-flex items-center px-4 py-1.5 bg-white/20 hover:bg-white/30 active:bg-white/40 rounded-lg 
                             transition-all duration-200 text-white text-sm font-medium backdrop-blur-sm group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-rotate-45 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Refresh Chart
              </button> -->
              </div>
            </div>

            <!-- Percentage change indicator -->
            <!-- <div class="mt-4 flex items-center gap-2 text-white/80">
              <span class="inline-flex items-center text-sm font-medium text-white">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                23% increase
              </span>
              <span class="text-sm">vs previous period</span>
            </div> -->
          </div>

          <!-- Chart Container -->
          <div class="p-6">
            <div class="h-[300px]">
              <canvas id="salesChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ----------------table-------------------- -->
     
    <div class="w-full p-4 mb-4">
      <div class="flex justify-between items-center mb-4">
        <div class="flex items-center space-x-2">
          <label class="flex items-center text-gray-700 font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            Show
          </label>
          <select wire:model.live="paginate" 
                  class="text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white hover:bg-gray-50/80
                         focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="150">150</option>
            <option value="200">200</option>
          </select>
          <span class="text-sm text-gray-600">entries</span>
        </div>
      </div>

      <div class="overflow-x-auto rounded-lg shadow-lg border border-blue-100">
        <div class="max-h-[600px] overflow-y-auto">
          <table class="w-full min-w-max table-auto text-sm">
            <thead class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-semibold sticky top-0 z-10">
              <tr class="border-b border-blue-400">
                <th class="px-4 py-3 text-left">No.</th>
                <th class="px-4 py-3 text-left">Staff</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">Class</th>
                <th class="px-4 py-3 text-left hidden sm:table-cell">Duration</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Jackets</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Start</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">End</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">Date</th>
                <th class="px-4 py-3 text-left hidden lg:table-cell">Note</th>
                <th class="px-4 py-3 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-blue-100">
              @foreach ($rides as $ride)
                <tr class="bg-white hover:bg-blue-50 transition-colors duration-200">
                  <td class="px-4 py-3 text-gray-700">
                    {{ ($rides->total() - ($rides->currentPage() - 1) * $rides->perPage()) - $loop->iteration + 1 }}
                  </td>
                  <td class="px-4 py-3">
                    <div class="text-gray-700">{{ $ride->user }}</div>
                  </td>
                  <td class="px-4 py-3 lg:w-[150px] lg:min-w-[150px]">
                    <div class="text-gray-700 font-medium">{{ str_replace('_', ' ', $ride->rideType) }}</div>
                    <!-- Mobile view details with improved styling -->
                    <div class="lg:hidden space-y-1.5 mt-2">
                        <!-- Classification - matches hidden lg:table-cell -->
                        <div class="text-xs min-w-[150px]">
                            <span class="text-blue-600 font-medium">Class:</span>
                            <span class="text-gray-600">{{ str_replace('_', ' ', $ride->classification) }}</span>
                        </div>
                        
                        <!-- Only show these details when their corresponding columns are hidden -->
                        <div class="space-y-1.5">
                            <!-- Duration - only when duration column is hidden -->
                            <div class="sm:hidden text-xs min-w-[150px]">
                                <span class="text-emerald-600 font-medium">Duration:</span>
                                <span class="text-gray-600">
                                    @if ($ride->duration >= 60)
                                        {{ intdiv($ride->duration, 60) }}hr{{ intdiv($ride->duration, 60) > 1 ? 's' : '' }}
                                        @if ($ride->duration % 60 > 0)
                                            {{ $ride->duration % 60 }}min
                                        @endif
                                    @else
                                        {{ $ride->duration }}min
                                    @endif
                                </span>
                            </div>

                            <!-- Date - matches hidden lg:table-cell and portrait mode -->
                            <div class="lg:hidden portrait:block landscape:hidden text-xs min-w-[150px]">
                                <span class="text-rose-600 font-medium">Date:</span>
                                <span class="text-gray-600">{{ \Carbon\Carbon::parse($ride->created_at)->format('M d, Y') }}</span>
                            </div>

                            <!-- Jackets - matches hidden md:table-cell -->
                            <div class="md:hidden text-xs min-w-[150px]">
                                <span class="text-emerald-600 font-medium">Jackets:</span>
                                <span class="text-gray-600">{{ $ride->life_jacket_usage }}</span>
                            </div>

                            <!-- Time info - matches hidden md:table-cell -->
                            <div class="md:hidden text-xs space-y-1">
                                <div class="flex flex-col min-w-[150px]">
                                    <span class="text-indigo-600 font-medium">Start:</span>
                                    <span class="text-gray-600 ml-4">{{ \Carbon\Carbon::parse($ride->timeStart)->format('h:i A') }}</span>
                                </div>
                                <div class="flex flex-col min-w-[150px]">
                                    <span class="text-indigo-600 font-medium">End:</span>
                                    <span class="text-gray-600 ml-4">{{ \Carbon\Carbon::parse($ride->timeEnd)->format('h:i A') }}</span>
                                </div>
                            </div>

                            <!-- Note - matches hidden lg:table-cell -->
                            <div class="lg:hidden text-xs min-w-[150px]">
                                <span class="text-purple-600 font-medium">Note:</span>
                                <span class="text-gray-600">{{ $ride->note ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-gray-700 hidden lg:table-cell">{{ str_replace('_', ' ', $ride->classification) }}</td>
                  <td class="px-4 py-3 text-gray-700 hidden sm:table-cell">
                    @if ($ride->duration >= 60)
                      {{ intdiv($ride->duration, 60) }}hr{{ intdiv($ride->duration, 60) > 1 ? 's' : '' }}
                      @if ($ride->duration % 60 > 0)
                        {{ $ride->duration % 60 }}min
                      @endif
                    @else
                      {{ $ride->duration }}min
                    @endif
                  </td>
                  <td class="px-4 py-3 text-gray-700 text-center hidden md:table-cell">{{ $ride->life_jacket_usage }}</td>
                  <td class="px-4 py-3 text-gray-700">₱{{ number_format($ride->totalPrice, 2) }}</td>
                  <td class="px-4 py-3 text-gray-700 hidden md:table-cell">{{ \Carbon\Carbon::parse($ride->timeStart)->format('h:i A') }}</td>
                  <td class="px-4 py-3 text-gray-700 hidden md:table-cell">{{ \Carbon\Carbon::parse($ride->timeEnd)->format('h:i A') }}</td>
                  <td class="px-4 py-3 text-gray-700 hidden lg:table-cell">{{ \Carbon\Carbon::parse($ride->created_at)->format('M d, Y') }}</td>
                  <td class="px-4 py-3 text-gray-700 hidden lg:table-cell">{{ $ride->note ?? '-' }}</td>
                  <td class="px-4 py-3 text-center">
                    <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                      <button wire:click="editSale({{ $ride->id }})" 
                              class="transition-all duration-200 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg">
                        Edit
                      </button>
                      <button wire:click="confirmDelete({{ $ride->id }})" 
                              class="transition-all duration-200 bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg">
                        Delete
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- Delete Confirmation Modal -->
      @if ($showModal)
      <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 items-center justify-center z-50">
    <div class="flex justify-center items-center w-full h-full">
      <div class="w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg shadow-lg">
          <div class="p-6">
            <div class="mb-4">
              <h3 class="text-xl font-bold text-gray-900">Confirm Delete</h3>
              <p class="mt-2 text-gray-600">Are you sure you want to delete this ride? This action cannot be undone.</p>
            </div>
            <div class="flex space-x-3">
              <button id="cancelDelete" type="button" wire:click="closeModal"
                class="w-full bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-medium
                       transform transition-all duration-200 hover:-translate-y-1 
                       hover:shadow-md hover:bg-gray-300">
                Cancel
              </button>
              <button id="confirmDelete" type="button" wire:click="deleteRide"
                class="w-full bg-red-500 text-white px-4 py-2 rounded-lg font-medium
                       transform transition-all duration-200 hover:-translate-y-1 
                       hover:shadow-md hover:bg-red-600">
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        @endif
      <!-- Pagination -->
      @if(count($rides))
        <div class="mt-6">
          {{ $rides->links('livewire.livewire-pagination-links') }}
        </div>
      @endif
    </div>
  </div>
</div>
<script>
let chartInstance = null;

document.addEventListener('livewire:initialized', function () {
    initChart();
});

document.addEventListener('livewire:navigated', function () {
    initChart();
});

document.addEventListener('livewire:update', function () {
    initChart();
});

Livewire.on('updateChart', () => {
    initChart();
});

function initChart() {
    if (chartInstance) {
        chartInstance.destroy();
    }

    const ctx = document.getElementById('salesChart');
    if (!ctx) return;

    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @php
                    $dailyTotals = $this->getAllRidesForChart()
                        ->groupBy(function($ride) {
                            return \Carbon\Carbon::parse($ride->created_at)->format('Y-m-d');
                        })
                        ->map(function($group) {
                            return $group->sum('totalPrice');
                        })
                        ->sortKeys();
                    $dailyTotals = $dailyTotals->mapWithKeys(function($total, $date) {
                        return [\Carbon\Carbon::parse($date)->format('M d, Y') => $total];
                    });
                @endphp
                @foreach($dailyTotals as $date => $total)
                    '{{ $date }}',
                @endforeach
            ],
            datasets: [{
                label: 'Daily Sales',
                data: [
                    @foreach($dailyTotals as $total)
                        {{ $total }},
                    @endforeach
                ],
                borderWidth: 3,
                borderColor: '#1A56DB',
                backgroundColor: (context) => {
                    const chart = context.chart;
                    const { ctx, chartArea } = chart;
                    if (!chartArea) return null;
                    
                    const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                    gradient.addColorStop(0, 'rgba(26, 86, 219, 0.4)');
                    gradient.addColorStop(1, 'rgba(26, 86, 219, 0)');
                    return gradient;
                },
                fill: true,
                tension: 0.4,
                pointRadius: 0, // Hide points by default
                pointHoverRadius: 6, // Point size on hover
                pointHoverBackgroundColor: '#ffffff', // White center
                pointHoverBorderColor: '#1A56DB', // Blue border
                pointHoverBorderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#1f2937',
                    bodyFont: {
                        size: 13,
                        family: 'Inter, sans-serif',
                    },
                    titleFont: {
                        size: 13,
                        family: 'Inter, sans-serif',
                        weight: '600',
                    },
                    padding: 12,
                    boxPadding: 6,
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return '₱' + context.parsed.y.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawTicks: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString('en-US');
                        },
                        font: {
                            family: "Inter, sans-serif",
                            size: 11,
                            weight: '500'
                        },
                        color: '#6B7280',
                        padding: 10
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: "Inter, sans-serif",
                            size: 11,
                            weight: '500'
                        },
                        color: '#6B7280',
                        maxRotation: 0,
                        padding: 10
                    },
                    border: {
                        display: false
                    }
                }
            },
            hover: {
                mode: 'index',
                intersect: false
            },
            elements: {
                line: {
                    borderJoinStyle: 'round'
                }
            }
        },
        plugins: [{
            id: 'hoverLine',
            beforeDraw: function(chart) {
                if (chart.tooltip._active && chart.tooltip._active.length) {
                    const activePoint = chart.tooltip._active[0];
                    const { ctx } = chart;
                    const { x } = activePoint.element;
                    const topY = chart.scales.y.top;
                    const bottomY = chart.scales.y.bottom;

                    ctx.save();
                    ctx.beginPath();
                    ctx.moveTo(x, topY);
                    ctx.lineTo(x, bottomY);
                    ctx.lineWidth = 1;
                    ctx.strokeStyle = 'rgba(0, 0, 0, 0.1)';
                    ctx.stroke();
                    ctx.restore();
                }
            }
        }]
    });
}

window.addEventListener('resize', function() {
    initChart();
});
document.addEventListener('livewire:initialized', () => {
    Livewire.on('refreshPage', () => {
        location.reload();
    });
});
</script>

<!-- Edit Sale Modal -->
@if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Background overlay with click handler -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 wire:click="closeEditModal"></div>

            <!-- Modal panel -->
            <div class="relative bg-white rounded-lg shadow-xl transform transition-all w-full max-w-lg">
                @livewire('sales-edit', ['rideId' => $editingRideId])
            </div>
        </div>
    </div>
@endif


