@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Blog Main Section -->
        <div class="col-12">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm">
                <!-- Background Image -->
                <img src="https://picsum.photos/600/400" alt="Blog Image" class="img-fluid w-100" style="object-fit: cover;">

                <!-- Text Overlay -->
                <div class="position-absolute top-0 start-0 p-5 text-white" style="background: rgba(0, 0, 0, 0.5); width: 100%;">
                    <p class="small">Блог</p>
                    <h2 class="fw-bold">{{ $blog->title }}</h2> <!-- Dynamically display the blog title -->
                    <p>Од <span class="fw-bold">{{ $blog->author->first_name }}</span> <span class="fw-bold">{{$blog->author->last_name}}</span> | {{ $blog->created_at->format('d F, Y') }}</p> <!-- Dynamically display the author and date -->
                </div>

                <!-- Social Media Section -->
                <div class="position-absolute bottom-0 end-0 p-3" style="background: rgba(0, 0, 0, 0.7);">
                    <span class="text-white me-3">Заследи не на социјалните медиуми:</span>
                    <a href="#" class="text-white me-2"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


@livewire('blog-show', ['blogId' => $blog->id])

@livewire('blog-comments', ['blog' => $blog])


<!-- related blogs -->

<div class="container my-5">
    <!-- Related Blogs Section -->
    <div class="related-blogs">
        <h3 class="mb-4">Слични блогови</h3>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($relatedBlogs as $relatedBlog)
                <div class="col">
                    <div class="card shadow-sm rounded-4 overflow-hidden h-100 border-0">
                        <div class="position-relative">
                            <img src="{{ $relatedBlog->image_url ?? 'https://picsum.photos/600/400' }}" class="card-img-top" alt="{{ $relatedBlog->title }}" style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $relatedBlog->title }}</h5>
                            <a href="{{ route('blogs.show', $relatedBlog->id) }}" class="stretched-link text-warning mt-auto">Прочитај повеќе</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Blogs Related To This Blog Section (Optional) -->
    @if ($blogsRelatedTo->isNotEmpty())
        <div class="related-blogs mt-5">
            <h3 class="mb-4">Блогови кои се поврзани со овој блог</h3>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($blogsRelatedTo as $relatedBlog)
                    <div class="col">
                        <div class="card shadow-sm rounded-4 overflow-hidden h-100 border-0">
                            <div class="position-relative">
                                <img src="{{ $relatedBlog->image_url ?? 'https://picsum.photos/600/400' }}" class="card-img-top" alt="{{ $relatedBlog->title }}" style="height: 200px; object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $relatedBlog->title }}</h5>
                                <a href="{{ route('blogs.show', $relatedBlog->id) }}" class="stretched-link text-warning mt-auto">Прочитај повеќе</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>



<!-- Add Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Optional Custom CSS -->
<style>
    .img-fluid {
        border-radius: 20px;
    }

    .position-absolute p,
    .position-absolute h2 {
        margin: 0;
    }
</style>


@endsection