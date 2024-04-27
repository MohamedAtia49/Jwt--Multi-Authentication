<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- @livewire('properties.test-properties') --}}
                    {{-- @livewire('actions.test-actions') --}}
                    @livewire('events.first-event')
                    {{-- @livewire('events.second-event')
                    @livewire('events.third-event') --}}
                    {{-- @livewire('full-comp') --}}

                    <script>
                        document.addEventListener('livewire:init', () => {
                        Livewire.on('fire', function() {
                            alert('A javascript listener for fire event');
                        });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
