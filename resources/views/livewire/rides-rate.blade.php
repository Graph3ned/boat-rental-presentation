<div class="min-h-full p-4">
  <div class="w-full rounded-lg relative overflow-hidden">
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-xl mb-6">
      <div class="bg-gradient-to-r from-cyan-500 to-blue-600 p-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <h2 class="text-2xl font-bold text-white">Ride Types</h2>
          <button wire:navigate href="/admin/create" 
                  class="inline-flex items-center px-6 py-2.5 bg-white/20 hover:bg-white/30 active:bg-white/40 
                         rounded-lg transition-all duration-200 text-white text-sm font-medium backdrop-blur-sm group">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Add New Ride
          </button>
        </div>
      

      <!-- Price Cards Grid -->
      <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @foreach ($prices->reverse()->unique('ride_type') as $price)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 
                        transition-all duration-300 hover:-translate-y-1 hover:shadow-xl group">
              <div class="p-6">

                <div class="flex justify-between items-center gap-4">
                  <h3 class="text-lg font-semibold text-gray-800">
                    {{ str_replace('_', ' ', $price->ride_type) }}
                  </h3>

                  <button wire:navigate href="/admin/view-details/{{$price->ride_type}}" 
                          class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 
                                 hover:from-cyan-600 hover:to-blue-700 rounded-lg transition-all duration-200 
                                 text-white text-sm font-medium shadow-md hover:shadow-lg">
                    <span>View Details</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
</div>
