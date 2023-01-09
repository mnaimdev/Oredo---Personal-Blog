@extends('frontend.master')

@section('content')
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>{{ $category_info->category_name }}
                            </h1>
                            <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Category Post
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog-layout-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--post 1-->
                    @forelse ($category_posts as $category_post)
                        <div class="post-list post-list-style2">
                            <div class="post-list-image">
                                <a href="post-single.html">
                                    <img src="{{ asset('/uploads/post') }}/{{ $category_post->feat_image }}" alt="">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <h3 class="entry-title">
                                    <a href="post-single.html">
                                        {{ $category_post->title }}
                                    </a>
                                </h3>
                                <ul class="entry-meta">
                                    <li class="post-author-img"><img
                                            src="{{ asset('/uploads/users') }}/{{ $category_post->rel_to_user->image }}"
                                            alt=""></li>
                                    <li class="post-author"> <a
                                            href="{{ route('author.post', $category_post->author_id) }}">{{ $category_post->rel_to_user->name }}</a>
                                    </li>
                                    <li class="entry-cat"> <a
                                            href="{{ route('category.post', $category_post->category_id) }}"
                                            class="category-style-1 "> <span class="line"></span>
                                            {{ $category_post->rel_to_category->category_name }}</a></li>
                                    <li class="post-date"> <span class="line"></span>
                                        {{ $category_post->created_at->format('M d, Y') }}
                                    </li>
                                </ul>
                                <div class="post-exerpt">
                                    <p>{{ $category_post->short_desp }}
                                    </p>
                                </div>
                                <div class="post-btn">
                                    <a href="post-single.html" class="btn-read-more">Continue Reading <i
                                            class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="post-list post-list-style2">
                            <h4 class="text-danger text-center">No Post Found</h4>
                        </div>
                    @endforelse
                    <div>
                        {{ $category_posts->links('vendor.pagination.custom_pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
