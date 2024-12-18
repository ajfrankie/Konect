<!doctype html>
<html lang="zxx">

@include('layout.head')

<body>
    <!--::header part start::-->
    @include('layout.header')
    <!-- Header part end-->

    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Shop Single</h2>
                            <p>Home <span>-</span> Shop Single</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end-->

    <!--================Blog Area =================-->
    <section class="blog_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @foreach($posts as $post)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" style="height:600px; width:600px;" src="{{ Storage::url($post->image) }}" alt="Post Image">
                                <a href="#" class="blog_item_date">
                                    <h3>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</h3>
                                    <p>{{ \Carbon\Carbon::parse($post->created_at)->format('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{ route('posts.show', $post->id) }}">
                                    <h2>{{ $post->subject }}</h2>
                                </a>
                                <p>{{ Str::limit($post->Content) }}</p>
                                <ul class="blog-info-link">
                                    <li><a href="{{ route('posts.edit', $post->id) }}"><i class="far fa-user"></i>Edit</a></li>
                                    <li>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none; background:none; color:#007bff;">
                                                <i class="far fa-comments"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                    <li><a href="{{ route('posts.edit', $post->id) }}"><i class="far fa-comments"></i>Update</a></li>
                                </ul>
                            </div>
                        </article>
                        @endforeach

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-4">
                    @include('layout.sidebar')
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!--::footer_part start::-->
    @include('layout.footer')
    <!--::footer_part end-->

    @include('layout.script')
</body>
</html>
