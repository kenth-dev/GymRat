<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Booking Confirmation
        </h2>
    </x-slot>

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="upcoming-panel dashboard-panel-text">

                    <div class="upcoming-row">
                        <span class="upcoming-class-name">{{ $scheduledClass->classType->name }}</span>
                        <span class="upcoming-time">{{ $scheduledClass->date_time->format('g:i a') }}</span>
                    </div>

                    <div class="upcoming-row">
                        <span class="upcoming-class-duration">Description</span>
                        <span class="upcoming-class-duration">{{ $scheduledClass->classType->description }}</span>
                    </div>

                    <div class="upcoming-row">
                        <span class="upcoming-class-duration">Date</span>
                        <span class="upcoming-class-duration">{{ $scheduledClass->date_time->format('l, F j, Y') }}</span>
                    </div>

                    <div class="upcoming-row">
                        <span class="upcoming-class-duration">Duration</span>
                        <span class="upcoming-class-duration">{{ $scheduledClass->classType->minutes }} minutes</span>
                    </div>

                    @if($scheduledClass->instructor)
                    <div class="upcoming-row">
                        <span class="upcoming-class-duration">Instructor</span>
                        <span class="upcoming-class-duration">{{ $scheduledClass->instructor->name }}</span>
                    </div>
                    @endif

                    <div class="upcoming-empty">
                        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">← Back to Notifications</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
