@extends('frontend.master')

@section('content')
    <section class="post-single">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <!--post-single-image-->
                    <div class="post-single-image">
                        @if ($post_details->first()->feat_image == null)
                            <img src="{{ Avatar::create($post_details->first()->rel_to_user->name)->toBase64() }}" />
                        @else
                            <img src="{{ asset('/uploads/post') }}/{{ $post_details->first()->feat_image }}" alt="">
                        @endif

                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2>
                                {{ $post_details->first()->title }}
                            </h2>
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    @if ($post_details->first()->rel_to_user->image == null)
                                        <img
                                            src="{{ Avatar::create($post_details->first()->rel_to_user->name)->toBase64() }}" />
                                    @else
                                        <img src="{{ asset('/uploads/users') }}/{{ $post_details->first()->rel_to_user->image }}"
                                            alt="">
                                    @endif


                                </li>
                                <li class="post-author"> <a
                                        href="{{ route('author.post', $post_details->first()->author_id) }}">
                                        {{ $post_details->first()->rel_to_user->name }}
                                    </a></li>
                                <li class="entry-cat"> <a
                                        href="{{ route('category.post', $post_details->first()->category_id) }}"
                                        class="category-style-1 "> <span class="line"></span>
                                        {{ $post_details->first()->rel_to_category->category_name }}</a></li>
                                <li class="post-date"> <span class="line"></span>
                                    {{ $post_details->first()->created_at->format('M d, Y') }}
                                </li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            <p>
                                {!! $post_details->first()->desp !!}
                            </p>
                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    @php
                                        $after_explode = explode(',', $post_details->first()->tag_id);
                                    @endphp
                                    @foreach ($after_explode as $tag)
                                        @php
                                            $tag_items = App\Models\Tag::where('id', $tag)->get();
                                        @endphp
                                        @foreach ($tag_items as $tag_item)
                                            <li>
                                                <a href="">{{ $tag_item->tag_name }}</a>
                                            </li>
                                        @endforeach
                                    @endforeach

                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}"
                                            target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
                                            target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="{{ route('author.post', $post_details->first()->author_id) }}" class="image">
                                        @if ($post_details->first()->rel_to_user->image == null)
                                            <img
                                                src="{{ Avatar::create($post_details->first()->rel_to_user->name)->toBase64() }}" />
                                        @else
                                            <img src="{{ asset('/uploads/users') }}/{{ $post_details->first()->rel_to_user->image }}"
                                                alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>{{ $post_details->first()->rel_to_user->name }}</h4>
                                    <p>
                                        @if ($post_details->first()->rel_to_user->bio == null)
                                        @else
                                            {{ $post_details->first()->rel_to_user->bio }}
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
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('footer_script')
    <script>
        $('.btn-reply').click(function() {
            var parent_id = $(this).attr('data-parent');
            $('.parent').attr('value', parent_id);
        });
    </script>
@endsection
