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


                        <!--post-single-comments-->
                        <div class="post-single-comments">
                            <!--Comments-->
                            @php
                                $val = 'Comment';
                            @endphp
                            <h4>{{ $comments->count() }}
                                {{ $comments->count() > 1 ? Str::plural($val) : $val }}
                            </h4>
                            <ul class="comments">
                                <!--comment1-->
                                @foreach ($comments as $comment)
                                    <li class="comment-item pt-0">
                                        @if ($comment->rel_to_guest->photo == null)
                                            <img src="{{ Avatar::create($comment->rel_to_guest->name)->toBase64() }}" />
                                        @else
                                            <img class="rounded-circle"
                                                src="{{ asset('/uploads/guest') }}/{{ $comment->rel_to_guest->photo }}"
                                                alt="">
                                        @endif
                                        <div class="content">
                                            <div class="meta">
                                                <ul class="list-inline">
                                                    <li><a href="#">
                                                            {{ $comment->rel_to_guest->name }}
                                                        </a> </li>
                                                    <li class="slash"></li>
                                                    <li>
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                            <a href="#reply" class="btn-reply" data-parent="{{ $comment->id }}"><i
                                                    class="las la-reply"></i> Reply</a>
                                        </div>
                                    </li>

                                    <!-- reply -->
                                    @foreach ($comment->replies as $reply)
                                        <li class="comment-item pt-0 ml-5">
                                            @if ($reply->rel_to_guest->photo == null)
                                                <img src="{{ Avatar::create($reply->rel_to_guest->name)->toBase64() }}" />
                                            @else
                                                <img class="rounded-circle"
                                                    src="{{ asset('/uploads/guest') }}/{{ $reply->rel_to_guest->photo }}"
                                                    alt="">
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a href="#">
                                                                {{ $reply->rel_to_guest->name }}
                                                            </a> </li>
                                                        <li class="slash"></li>
                                                        <li>
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p>
                                                    {{ $reply->comment }}
                                                </p>
                                                <a href="#reply" class="btn-reply"
                                                    data-parent="{{ $reply->parent_id }}"><i class="las la-reply"></i>
                                                    Reply</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endforeach

                            </ul>
                            <!--Leave-comments-->
                            @auth('guestlogin')
                                <div class="comments-form">
                                    <h4>Leave a Reply</h4>
                                    <!--form-->
                                    <form class="form" id="reply" action="{{ route('comment.store') }}" method="post">
                                        @csrf

                                        @if (session('comment'))
                                            <div class="alert alert-success">
                                                {{ session('comment') }}
                                            </div>
                                        @endif
                                        <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="post_id"
                                                        value="{{ $post_details->first()->id }}">
                                                    <input type="text" name="name" readonly class="form-control"
                                                        placeholder="Name*"
                                                        value="{{ Auth::guard('guestlogin')->user()->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" readonly class="form-control"
                                                        placeholder="Email*"
                                                        value="{{ Auth::guard('guestlogin')->user()->email }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="comment" cols="30" rows="5" class="form-control" placeholder="Comments*"
                                                        required="required"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn-custom ml-3">
                                                Send Comment
                                            </button>
                                            <input type="hidden" class="form-control parent" name="parent_id">
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mt-4 bg-primary p-3">
                                    <h3>Please login to leave a comment
                                        <a href="{{ route('guest.login') }}" class="float-right btn btn-primary">Login</a>
                                    </h3>
                                </div>
                            @endauth
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
