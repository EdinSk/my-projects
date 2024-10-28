@php
$selectedDate = request('date') ? \Carbon\Carbon::parse(request('date')) : \Carbon\Carbon::now();
$currentMonth = $selectedDate->format('F Y'); // Full month name and year
$daysInMonth = $selectedDate->daysInMonth; // Total days in selected month
$firstDayOfWeek = $selectedDate->startOfMonth()->dayOfWeek; // Get the first day of the week for the selected month

$events = \App\Models\Event::whereYear('start_date', $selectedDate->year)
    ->whereMonth('start_date', $selectedDate->month)
    ->get();
@endphp

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Календар со датуми за сите престојни настани</h2>
            <p>Погледни ги сите настани распоредени на календар. Со клик на обележаните настани можеш да добиеш повеќе информации за секој од настаните за со целосни информации упатете се до индивидуалната страна на настанот.</p>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="calendar-wrapper">
                <!-- Calendar Header -->
                <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-outline-primary btn-sm" id="previousMonth">&lt;</button>
                    <h4 class="mb-0" id="currentMonth">{{ $currentMonth }}</h4>
                    <button class="btn btn-outline-primary btn-sm" id="nextMonth">&gt;</button>
                </div>

                <!-- Days of the Week -->
                <div class="d-flex text-center day-headers">
                    <div class="day-header">Sun</div>
                    <div class="day-header">Mon</div>
                    <div class="day-header">Tue</div>
                    <div class="day-header">Wed</div>
                    <div class="day-header">Thu</div>
                    <div class="day-header">Fri</div>
                    <div class="day-header">Sat</div>
                </div>

                <!-- Calendar Days -->
                <div class="d-flex flex-wrap" id="calendarDays" style="height: 420px;">
                    <!-- Empty cells for previous month's days -->
                    @for($i = 0; $i < $firstDayOfWeek; $i++)
                        <div class="day-cell"></div>
                    @endfor

                    <!-- Selected Month Days with Events -->
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $isEventDay = $events->contains(function($event) use ($day) {
                                return \Carbon\Carbon::parse($event->start_date)->day == $day;
                            });
                        @endphp
                        <div class="day-cell p-1">
                            <span class="day-number {{ $isEventDay ? 'event-day' : '' }}">{{ $day }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <style>
    .calendar-wrapper {
        max-width: 400px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .calendar-header {
        font-weight: bold;
        color: #343a40;
    }

    .day-headers {
        font-weight: bold;
        color: #343a40;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 10px;
    }

    .day-header {
        width: calc(100% / 7);
        text-align: center;
        padding: 10px 0;
    }

    .day-cell {
        width: calc(100% / 7);
        height: 60px;
        box-sizing: border-box;
        text-align: center;
        position: relative;
        padding-top: 5px;
    }

    .day-number {
        position: absolute;
        top: 5px;
        left: 5px;
        font-size: 14px;
        font-weight: bold;
    }

    .event-day {
        color: #ffffff;
        background-color: #007bff;
        border-radius: 50%;
        padding: 5px;
        width: 28px;
        height: 28px;
        display: inline-block;
        text-align: center;
    }

    button {
        min-width: 40px;
    }

    h4 {
        font-weight: bold;
        color: #343a40;
        font-size: 18px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const previousMonthBtn = document.getElementById('previousMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        const currentMonthEl = document.getElementById('currentMonth');
        const calendarDaysEl = document.getElementById('calendarDays');
        let selectedDate = new Date("{{ $selectedDate->format('Y-m-d') }}");

        function formatDate(date) {
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            return `${year}-${month}-01`;
        }

        function updateCalendar(date) {
            fetch(`/calendar?date=` + formatDate(date))
                .then(response => response.json())
                .then(data => {
                    currentMonthEl.textContent = data.currentMonth;
                    calendarDaysEl.innerHTML = data.daysHtml;
                });
        }

        previousMonthBtn.addEventListener('click', function () {
            selectedDate.setMonth(selectedDate.getMonth() - 1);
            updateCalendar(selectedDate);
        });

        nextMonthBtn.addEventListener('click', function () {
            selectedDate.setMonth(selectedDate.getMonth() + 1);
            updateCalendar(selectedDate);
        });
    });
</script>
</div>


