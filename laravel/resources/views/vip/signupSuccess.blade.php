@extends('app')
@section('content')

<section class="content gray pad100 compTop hidden-xs">
	<div class="text-center rel">
		<div class="steps">
			<ul>
				<li>
					<a href="/vip-signup/account-info">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Account Setup</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Payment Info</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Choose Fundraiser</span>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Overview</span>
					</a>
				</li>
				<li class="active">
					<a href="#">
						<div class="sc-wrap">
							<span class="step-circle"><i class="fa fa-circle"></i></span>
						</div>
						<span class="step-name">Success</span>
					</a>
				</li>
			</ul>
		</div>
		<span class="step-line"></span>
	</div>
</section>

<section class="signup-container content white pad100">
	<div class="row">
		<div class="flex">
			<div class="col-sm-12 col-md-12 col-lg-3">
				<div class="signup-side">
					<span class="orange-title">VIP Member Sign Up</span>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-9">
				<div class="signup-line">
					<div class="text-center">
						<h1 class="success-heading">It's Official!</h1>
						
						<div class="success-box">
							<p>YOU ARE NOW OFFICIALLY A VIP MEMBER!<br />A confirmation email should arrive <br />in your inbox shortly.</p>
							<p><a href="/" class="btn btn-lg btn-primary"><i class="fa fa-search"></i> find some deals</a></p>
							<p><a href="/my-account" class="black">go to my account</a>
						</div>
						
						<div class="success-share">
							<p>Share the news on your social media! <img src="{{asset ('assets/img/success-share.png')}}" class="s-share" width="15" height="15" alt="share"></p>
							<ul class="psb-icons success">
								<li><a href="https://plus.google.com/share?url={{url()}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="https://twitter.com/home?status=check%20out%20this%20deal%3A%20{{url()}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()}}&title=Awesome%20deals%20from%20P4/7&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@stop()