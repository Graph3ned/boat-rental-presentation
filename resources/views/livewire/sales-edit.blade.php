<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#00A3E0] text-center px-4 py-3">Edit Ride</h1>
    </div>

    <form wire:submit.prevent="updateRides">
        {{-- Text input: Staff name/ID with real-time binding --}}
        <div class="mb-3">
            <label for="user" class="block text-sm font-medium text-gray-700">Staff</label>
            <input type="text" 
                    wire:model="user" 
                    id="user" 
                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                            focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
            @error('user') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Select: Ride type with live updates that affect classification options --}}
        <div class="mb-3">
            <label for="rideType" class="block text-sm font-medium text-gray-700">Ride Type</label>
            <select wire:model.live="rideType" 
                id="rideType" 
                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                <option value="" disabled>Select Ride Type</option>
                @foreach(array_keys($prices) as $type)
                    <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                @endforeach
            </select>
            @error('rideType') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Select: Classification options dynamically populated based on selected ride type --}}
        <div class="mb-3">
            <label for="classification" class="block text-sm font-medium text-gray-700">Classification</label>
            <select wire:model.live="classification" 
                id="classification" 
                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                <option value="" disabled>Select Classification</option>
                @if($rideType && isset($prices[$rideType]))
                    @foreach($prices[$rideType] as $key => $value)
                        <option value="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $key)) }}</option>
                    @endforeach
                @endif
            </select>
            @error('classification') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Duration --}}
        <div class="mb-3">
            <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
            <select wire:model="duration" 
                id="duration" 
                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                <option value="30">30 minutes</option>
                <option value="45">45 minutes</option>
                <option value="60">1 hour</option>
                <option value="75">1 hour 15 minutes</option>
                <option value="90">1 hour 30 minutes</option>
            </select>
            @error('duration') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Select: Life jacket usage rating from 0-8 --}}
        <div class="mb-3">
            <label for="life_jacket_usage" class="block text-sm font-medium text-gray-700">Life Jacket Usage</label>
            <select wire:model.live="life_jacket_usage" 
                id="life_jacket_usage" 
                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                @foreach(range(0, 8) as $usage)
                    <option value="{{ $usage }}">{{ $usage }}</option>
                @endforeach
            </select>
            @error('life_jacket_usage') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Number input: Total price with minimum value of 0 and peso symbol --}}
        <div class="mb-3">
            <label for="totalPrice" class="block text-sm font-medium text-gray-700">Total Price</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">₱</span>
                <input type="number" 
                       wire:model="totalPrice" 
                       id="totalPrice" 
                       class="pl-8 block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                              focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50"
                       min="0">
            </div>
            @error('totalPrice') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" 
                   wire:model="date"
                   id="date" 
                   class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                          focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
            @error('date') 
                <span class="text-red-500">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Time Range --}}
        <div class="grid grid-cols-2 gap-6 mb-3">
            <div>
                <label for="timeStart" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" 
                       wire:model="timeStart"
                       id="timeStart" 
                       class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                              focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                @error('timeStart') 
                    <span class="text-red-500">{{ $message }}</span> 
                @enderror
            </div>
            <div>
                <label for="timeEnd" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" 
                       wire:model="timeEnd"
                       id="timeEnd" 
                       class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                              focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50">
                @error('timeEnd') 
                    <span class="text-red-500">{{ $message }}</span> 
                @enderror
            </div>
        </div>

        {{-- Note textarea input --}}
        <div class="mb-3">
            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
            <textarea
                wire:model="note"
                id="note"
                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm 
                       focus:border-[#00A3E0] focus:ring focus:ring-[#00A3E0] focus:ring-opacity-50"
                rows="2"
            ></textarea>
        </div>

        <div class="flex space-x-3">
            <button type="button" 
                wire:click="$dispatch('closeModal')"
                class="w-full bg-[#FF8C00] text-white px-4 py-2 rounded-lg font-medium
                       transform transition-all duration-200 hover:-translate-y-1 
                       hover:shadow-md hover:bg-[#E67E00]">
                Cancel
            </button>

            <button type="submit"
                class="w-full bg-[#00A3E0] text-white py-2 px-4 rounded-lg font-medium 
                       transform transition-all duration-200 hover:-translate-y-1 
                       hover:shadow-md hover:bg-[#0093CC]">
                Save
            </button>
        </div>
    </form>
</div>
