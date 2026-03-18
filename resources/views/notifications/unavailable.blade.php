<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Notification
        </h2>
    </x-slot>

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="upcoming-panel dashboard-panel-text">
                    <div class="upcoming-empty">
                        <p>This notification is no longer available.</p>
                        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">← Back to Notifications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
