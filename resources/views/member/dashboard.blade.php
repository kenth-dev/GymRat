<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="p-6 text-gray-900 dark:text-gray-100 dashboard-panel-text">
                    {{ __("You're logged in as Member!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
