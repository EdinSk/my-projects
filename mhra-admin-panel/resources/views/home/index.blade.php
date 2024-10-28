@php


$heroImage = 'path/to/your/image.jpg';
$heroTitle = 'Запознај го Тимот';
$heroSubtitle = 'Македонска Асоцијација за Човечки Ресурси';
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
            <a href="{{ route('register') }}" class="btn btn-primary">Зачлени се!</a>
        </div>
        <div class="social-icons">
            <a href="https://www.linkedin.com/company/macedonian-hr-association/?originalSubdomain=mk" target=”_blank”><i class="fab fa-linkedin"></i></a>
            <a href="https://www.facebook.com/mhra.mk/" target=”_blank”><i class="fab fa-facebook-square"></i></a>
            <a href="https://www.x.com" target=”_blank”><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</div>

<!-- Badges -->

@livewire('event-badges')


<!-- blogs hero -->

<section class="py-5 border-top">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Кажи ги своите мислења и поврзи се со останатите HR ентузијасти</h1>
        <p class="lead mb-4">По регистрирање, ќе бидете дел од заедницата, каде ќе разменувате идеи и ќе се вмрежите со останатите професионалци.</p>

        <!-- Image Section and CTA -->
        <div class="row justify-content-center align-items-center mb-4">
            <!-- Left Image -->
            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <img src="https://picsum.photos/400" alt="Left Image" class="circular-img img-fluid">
            </div>

            <!-- CTA Button in the Center -->
            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <p class="fs-5 fw-bold">Упати се уште сега кон</p>
            </div>

            <!-- Right Image -->
            <div class="col-12 col-md-3">
                <img src="https://picsum.photos/400" alt="Right Image" class="circular-img img-fluid">
            </div>
        </div>

        <!-- Blog Button -->
        <div>
            <a href="#" class="btn btn-primary-custom btn-lg"> Нашиот блог</a>
        </div>
    </div>
</section>


<!-- READ MORE -->

<div class="container py-5 border-top">
    <div class="row">
        <!-- Left Column: Numbered List -->
        <div class="col-md-6">
            <div class="numbered-item">
                <span>01</span>
                <div class="ms-3">
                    <h4>Едукативни настани</h4>
                    <a href="#" class="text-muted small">Прочитај повеќе</a>
                </div>
            </div>

            <div class="numbered-item mt-4">
                <span>02</span>
                <div class="ms-3">
                    <h4>Најнови информации и случувања</h4>
                    <a href="#" class="text-muted small">Прочитај повеќе</a>
                </div>
            </div>

            <div class="numbered-item mt-4">
                <span>03</span>
                <div class="ms-3">
                    <h4>Ширење на мрежата на контакти</h4>
                    <a href="#" class="text-muted small">Прочитај повеќе</a>
                </div>
            </div>

            <div class="numbered-item mt-4">
                <span>04</span>
                <div class="ms-3">
                    <h4>Вклучување во работeњето на МАЧР</h4>
                    <a href="#" class="text-muted small">Прочитај повеќе</a>
                </div>
            </div>

            <div class="numbered-item mt-4">
                <span>05</span>
                <div class="ms-3">
                    <h4>HR огласи за работа</h4>
                    <a href="#" class="text-muted small">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Right Column: Text Block -->
        <div class="col-md-6">
            <h3>Бенефити од зачленување во МАЧР</h3>
            <p class="text-muted">
                Македонската асоцијација за човечки ресурси - МАЧР како национален претставник е компетентен
                акционер и граѓанин, упатен и со најновите искуства во управувањето со човечки ресурси
                и соработува со врвни експерти од областа на управувањето со луѓе и организации.
                Зачленувањето во оваа асоцијација ви нуди можности за размена на искуства и за мрежно поврзување
                со останатите професионалци во областа на човечките ресурси.
            </p>
        </div>
    </div>
</div>

<!-- Events -->

@livewire('events')


<!-- conference hero -->

@livewire('conference')

<div class="container py-5">
    <h2 class="mb-4">Популарни истражувања</h2>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="card shadow-sm research-card">
                <div class="image-container">
                    <img src="https://picsum.photos/400" class="img-fluid rounded-bottom ms-0" alt="HR Competency Study">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Истражување за HR компетенции</h5>
                    <a href="#" class="stretched-link text-primary">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6">
            <div class="card shadow-sm research-card">
                <div class="image-container">
                    <img src="https://picsum.photos/400" class="img-fluid rounded-bottom ms-0" alt="Employee Engagement Study">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Истражување за ангажираноста на вработените</h5>
                    <a href="#" class="stretched-link text-primary">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-6">
            <div class="card shadow-sm research-card">
                <div class="image-container">
                    <img src="https://picsum.photos/400" class="img-fluid rounded-bottom ms-0" alt="Inclusivity Study">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Истражување за инклузивност на работното место</h5>
                    <a href="#" class="stretched-link text-primary">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-6">
            <div class="card shadow-sm research-card">
                <div class="image-container">
                    <img src="https://picsum.photos/400" class="img-fluid rounded-bottom ms-0" alt="Work-Life Balance Study">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Балансот меѓу работа и приватен живот</h5>
                    <a href="#" class="stretched-link text-primary">Прочитај повеќе</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- more about us -->

<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left Section -->
        <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
            <div class="position-relative">
                <img src="/images/about/image-6.png" class="img-fluid rounded" alt="Woman Image">
                <!-- Text Bubble -->
                <div class="position-absolute top-0 start-50 translate-middle-x mt-3 bg-light p-3 rounded shadow">
                    Станувај волонтер на нашите конференции и прошири ги хоризонтите за вмрежување!
                </div>
            </div>
            <!-- Headline and Description -->
            <h2 class="mt-4">Дознај повеќе за нас и нашите цели и задачи!</h2>
            <p>Нашите услуги се почеток во формирање на прогресивни кревки за професионалните амбиции на иднината.</p>
            <a href="#" class="btn btn-warning">Повеќе за нас</a>
        </div>

        <!-- Right Section -->
        <div class="col-md-6 text-center text-md-start">
            <div class="position-relative">
                <img src="/images/about/image-8.png" class="img-fluid rounded" alt="Business Woman">
                <!-- Text Bubble -->
                <div class="position-absolute bottom-0 start-0 mb-3 bg-light p-3 rounded shadow">
                    Придружи се на нашите информации и сите најнови вести и новости за нашите активности.
                </div>
                <!-- Button-like Overlay -->
                <div class="position-absolute top-50 start-50 translate-middle bg-warning p-3 rounded shadow text-center">
                    <span class="d-block fw-bold mb-2">МАЧР Билети</span>
                    <a href="https://mhrtickets.com" class="text-white text-decoration-none">mhrtickets.com</a>
                </div>
            </div>
        </div>
    </div>
</div>



@livewire('layout.footer')



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


    /* Minimal custom CSS */
    .circular-img {
        width: 100%;
        height: auto;
        border-radius: 50%;
        object-fit: cover;
    }

    .btn-primary-custom {
        background-color: #F36F22;
        border-color: #F36F22;
    }

    .btn-primary-custom:hover {
        background-color: #e65c1a;
        border-color: #e65c1a;
        color: #fff;
    }

    .btn-outline-custom {
        border-color: #F36F22;
        color: #F36F22;
    }

    .btn-outline-custom:hover {
        background-color: rgba(243, 111, 34, 0.1);
        color: #F36F22;
    }


    /* Read More sections */

    .numbered-item {
        display: flex;
        align-items: center;
    }

    .numbered-item span {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .numbered-item h4 {
        margin-bottom: 0;
    }

    .numbered-item a {
        color: #555;
        text-decoration: none;
    }

    .numbered-item a:hover {
        text-decoration: underline;
    }

    /* Reasearch */

    .research-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .image-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .image-container img {
        object-fit: cover;
        height: 200px;
        /* Adjust to control the height of the images */
        width: 80%;

    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        margin-bottom: 10px;
    }

    .stretched-link {
        font-weight: bold;
        text-decoration: none;
    }


</style>

@endsection