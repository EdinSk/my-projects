@extends('layouts.app')
@section('content')

<!-- hero section -->

<div class="container my-5 position-relative">
    <div class="row">
        <div class="col-12">
            <div class="position-relative d-flex align-items-center" style="background: url('https://picsum.photos/1200/600') center/cover no-repeat; height: 400px; border-radius: 20px;">
                <div class="position-absolute top-50 start-50 translate-middle w-75 bg-white p-4 rounded shadow-lg" style="max-width: 500px;">
                    <small class="text-uppercase text-secondary">Истакнат Настан</small>
                    <h2 class="fw-bold text-dark">HR Кафе</h2>
                    <p class="text-muted">Овој четврток кафе на тема како да примените техники и чекори од сепоти коучинг за подобро да се водите себеси...<br><small>25 Юли, 2024</small></p>
                    <a href="#" class="btn btn-warning btn-lg fw-bold">Прочитај повеќе</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- calendar -->

<div class="border-top mt-4">
    @livewire('partials.event-calendar')

</div>

<!-- all events -->

@livewire('event-listing')

@livewire('layout.footer')



@endsection