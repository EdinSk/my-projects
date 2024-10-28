@extends('layouts.app')

@section('content')




<div class="d-flex">
    @livewire('admin.dashboard-content')
    <div class="w-3/4 p-6">

    @livewire('admin.blogs.blogs-list')

    </div>
</div>


@endsection