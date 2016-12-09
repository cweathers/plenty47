@extends('app')
@section('content')

		@if($content->top_section_button_link_2) 
		<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-body">
		        <div class='embed-container'><iframe src='https://player.vimeo.com/video/{{$content->top_section_button_link_2}}' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
		      </div>
		    </div>
		  </div>
		</div>
		@endif()
		
		<!-- Hero -->
		<section class="hero" style="background: url({{ asset ('/contentUploads/'.$content->top_section_image)}}) no-repeat center top;background-size:cover;">
			<h1>{{$content->top_section_heading}}</h1>
			@if($content->top_section_subheading)
			<h2>{{$content->top_section_subheading}}</h2>
			@endif()
			<span class="hero-text">
				{{$content->top_section_text}}
			</span>
			<div class="hero-btns">
				@if($content->top_section_button_text_2) 
			    <a href="#" data-toggle="modal" data-target="#videoModal" class="btn btn-outline">{{$content->top_section_button_text_2}}&nbsp;&nbsp;<img src="assets/img/play-button-25.png" /></a> 
			    @endif()
				<a href="{{$content->top_section_button_link}}" class="btn btn-lg btn-white">{{$content->top_section_button_text}}</a>
			</div>
		</section>
		<!-- End Hero -->
		
		<!-- Who's Using P4/7 -->
		<section class="using">
			{{$content->blue_section_heading}}
			<span><img src="{{ asset ('assets/img/icons/angle-down.png') }}" alt="" width="70" height="20"></span>
		</section>
		<!-- End Who's Using P4/7 -->
		
		<!-- Great For... -->
		<section class="content noPad white greatFor">
			<div class="col-md-3">
				<div class="row">
					<div class="tc">
						<div class="tcp">
							<span class="tc-small">{{$content->qs_left_heading}}</span>
							<span class="tc-lg">{{$content->qs_left_subheading}}</span>
							<img src="{{ asset ('/contentUploads/'.$content->qs_left_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('/contentUploads/'.$content->qs_left_image) }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">{{$content->qs_leftMiddle_heading}}</span>
							<span class="tc-lg">{{$content->qs_leftMiddle_subheading}}</span>
							<img src="{{ asset ('/contentUploads/'.$content->qs_leftMiddle_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('/contentUploads/'.$content->qs_leftMiddle_image) }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc">
						<div class="tcp">
							<span class="tc-small">{{$content->qs_rightMiddle_heading}}</span>
							<span class="tc-lg">{{$content->qs_rightMiddle_subheading}}</span>
							<img src="{{ asset ('/contentUploads/'.$content->qs_rightMiddle_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('/contentUploads/'.$content->qs_rightMiddle_image) }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">{{$content->qs_right_heading}}</span>
							<span class="tc-lg">{{$content->qs_right_subheading}}</span>
							<img src="{{ asset ('/contentUploads/'.$content->qs_right_icon) }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('/contentUploads/'.$content->qs_right_image) }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<!-- End Great For... -->
		
		@if($content->extra_section_active == 1)
		<section class="content {{$content->extra_section_bg_color}} pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">{{$content->extra_section_left}}<span></span></span>
				</div>
				<div class="col-md-6">
					{{$content->extra_section_right}}
				</div>
			</div>
		</section>
		@endif()
		
		@if($content->bottom_section_active == 1)
		<section class="content {{$content->bottom_section_bg_color}} pad100">
			<div class="row">
				<div class="col-md-6">
					@if($content->bottom_section_left_image)
					<div class="text-center">
						<img src="{{asset ('/contentUploads/'.$content->bottom_section_left_image)}}" class="img-responsive ib">
					</div>
					@endif()
					<span class="half-title">{{$content->bottom_section_left}}<span></span></span>
				</div>
				<div class="col-md-6">
					<ul class="feature-list">
						<?php $i = 1; ?>
						@foreach($lists as $list)
						<li>
							<div class="row">
								<div class="col-xs-2">
									
									<span class="number">@if($list->show_number) {{$i}} @endif()</span>
								</div>
								<div class="col-xs-10">
									{!! $list->content !!}
								</div>
							</div>
						</li>
						<?php $i++; ?>
						@endforeach()
					</ul>
				</div>
			</div>
		</section>
		@endif()
		
		@if($content->bottom_bg_section_active == 1)
		<section class="pad100" style="background: url({{asset ('/contentUploads/'.$content->bottom_bg_section_image)}}) no-repeat center center;background-size:cover;">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">{{$content->bottom_bg_section_left}}<span class="orange"></span></span>
					<span class="clearfix"></span>
				</div>
				<div class="col-md-6">
					{{$content->bottom_bg_section_right}}
				</div>
			</div>
		</section>
		@endif()
		
		@if($content->last_section_active == 1)
		<section class="content white pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">{{$content->last_section_left}}<span></span></span>
				</div>
				<div class="col-md-6">
					{{$content->last_section_right}}
				</div>
			</div>
		</section>
		@endif()
		
		<section class="vendorCta">
			<span>Get your business listed on Plenty4/7 Today!</span> <a href="/merchant-signup" class="">sign up</a>
		</section>

@stop()