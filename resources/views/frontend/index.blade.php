@extends('frontend.master')

@section('content')
    <!-- blog-slider-->
    <section class="blog blog-home4 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel">
                        @foreach ($slider_post as $slide)
                            <div class="blog-item"
                                style="background-image: url({{ asset('/uploads/post/' . $slide->feat_image) }})">
                                <div class="blog-banner">
                                    <div class="post-overly">
                                        <div class="post-overly-content">
                                            <div class="entry-cat">
                                                <a href="{{ route('category.post', $slide->category_id) }}"
                                                    class="category-style-2">
                                                    {{ $slide->rel_to_category->category_name }}
                                                </a>
                                            </div>
                                            <h2 class="entry-title">
                                                <a href="{{ route('post.details', $slide->slug) }}">
                                                    {{ $slide->title }}
                                                </a>
                                            </h2>
                                            <ul class="entry-meta">
                                                <li class="post-author"><a
                                                        href="{{ route('author.post', $slide->author_id) }}">
                                                        {{ $slide->rel_to_user->name }}
                                                    </a>
                                                </li>
                                                <li class="post-date"> <span class="line">
                                                    </span>
                                                    {{ $slide->created_at->format('M d, Y') }}
                                                </li>
                                                <li class="post-timeread"> <span class="line"></span>
                                                    {{ $slide->created_at->diffForHumans() }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top categories-->
    <div class="categories">
        <div class="container-fluid">
            <div class="categories-area">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="categories-items">
                            @foreach ($categories as $category)
                                <a class="category-item" href="{{ route('category.post', $category->id) }}">
                                    <div class="image">
                                        <img src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}"
                                            alt="">
                                    </div>
                                    <p>{{ $category->category_name }}
                                        <span>{{ App\Models\Post::where('category_id', $category->id)->count() }}</span>
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent articles-->
    <section class="section-feature-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        <div class="section-title">
                            <h3>recent Articles </h3>
                            <p>Discover the most outstanding articles in all topics of life.</p>
                        </div>

                        <!--post1-->
                        @foreach ($recent_posts as $recent_post)
                            <div class="post-list post-list-style4">
                                <div class="post-list-image">
                                    <a href="{{ route('post.details', $recent_post->slug) }}">
                                        <img src="{{ asset('/uploads/post') }}/{{ $recent_post->feat_image }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="post-list-content">
                                    <ul class="entry-meta">
                                        <li class="entry-cat">
                                            <a href="{{ route('category.post', $recent_post->category_id) }}"
                                                class="category-style-1">
                                                {{ $recent_post->rel_to_category->category_name }}
                                            </a>
                                        </li>
                                        <li class="post-date"> <span class="line"></span>
                                            {{ $recent_post->created_at->format('M d, Y') }}
                                        </li>
                                    </ul>
                                    <h5 class="entry-title">
                                        <a href="{{ route('post.details', $recent_post->slug) }}">
                                            {{ $recent_post->title }}
                                        </a>
                                    </h5>

                                    <div class="post-btn">
                                        <a href="{{ route('post.details', $recent_post->slug) }}"
                                            class="btn-read-more">Continue Reading <i
                                                class="las la-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--pagination-->
                        {{ $recent_posts->links('vendor.pagination.custom_pagination') }}

                    </div>
                </div>

                <!--Sidebar-->
                <div class="col-lg-4 oredoo-sidebar">
                    <div class="theiaStickySidebar">
                        <div class="sidebar">


                            <!--popular-posts-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>popular Posts</h5>
                                </div>

                                <ul class="widget-popular-posts">
                                    <!--post1-->

                                    @foreach ($popular_posts as $popular)
                                        <li class="small-post">
                                            <div class="small-post-image">
                                                <a href="post-single.html">
                                                    <img src="{{ asset('/uploads/post') }}/{{ $popular->rel_to_post->feat_image }}"
                                                        alt="">
                                                    <small class="nb">
                                                        {{ $popular->sum }}
                                                    </small>
                                                </a>
                                            </div>
                                            <div class="small-post-content">
                                                <p>
                                                    <a href="post-single.html">{{ $popular->rel_to_post->title }}</a>
                                                </p>
                                                <small> <span class="slash"></span>
                                                    {{ $popular->rel_to_post->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                            <!--newslatter-->
                            <div class="widget widget-newsletter">
                                <h5>Subscribe To Our Newsletter</h5>
                                <p>No spam, notifications only about new products, updates.</p>
                                <form action="{{ route('subscribe.store') }}" class="newslettre-form" method="post">
                                    @csrf
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Your Email Adress">
                                            @error('email')
                                                <strong class="text-danger">
                                                    {{ $message }}
                                                </strong>
                                            @enderror
                                        </div>
                                        <button class="btn-custom" type="submit">Subscribe now</button>
                                    </div>
                                </form>
                            </div>

                            <!--stay connected-->
                            <div class="widget ">
                                <div class="widget-title">
                                    <h5>Stay connected</h5>
                                </div>

                                <div class="widget-stay-connected">
                                    <div class="list">
                                        <div class="item color-facebook">
                                            <a href="https://www.facebook.com/mnaimdev" target="_blank"><i
                                                    class="fab fa-facebook"> Facebook</i></a>
                                        </div>

                                        <div class="item color-instagram">
                                            <a href="https://www.instagram.com/mohammadnaimkhan66/" target="_blank"><i
                                                    class="fab fa-instagram"> Instagram</i></a>

                                        </div>

                                        <div class="item color-twitter">
                                            <a href="https://twitter.com/mnaimdev" target="_blank"><i
                                                    class="fab fa-twitter"> Twitter</i></a>

                                        </div>

                                        <div class="item color-youtube">
                                            <a href="https://www.youtube.com/channel/UC_Ew5V5FHxBSux33r24dquw"
                                                target="_blank"><i class="fab fa-youtube"> Youtube</i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Tags-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Tags</h5>
                                </div>
                                <div class="widget-tags">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#">Travel</a>
                                        </li>
                                        <li>
                                            <a href="#">Nature</a>
                                        </li>
                                        <li>
                                            <a href="#">tips</a>
                                        </li>
                                        <li>
                                            <a href="#">forest</a>
                                        </li>
                                        <li>
                                            <a href="#">beach</a>
                                        </li>
                                        <li>
                                            <a href="#">fashion</a>
                                        </li>
                                        <li>
                                            <a href="#">livestyle</a>
                                        </li>
                                        <li>
                                            <a href="#">healty</a>
                                        </li>
                                        <li>
                                            <a href="#">food</a>
                                        </li>
                                        <li>
                                            <a href="#">interior</a>
                                        </li>
                                        <li>
                                            <a href="#">branding</a>
                                        </li>
                                        <li>
                                            <a href="#">web</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </section>
@endsection

@section('footer_script')
    @if (session('login_success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('login_success') }}',
            })
        </script>
    @endif
@endsection
