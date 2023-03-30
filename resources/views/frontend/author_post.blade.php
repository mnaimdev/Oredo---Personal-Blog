@extends('frontend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!--author-image-->
            <div class="col-lg-12 col-md-12 ">
                <div class="authors-info">
                    <div class="image">
                        <a href="{{ route('author.post', $author_info->id) }}" class="image">
                            <img src="{{ asset('/uploads/users') }}/{{ $author_info->image }}" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <h4>{{ $author_info->name }}</h4>
                        <p>
                            @if ($author_info->bio == null)
                            @else
                                {{ $author_info->bio }}
                            @endif

                        </p>
                        <div class="social-media">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </div>
    </section>


    <!-- blog-author-->
    <section class="blog-author mt-30">
        <div class="container-fluid">
            <div class="row">
                <!--content-->
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        <!--post1-->
                        @foreach ($author_posts as $author_post)
                            <div class="post-list post-list-style4 pt-0">
                                <div class="post-list-image">
                                    <a href="{{ route('post.details', $author_post->slug) }}">
                                        <img src="{{ asset('/uploads/post') }}/{{ $author_post->feat_image }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="post-list-content">
                                    <ul class="entry-meta">
                                        <li class="entry-cat">
                                            <a href="{{ route('category.post', $author_post->category_id) }}"
                                                class="category-style-1">
                                                {{ $author_post->rel_to_category->category_name }}
                                            </a>
                                        </li>
                                        <li class="post-date"> <span class="line"></span>
                                            {{ $author_post->created_at->format('M d, Y') }}
                                        </li>
                                    </ul>
                                    <h5 class="entry-title">
                                        <a href="{{ route('post.details', $author_post->slug) }}">
                                            {{ $author_post->title }}
                                        </a>
                                    </h5>
                                    <div class="post-btn">
                                        <a href="{{ route('post.details', $author_post->slug) }}"
                                            class="btn-read-more">Continue Reading <i
                                                class="las la-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--/-->
                    </div>
                </div>
                <!--/-->

                <!--Sidebar-->
                <div class="col-lg-4 oredoo-sidebar">
                    <div class="theiaStickySidebar">
                        <div class="sidebar">


                            <!--categories-->
                            <div class="widget ">
                                <div class="widget-title">
                                    <h5>Categories</h5>
                                </div>
                                <div class="widget-categories">
                                    @foreach ($categories as $category)
                                        <a class="category-item" href="{{ route('category.post', $category->id) }}">
                                            <div class="image">
                                                <img src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}"
                                                    alt="">
                                            </div>

                                            <p>{{ $category->category_name }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!--newslatter-->
                            <div class="widget widget-newsletter">
                                <h5>Subscribe To OurNewsletter</h5>
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
                                        <button class="btn-custom" type="submit"> Subscribe now</button>
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
                                            <a href="#"><i class="fab fa-facebook"></i></a>
                                            <p>Facebook</p>
                                        </div>

                                        <div class="item color-instagram">
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <p>instagram</p>
                                        </div>

                                        <div class="item color-twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <p>twitter</p>
                                        </div>

                                        <div class="item color-youtube">
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                            <p>Youtube</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Tags-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Tags</h5>
                                </div>
                                <div class="tags">
                                    <ul class="list-inline">
                                        @foreach ($tags as $tag)
                                            <li>
                                                <a href="#">{{ $tag->tag_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

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

                            <!--/-->
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </section>
@endsection
