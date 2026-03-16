<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Book Classes
        </h2>
    </x-slot>

    @if (session('success') || $errors->any())
        <div class="fixed top-20 right-6 z-50 w-full max-w-sm space-y-3">
            @if (session('success'))
                <div class="alert shadow-lg toast-auto-dismiss">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error shadow-lg toast-auto-dismiss">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="upcoming-panel dashboard-panel-text">
                    @forelse ($scheduledClasses as $scheduledClass)
                        <div class="upcoming-row">
                            <div>
                                <h3 class="upcoming-class-name">
                                    {{ $scheduledClass->classType->name ?? 'Class' }}
                                </h3>
                                <p class="upcoming-class-duration">
                                    {{ $scheduledClass->classType->description ?? 'No description available.' }}
                                </p>
                                <p class="upcoming-class-duration">
                                    {{ $scheduledClass->classType->minutes ?? 0 }} minutes
                                    @if ($scheduledClass->instructor)
                                        • Instructor: {{ $scheduledClass->instructor->name }}
                                    @endif
                                </p>
                            </div>

                            <div class="upcoming-row-right">
                                <p class="upcoming-time">{{ $scheduledClass->date_time->format('g:i a') }}</p>
                                <p class="upcoming-date">{{ $scheduledClass->date_time->format('jS M') }}</p>

                                @if (in_array($scheduledClass->id, $bookedClassIds, true))
                                    <form method="POST" action="{{ route('booking.destroy', $scheduledClass) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="upcoming-cancel-btn">Cancel</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('booking.store') }}">
                                        @csrf
                                        <input type="hidden" name="scheduled_class_id" value="{{ $scheduledClass->id }}">
                                        <button type="submit" class="book-action-btn">Book</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="upcoming-empty">
                            <p>No classes are available for booking right now.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
