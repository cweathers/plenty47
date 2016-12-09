<div class="clearfix"></div>
<div id="hero-carousel" class="carousel slide" data-ride="carousel" data-interval="20000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#hero-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#hero-carousel" data-slide-to="1"></li>
    <li data-target="#hero-carousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
	  
	  
    <div class="item active" style="background:url({{ asset ('/contentUploads/'.$content->slide_1_bg_image) }}) no-repeat center center;background-size: cover;">
      <div class="hero-content right">
	      <span class="hero-lg">{{$content->slide_1_heading}}</span>
	      <span class="hero-sm">{{$content->slide_1_subheading}}</span>
	      <span class="hero-tag">{{$content->slide_1_text}}</span>
	      <a href="/vip-signup" class="btn btn-white">join now</a> <a href="#" class="launchVideo btn btn-outline" data-video-id="153868487">how it works &nbsp;&nbsp; <img src="assets/img/play-button-25.png" /></a>
      </div>
    </div>
    
    <div class="item" style="background:url({{asset ('/contentUploads/'.$content->slide_2_bg_image) }}) no-repeat center center;background-size: cover;">
      <div class="hero-content left">
	      <span class="hero-lg">{{$content->slide_2_heading}}</span>
	      <span class="hero-sm">{{$content->slide_2_subheading}}</span>
	      <span class="hero-tag">{{$content->slide_2_text}}</span>
	       <a href="/fundraiser-signup" class="btn btn-white">join now</a> <a href="#" class="launchVideo btn btn-outline" data-video-id="153868487">how it works &nbsp;&nbsp; <img src="assets/img/play-button-25.png" /></a>
      </div>
    </div>
    
    <div class="item" style="background:url({{ asset ('/contentUploads/'.$content->slide_3_bg_image) }}) no-repeat center center;background-size: cover;">
      <div class="hero-content right">
	      <span class="hero-lg">{{$content->slide_3_heading}}</span>
	      <span class="hero-sm">{{$content->slide_3_subheading}}</span>
	      <span class="hero-tag">{{$content->slide_3_text}}</span>
	      <a href="/merchant-signup" class="btn btn-white">join now</a> <a href="#" class="launchVideo btn btn-outline" data-video-id="153868487">benefits &nbsp;&nbsp; <img src="assets/img/play-button-25.png" /></a>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#hero-carousel" role="button" data-slide="prev">
    <img src="{{ asset ('assets/img/icons/slider-prev.png') }}" alt="previous slide" width="10" height="26">
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#hero-carousel" role="button" data-slide="next">
    <img src="{{ asset ('assets/img/icons/slider-next.png') }}" alt="next slide" width="10" height="26">
    <span class="sr-only">Next</span>
  </a>
</div>
