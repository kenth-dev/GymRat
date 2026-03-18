<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Notifications
        </h2>
    </x-slot>

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="upcoming-panel dashboard-panel-text">
                    @forelse ($notifications as $notification)
                        <div class="upcoming-row">
                            <div>
                                <h3 class="upcoming-class-name">
                                    <a href="{{ route('notifications.show', $notification->id) }}" class="notification-title-link">
                                        {{ $notification->data['class'] }}
                                    </a>
                                </h3>
                                <p class="upcoming-class-duration">
                                    {{ $notification->data['message'] }}
                                </p>
                                <p class="upcoming-class-duration">
                                    {{ $notification->data['date_time'] }}
                                </p>
                            </div>
                            <div class="upcoming-row-right">
                                <p class="upcoming-date">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="upcoming-empty">
                            <p>You have no notifications yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
