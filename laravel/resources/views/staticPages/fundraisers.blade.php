@extends('app')
@section('content')
		
		<!-- Hero -->
		<section class="hero" style="background: url({{ asset ('assets/img/fundraiser-hero.jpg')}}) no-repeat center top;background-size:cover;">
			<h1>Become a Fundraising Group</h1>
			<h2>With P4/7 Today</h2>
			<span class="hero-text">
				<p>A successful fundraiser begins with having a great product. Plenty4/7 VIP Member cards make strong and profitable fundraisers. Unlike most merchant discount programs, our cards are not restricted to a limited cluster of 15-20 merchants in your local vicinity. Our network is expansive and our cards can be used anywhere either locally or nationally at participating merchant locations. Learn how your organization can earn 70%+ profits with no upfront fees fundraising with Plenty4/7.</p>
			</span>
			<div class="hero-btns">
				<a href="/fundraiser-signup" class="btn btn-lg btn-white">apply now</a>
			</div>
		</section>
		<!-- End Hero -->
		
		<!-- Who's Using P4/7 -->
		<section class="using">
			Why Use Plenty4/7?
			<span><img src="{{ asset ('assets/img/icons/angle-down.png') }}" alt="" width="70" height="20"></span>
		</section>
		<!-- End Who's Using P4/7 -->
		
		<!-- Great For... -->
		<section class="content noPad white greatFor">
			<div class="col-md-3">
				<div class="row">
					<div class="tc">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Youth Sports Teams</span>
							<img src="{{ asset ('assets/img/icons/soccer-ball.png') }}" alt="youth sports teams" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/fr-01.jpg') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">School Fundraising Groups</span>
							<img src="{{ asset ('assets/img/icons/schools.png') }}" alt="school fundraising groups" class="pull-right" width="60" height="60">

						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/fr-02.jpg') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Religious Organizations</span>
							<img src="{{ asset ('assets/img/icons/church.png') }}" alt="religious organizations" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/fr-03.jpg') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Family Reunions &amp; More</span>
							<img src="{{ asset ('assets/img/icons/plane.png') }}" alt="family reunions" class="pull-right" width="60" height="60">

						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/fr-04.jpg') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<!-- End Great For... -->
		
		<section class="content white pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title pad-top-list">Plenty4/7 Is the Perfect Choice For Your Next Fundraiser.<span></span></span>
				</div>
				<div class="col-md-6">
					<ul class="feature-list">
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>Earn up to 70% profit on your fundraising campaign.</p>
								</div>
							</div>
						</li>
 						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>Ability to promote your fundraising campaign offline and online.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>VIP Member cards can be used nationally at all participating Plenty4/7 merchants, making it possible for sellers to promote cards with non-locals.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>If Plenty4/7 is not currently fully marketed in your area, we can have a marketable card for your region within 4-6 weeks.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>No upfront fees or deposits to begin fundraising campaign.</p>
								</div>
							</div>
						</li> 
 						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>Ability to return unsold cards without penalty.</p>
								</div>
							</div>
						</li> 
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number"></span>
								</div>
								<div class="col-xs-10">
									<p>Annually earn residual fundraising income from renewing VIP Members.</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		
		<section class="vendorCta">
			<span>Start Raising Funds With Plenty4/7 Today!</span> <a href="/fundraiser-signup" class="">sign up</a>
		</section>

@stop()