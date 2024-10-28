
@extends('layouts.app')

@section('content')
@if (Auth::check())
@livewire('partials.user-profile')
@livewire('event-badges')

@livewire('partials.points-progress')

@livewire('partials.connections-list')

@livewire('partials.latest-badges')

@livewire('partials.feedback')

@livewire('partials.purchased-tickets')

@livewire('partials.event-calendar')






@else
<p>Hello, Guest!</p>
@endif
@endsection