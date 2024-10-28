@extends('layouts.app')
@section('content')

<div class="container mt-5 pb-4 border-bottom">
    <div class="row align-items-center">
        <!-- Left Section: Blog Info -->
        <div class="col-md-6 position-relative">
            <div class="blog-info">
                <p class="blog-category">Истакнат блог</p>
                <h2 class="blog-title">Како до најдобар избор при процесот на регрутација</h2>
                <p class="blog-author">Од <span class="author-name">Гоко Вукановски</span> | 20 Јуни, 2024</p>

            </div>
        </div>

        <!-- Right Section: Blog Image -->
        <div class="col-md-6">
            <div class="blog-image-container">
                <img src="https://picsum.photos/600/400" alt="Blog Image" class="img-fluid rounded-circle blog-image">
            </div>
        </div>
    </div>

    <!-- Social Media Icons -->
    <div class="social-icons mt-4 text-end">
        <span>Заследи не на социјалните медиуми:</span>
        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>
</div>



<!-- event badges -->

@livewire('event-badges')


<!-- blogs-something -->

<div class="container mt-5">
    <div class="row align-items-center">
        <!-- Left Section: Image -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
            <img src="images/about/image-4.png" alt="Active Participation" class="img-fluid rounded-circle shadow">
        </div>

        <!-- Right Section: Text -->
        <div class="col-md-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-warning">Почетна</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Блогови</li>
                </ol>
            </nav>

            <!-- Heading and Paragraph -->
            <h2 class="fw-bold text-primary">
                Биди <span class="text-warning">активен/на</span>, споделувај настани на социјалните медиуми, собирај поени,
                добивај значки и рамки, кани пријатели на настани и освојувај попусти за следната купена карта
            </h2>

            <p class="mt-3 text-secondary">
                Доколку овој месец си најактивен/на во форумот добиваш награди за да го направиш твојот профил уникатен,
                а ако каниш пријатели и тие купат карта преку твојот линк за покана добиваш попуст на следната купена карта за настан.
            </p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <!-- Section Heading -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="fw-bold">Најнови блогови</h1>
        </div>
    </div>

    <!-- Livewire Component for Blogs -->
    @livewire('blogs') <!-- This will render the blogs dynamically -->

</div>


<!-- Culture -->

<div class="container mt-5 border-top">
    <!-- Section Heading -->
    <h2 class="fw-bold mb-4">Тема: Култура во компанијата</h2>

    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="d-flex bg-light rounded-4 p-3 shadow-sm">
                <div class="flex-shrink-0">
                    <img src="https://picsum.photos/200/200" class="img-fluid rounded-start" alt="Blog Image">
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold">Како да привлечете и задржите таленти</h5>
                    <a href="#" class="text-warning">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6">
            <div class="d-flex bg-light rounded-4 p-3 shadow-sm">
                <div class="flex-shrink-0">
                    <img src="https://picsum.photos/200/200" class="img-fluid rounded-start" alt="Blog Image">
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold">Техники за управување со стрес на работното место</h5>
                    <a href="#" class="text-warning">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-6">
            <div class="d-flex bg-light rounded-4 p-3 shadow-sm">
                <div class="flex-shrink-0">
                    <img src="https://picsum.photos/200/200" class="img-fluid rounded-start" alt="Blog Image">
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold">Важноста на обуката и развојот на вработените</h5>
                    <a href="#" class="text-warning">Прочитај повеќе</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-6">
            <div class="d-flex bg-light rounded-4 p-3 shadow-sm">
                <div class="flex-shrink-0">
                    <img src="https://picsum.photos/200/200" class="img-fluid rounded-start" alt="Blog Image">
                </div>
                <div class="ms-3">
                    <h5 class="fw-bold">Разноликост и инклузивност: Клуч за успехот на организацијата</h5>
                    <a href="#" class="text-warning">Прочитај повеќе</a>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Styles -->
<style>
    .blog-info {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        max-width: 350px;
    }

    .blog-title {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0;
    }

    .blog-author {
        font-size: 14px;
        color: #f15a24;
    }

    .author-name {
        color: #e57b00;
        font-weight: bold;
    }

    .blog-image-container {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .blog-image {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }

    .social-icons a {
        margin-left: 15px;
        color: #333;
        font-size: 24px;
        text-decoration: none;
    }

    .social-icons a:hover {
        color: #f15a24;
    }

    .social-icons span {
        font-size: 16px;
        margin-right: 15px;
        font-weight: bold;
    }

    .btn-warning {
        background-color: #f15a24;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e57b00;
    }
</style>




@endsection