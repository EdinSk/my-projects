<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\JoinController;
use App\Http\Livewire\Events\EventDetail;
use App\Http\Livewire\Actions\Logout;
use App\Livewire\Conference;
use App\Http\Livewire\Forms\Register;

// Welcome page (Home)
Route::get('/', function () {
    return view('home.index');
})->name('home');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');

Route::prefix('admin')->group(function () {

    // Route for the Users list
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    // Route for the Blogs list
    Route::get('/blogs', function () {
        return view('admin.blogs');
    })->name('admin.blogs');
  // Route for the Comments
    Route::get('/blogs/comments', function () {
        return view('admin.comments'); // Replace with your actual comments view
    })->name('comments');

    // Route for the Events list
    Route::get('/events', function () {
        return view('admin.events');
    })->name('admin.events');

    // Route for the Conferences list
    Route::get('/conference', function () {
        return view('admin.conference');
    })->name('admin.conference');
});


// User Dashboard Route
Route::get('/user/dashboard', [UserController::class, 'dashboard'])
    ->name('user.dashboard')
    ->middleware('auth');

// Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');


// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/conferences/{id}', [EventController::class, 'showConference'])->name('conferences.show');



Route::get('/about', function () {
    return view('about-team.about'); // Reference the view with the folder
});


// Authentication Routes provided by Laravel Breeze or Jetstream
require __DIR__ . '/auth.php';


// Conference
Route::get('/conference', Conference::class)->name('conference');
Route::get('/latest-conference', function () {
    return view('events.latest-conference'); // Reference the view in the 'events' folder
});
Route::get('/conference', [ConferenceController::class, 'showConference'])->name('conference');

Route::get('/join', [JoinController::class, 'index'])->name('join.index');
Route::post('/join', [JoinController::class, 'store'])->name('join.store');

// Logout

Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');



// get calendar day

Route::get('/calendar', function () {
    $date = request('date') ? \Carbon\Carbon::parse(request('date')) : \Carbon\Carbon::now();
    $currentMonth = $date->format('F Y');
    $daysInMonth = $date->daysInMonth;
    $firstDayOfWeek = $date->startOfMonth()->dayOfWeek;

    $events = \App\Models\Event::whereYear('start_date', $date->year)
        ->whereMonth('start_date', $date->month)
        ->get();

    $daysHtml = '';

    // Empty cells for previous month's days
    for ($i = 0; $i < $firstDayOfWeek; $i++) {
        $daysHtml .= '<div class="day-cell"></div>';
    }

    // Selected Month Days with Events
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $dayEvents = $events->filter(function ($event) use ($day) {
            return \Carbon\Carbon::parse($event->start_date)->day == $day;
        });

        $eventsHtml = '';
        foreach ($dayEvents as $event) {
            $eventsHtml .= '<div class="event mt-1">' . $event->title . '</div>';
        }

        $daysHtml .= '<div class="day-cell p-1"><span class="day-number">' . $day . '</span>' . $eventsHtml . '</div>';
    }

    return response()->json([
        'currentMonth' => $currentMonth,
        'daysHtml' => $daysHtml,
    ]);
});
