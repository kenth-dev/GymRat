<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Schedule a Class
        </h2>
    </x-slot>

    <div class="py-12 dashboard-content-wrap">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dashboard-panel">
                <div class="schedule-panel dashboard-panel-text">
                    <form method="POST" action="{{ route('schedule.store') }}" class="schedule-form">
                        @csrf

                        <div class="schedule-field">
                            <label for="class_type" class="schedule-label">Select type of class</label>
                            <select id="class_type" name="class_type" class="schedule-select" required>
                                @foreach ($classTypes as $classType)
                                    <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="schedule-grid">
                            <div class="schedule-field">
                                <label for="class_date" class="schedule-label">Date</label>
                                <input id="class_date" name="class_date" type="date" class="schedule-input" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>

                            <div class="schedule-field">
                                <label for="class_time" class="schedule-label">Time</label>
                                <select id="class_time" name="class_time" class="schedule-select" required>
                                    <option value="" selected disabled>Select time</option>
                                    <option value="06:00">06:00 AM</option>
                                    <option value="08:00">08:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="schedule-btn">Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
