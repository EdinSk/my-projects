<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;

class EventCalendar extends Component
{
    public $month;
    public $year;
    public $events = [];

    public function mount($month,  $events, $year)
    {
        

        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Event::whereYear('start_date', $this->year)
                             ->whereMonth('start_date', $this->month)
                             ->get();
    }

    public function nextMonth()
    {
        $this->month = Carbon::parse("$this->year-$this->month-01")->addMonth()->month;
        $this->year = Carbon::parse("$this->year-$this->month-01")->year;
        $this->loadEvents();
    }

    public function previousMonth()
    {
        $this->month = Carbon::parse("$this->year-$this->month-01")->subMonth()->month;
        $this->year = Carbon::parse("$this->year-$this->month-01")->year;
        $this->loadEvents();
    }

    

    public function render()
    {
        return view('livewire.partials.event-calendar');
    }
}
