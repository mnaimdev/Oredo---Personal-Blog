@extends('frontend.master');

@section('content')
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title text-left">
                            <h2>Search resultats for : {{ @$_GET['q'] }}</h2>
                            <p class="desc">{{ $searched_posts->count() }} Articles were found for keyword <strong>
                                    {{ @$_GET['q'] }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--blog-layout-1-->
    <div class="blog-search">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        <!--Post1-->
                        @forelse ($searched_posts as $search_post)
                            <div class="post-list post-list-style1 pt-0">
                                <div class="post-list-image">
                                    <a href="{{ route('post.details', $search_post->slug) }}">
                                        <img src="{{ asset('/uploads/post') }}/{{ $search_post->feat_image }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="post-list-title">
                                    <div class="entry-title">
                                        <h5>
                                            <a href="{{ route('post.details', $search_post->slug) }}">
                                                {{ $search_post->title }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="post-list-category">
                                    <div class="entry-cat">
                                        <a href="blog-layout-1.html" class="category-style-1">
                                            {{ $search_post->rel_to_category->category_name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="post-list-title">
                                <div class="entry-title">
                                    <h5>
                                        No Results Found
                                    </h5>
                                </div>
                            </div>
                        @endforelse


                        <!--pagination-->
                        <div class="pagination">
                            <div class="pagination-area">
                                {{ $searched_posts->links() }}
                            </div>
                        </div>
                        <!--/-->
                    </div>
                </div>

                <!--sidebar-->
                <div class="col-lg-4 oredoo-sidebar">
                    <div class="theiaStickySidebar">
                        <div class="sidebar">

                        </div>

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
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress"
                                            required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">
                                        Subscribe now

                                    </button>
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
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/1.jpg" alt="">
                                            <small class="nb">1</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Everything is designed. Few things are designed
                                                well.</a>
                                        </p>
                                        <small> <span class="slash"></span> 3 mounth ago</small>

                                    </div>
                                </li>

                                <!--post2-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/5.jpg" alt="">
                                            <small class="nb">2</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Brand yourself for the career you want, not the
                                                job you </a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>

                                <!--post3-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/13.jpg" alt="">
                                            <small class="nb">3</small>

                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">It’s easier to ask forgiveness than it is to get
                                                permission.</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>

                                    </div>
                                </li>

                                <!--post4-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/16.jpg" alt="">
                                            <small class="nb">4</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">All happiness depends on a leisurely
                                                breakfast</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--Ads-->
                        <div class="widget">
                            <div class="widget-ads">
                                <img src="assets/img/ads/ads2.jpg" alt="">
                            </div>
                        </div>
                        <!--/-->
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
    </div>
@endsection

@section('footer_script')
    <script>
        const searchInput2 = document.querySelector(".search-input2");
        const searchBtn2 = document.querySelector(".search-btn2");
        searchBtn2.addEventListener("click", function(e) {
            const value = searchInput2.value;
            const link = "{{ route('search') }}" + "?q=" + value;
            location.href = link;
        });
    </script>
@endsection
