<div class="container mt-5">
    <div class="row">
        <!-- Blog Content Section (Left Side) -->
        <div class="col-md-8">
            <!-- Blog Title -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Почетна</a></li>
                    <li class="breadcrumb-item"><a href="#">Блогови</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Блог Пост</li>
                </ol>
            </nav>

            <h1 class="fw-bold">{{ $blog->title }}</h1>
            <p class="text-muted">{{ $blog->created_at->format('d F, Y') }}</p>

            <!-- Blog Sections -->
            @foreach ($sections as $section)
                <div class="my-4" id="section-{{ $section->id }}">
                    <h3 class="fw-bold">{{ $section->section_title }}</h3>
                    <p>{{ $section->section_body }}</p>
                </div>
            @endforeach
            @livewire('blog-likes', ['blog' => $blog])

        </div>

        <!-- Author and Table of Contents (Right Side) -->
        <div class="col-md-4">
            <div class="p-3 mb-4">
                <!-- Author Information -->
                <div class="d-flex align-items-center">
                    <img src="{{ $blog->author->profile_image_url ?? 'https://via.placeholder.com/100' }}" alt="{{ $blog->author->name }}" class="rounded-circle me-3" width="100" height="100">
                    <div>
                        <h5 class="fw-bold">{{ $blog->author->name }}</h5>
                        <p class="text-muted">Следете ме на социјалните мрежи!</p>
                        <div class="d-flex">
                            <a href="{{ $blog->author->linkedin_url }}" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="{{ $blog->author->facebook_url }}" class="text-muted me-2"><i class="fab fa-facebook"></i></a>
                            <a href="{{ $blog->author->twitter_url }}" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table of Contents -->
            <div class="p-3">
                <h5 class="fw-bold">Кратка содржина</h5>
                <ul class="list-unstyled">
                    @foreach ($sections as $section)
                        <li class="py-1 border-bottom"><a href="#section-{{ $section->id }}" class="text-decoration-none">{{ $section->section_title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


