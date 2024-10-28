@php
// Example event data
$events = [
(object) ['date' => now(), 'title' => 'Event 1'],
(object) ['date' => now()->addDays(1), 'title' => 'Event 2'],
(object) ['date' => now()->addDays(2), 'title' => 'Event 3'],
];

$heroImage = 'path/to/your/image.jpg';
$heroTitle = 'Запознај го Тимот';
$heroSubtitle = 'Македонска Асоцијација за Човечки Ресурси';
$heroLink = '/about';
$heroButtonText = 'Прочитај повеќе';
@endphp

@extends('layouts.app')
@section('content')

<!-- Hero section -->
<div class="hero-section" style="background-image: url('https://picsum.photos/1200/400');">
    <div class="overlay">
        <div class="text-content">
            <h1>{{ $heroTitle }}</h1>
            <p>{{ $heroSubtitle }}</p>
            <a href="{{ $heroLink }}" class="btn btn-primary">{{ $heroButtonText }}</a>
        </div>
        <div class="social-icons">
            <a href="https://www.linkedin.com/company/macedonian-hr-association/?originalSubdomain=mk" target=”_blank”><i class="fab fa-linkedin"></i></a>
            <a href="https://www.facebook.com/mhra.mk/" target=”_blank”><i class="fab fa-facebook-square"></i></a>
            <a href="https://www.x.com" target=”_blank”><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</div>

<!-- Badges -->

@livewire('event-badges', ['events' => $events])

<!-- Мисија и Визија -->

<div class="container mission-vision-container">
    <div class="row content-section my-4">
        <div class="col-md-4">
            <img src="/images/about/image-6.png" alt="Profile Image 1" class="img-fluid">
        </div>
        <div class="col-md-8 text-column">
            <h1>МИСИЈА И ВИЗИЈА</h1>
            <h2>Македонска Асоцијација за Човечки Ресурси</h2>
            <p>МАИР е строга, непристрасна, непрофитно и неполитичко задружение на граѓани формирано на 22 април 2009 година, задачи приоритети на дејство и активности преспособување со развој на работна сила, профилрање и унапредување то современите ресурси, како и управување на процесот управување со човечките ресурси.</p>
            <h3>Мисија:</h3>
            <p>"Мисија на МАИР е управување и развој на професионален менаџмент со човечките ресурси."</p>
            <h3>Визија:</h3>
            <p>"Визија на МАИР е развој на луѓето и организациите!"</p>
        </div>
    </div>
    <div class="row goals-section my-4">

        <div class="col-md-8 my-5 py-5">
            <h3>Цели и задачи:</h3>
            <p>ПОДДРШКА на највисоките идеали во областа на управувањето со човечки ресурси и постојано приближување и ценете на професионалци; придонесување на управувањето со човечки ресурси преку почитување на правилата за успешно работење и задолженија на членовите; и креирање водечки организации и покровители на добри практики во постојана употреба на стандардите за управување со човечки ресурси. Подигање на квалитет на подоцнежните документи и до документите и во и во текот на трети лица.</p>
        </div>
        <div class="col-md-4">
            <img src="/images/about/image-8.png" alt="Profile Image 2" class="img-fluid">
        </div>
    </div>
</div>

<!-- Претседател на МАИР -->

<div class="container mt-5">
    <div class="row align-items-start profile-container">
        <div class="col-md-4">
            <img src="/images/about/image-7.png" alt="Mr-др Дарко Петровски" class="img-fluid rounded-circle">
        </div>
        <div class="col-md-8">
            <h2>Претседател на МАИР</h2>
            <h3>Mr-др Дарко Петровски</h3>
            <p>Дарко е еден од основачите на МАИР, заслужен професионалец со широка ведна...</p>
            <p>Преку професионалниот ангажман, Дарко бил еден од водечките активни особи...</p>
            <p>Дарко манифестираше емоционални способности низ Економскиот факултет...</p>
        </div>
    </div>
</div>


<style>
    .hero-section {
        position: relative;
        width: 100%;
        height: 400px;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 10px;
        overflow: hidden;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        box-sizing: border-box;
    }

    .text-content {
        color: white;
        z-index: 2;
    }

    .social-icons a {
        color: white;
        margin-left: 10px;
        text-decoration: none;
        font-size: 20px;
    }

    .mission-vision-container {
        background: #fff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .text-column h1,
    .text-column h2,
    .text-column h3 {
        color: #333;
    }

    .text-column p {
        color: #666;
        line-height: 1.6;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

</style>
</div>




@endsection
