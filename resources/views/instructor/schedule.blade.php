<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gymrat-dashboard-heading">
            Schedule a Class
        </h2>
    </x-slot>

        @if (session('success') || $errors->any())
            <div class="fixed top-20 right-6 z-50 w-full max-w-sm space-y-3">
                @if (session('success'))
                    <div class="alert shadow-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error shadow-lg">
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
                <div class="schedule-panel dashboard-panel-text">
                    <form method="POST" action="{{ route('schedule.store') }}" class="schedule-form">
                        @csrf

                        <div class="schedule-field">
                            <label for="class_type_id" class="schedule-label">Select type of class</label>
                            <select id="class_type_id" name="class_type_id" class="schedule-select" required>
                                <option value="" selected disabled>Select a class</option>
                                @foreach ($classTypes as $classType)
                                    <option value="{{ $classType->id }}" @selected(old('class_type_id') == $classType->id)>
                                        {{ $classType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="schedule-grid">
                            <div class="schedule-field">
                                <label for="class_date" class="schedule-label">Date</label>
                                <input id="class_date" name="class_date" type="date" class="schedule-input" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('class_date') }}" required>
                            </div>

                            <div class="schedule-field">
                                <label for="class_time" class="schedule-label">Time</label>
                                <select id="class_time" name="class_time" class="schedule-select" required>
                                    <option value="" selected disabled>Select time</option>
                                    <option value="06:00" @selected(old('class_time') === '06:00')>06:00 AM</option>
                                    <option value="08:00" @selected(old('class_time') === '08:00')>08:00 AM</option>
                                    <option value="10:00" @selected(old('class_time') === '10:00')>10:00 AM</option>
                                    <option value="14:00" @selected(old('class_time') === '14:00')>02:00 PM</option>
                                    <option value="16:00" @selected(old('class_time') === '16:00')>04:00 PM</option>
                                    <option value="18:00" @selected(old('class_time') === '18:00')>06:00 PM</option>
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
