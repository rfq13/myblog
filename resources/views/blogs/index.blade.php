@extends('layouts')
@section('content')
<section id="blog" class="blog">
  <div class="container">
    <div class="row">
        <div class="col-lg-8 entries">

          <div class="row">
            @php
                $posts = \App\Models\Post::paginate(6);
            @endphp
            @foreach ($posts as $key => $post)
              <div class="col-md-6 d-flex align-items-stretch">
                <article class="entry">

                  <div class="entry-img">
                    <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
                  </div>

                  <h2 class="entry-title">
                    <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</a>
                  </h2>

                  <div class="entry-meta">
                    <ul>
                      <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                      <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                    </ul>
                  </div>

                  <div class="entry-content">
                    <p>
                      Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta zena prista maraeda talan mas indera.
                    </p>
                    <div class="read-more">
                      <a href="blog-single.html">Read More</a>
                    </div>
                  </div>

                </article><!-- End blog entry -->
              </div>
            @endforeach

            {{-- <div class="col-md-6 d-flex align-items-stretch">
              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/blog-2.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="blog-single.html">Nisi magni odit consequatur autem nulla dolorem</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    Ad impedit qui officiis est in non aliquid veniam laborum. Id ipsum qui aut. Sit aliquam et quia molestias laboriosam. Tempora nam odit omnis eum corrupti qui aliquid excepturi molestiae. Facilis et sint quos sed voluptas. Maxime sed tempore enim omnis non alias.
                  </p>
                  <div class="read-more">
                    <a href="blog-single.html">Read More</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </div>

            <div class="col-md-6 d-flex align-items-stretch">
              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/blog-3.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="blog-single.html">Possimus soluta ut id suscipit ea ut. In quo quia et soluta libero sit sint.</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    Aut iste neque ut illum qui perspiciatis similique recusandae non. Fugit autem dolorem labore omnis et. Eum temporibus fugiat voluptate enim tenetur sunt omnis tara kero pakla metaruna nedore stan.
                  </p>
                  <div class="read-more">
                    <a href="blog-single.html">Read More</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </div>

            <div class="col-md-6 d-flex align-items-stretch">
              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/blog-4.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="blog-single.html">Non rem rerum nam cum quo minus. Dolor distinctio deleniti explicabo eius exercitationem.</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    Aspernatur rerum perferendis et sint. Voluptates cupiditate voluptas atque quae. Rem veritatis rerum enim et autem. Saepe atque cum eligendi eaque iste omnis a qui.
                  </p>
                  <div class="read-more">
                    <a href="blog-single.html">Read More</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </div>

            <div class="col-md-6 d-flex align-items-stretch">
              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/blog-5.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="blog-single.html">Blanditiis dignissimos deleniti. Rerum iste et.</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    Quidem et eum explicabo quia illo numquam nostrum corrupti provident. Quia aspernatur et et facere. Quisquam maiores natus nihil incidunt ipsum est optio eum maxime. Dignissimos vitae explicabo. Corrupti esse sed a a. Laborum optio reprehenderit quia dena per.
                  </p>
                  <div class="read-more">
                    <a href="blog-single.html">Read More</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </div>

            <div class="col-md-6 d-flex align-items-stretch">
              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/blog-6.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="blog-single.html">Debitis cupiditate saepe ex quam aut id. Consequatur dignissimos et id id.</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    Modi dolor et placeat ut iure ad. Qui perferendis fugit quo et cumque facilis et debitis rerum. Repellendus animi qui eos. Unde perferendis et tempora Ratione porro omnis magn delata sera marto ned.
                  </p>
                  <div class="read-more">
                    <a href="blog-single.html">Read More</a>
                  </div>
                </div>

              </article><!-- End blog entry -->
            </div> --}}

          </div>

          <div class="blog-pagination">
            <ul class="justify-content-center">
              <li class="disabled"><i class="icofont-rounded-left"></i></li>
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
            </ul>
          </div>

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">

            <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>

            </div><!-- End sidebar search formn-->

            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>

            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              <div class="post-item clearfix">
                <img src="{{ asset('public/assets/img/blog-recent-1.jpg') }}" alt="">
                <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="{{ asset('public/assets/img/blog-recent-2.jpg') }}" alt="">
                <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="{{ asset('public/assets/img/blog-recent-3.jpg') }}" alt="">
                <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="{{ asset('public/assets/img/blog-recent-4.jpg') }}" alt="">
                <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="{{ asset('public/assets/img/blog-recent-5.jpg') }}" alt="">
                <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

            </div><!-- End sidebar recent posts-->

            <h3 class="sidebar-title">Tags</h3>
            <div class="sidebar-item tags">
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!-- End sidebar tags-->

          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

    </div>
  </div>
</section>
@endsection