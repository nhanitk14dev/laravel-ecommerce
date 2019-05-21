@if (count($blogs) >0)
<!-- Blog -->
<section class="blog-post-wrapper">
  <div class="container">
    <div class="best-title text-left">
      <h2>Blog Alo Chip</h2>
    </div>
    <div class="slider-items-products ">
      <div id="latest-news-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col6">
          @foreach ($blogs as $blog)
          <div class="item">
            <div class="blog-box"> <a href="{{ url('blog/'.ktc_str_convert($blog->title).'_'.$blog->id.'.html') }}"> <img class="primary-img" src="{{ asset('documents/website/thumb/'.$blog->image) }}" alt="{{ $blog->title }}"></a>
              <div class="blog-btm-desc">
                <div class="blog-top-desc">
                  <div class="blog-date"> {{ date('Y M D',strtotime($blog->created_at)) }} </div>
                  <h4><a href="{{ url('blog/'.ktc_str_convert($blog->title).'_'.$blog->id.'.html') }}">{{ $blog->title }}</a></h4>
                </div>
                <p>{{ $blog->description }}</p>
                <a class="read-more" href="{{ url('blog/'.ktc_str_convert($blog->title).'_'.$blog->id.'.html') }}"> Xem đầy đủ</a> </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  @endif