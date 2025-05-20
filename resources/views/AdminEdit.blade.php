<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-blue-800 dark:text-blue-300 leading-tight">
                {{ __('Prices') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        
        <div class="mx-auto max-w-7xl px-8">
            <div class=" dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                @livewire('admin-edit', ['ride_type' => $ride_type])
            </div>
        </div>
    </div>
</x-app-layout>
