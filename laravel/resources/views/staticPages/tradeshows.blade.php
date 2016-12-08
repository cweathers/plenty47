@extends('app')
@section('content')
		
		<!-- Hero -->
		<section class="hero" style="background: url({{ asset ('assets/img/vendor-hero.png')}}) no-repeat center top;background-size:cover;">
			<h1>Trade Show Organizations</h1>
			<span class="hero-text">
				<p>Register your business or trade show organization with our free merchant directory and get connected with exclusive marketing, advertising and sponsorship opportunities within your community! Plus, our VIP members LOVE trying out new merchants. Offer a standing daily incentive deal and occasional flash deals and watch your business explode. Also, take advantage of partnering with Plenty4/7 during our pre-launch phase and lock into exclusive early bird (premium) merchant rates. Learn more about our preferred merchant program.</p>
			</span>
			<div class="hero-btns">
				<a href="/merchant-signup" class="btn btn-lg btn-white">apply now</a>
			</div>
		</section>
		<!-- End Hero -->
		
		<!-- Who's Using P4/7 -->
		<section class="using">
			Who's using Plenty4/7?
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
							<span class="tc-lg">Restaurants and Cafes</span>
							<img src="{{ asset ('assets/img/icons/vendor-left.png') }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/vendor-left.png') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Family Fun Activities</span>
							<img src="{{ asset ('assets/img/icons/vendor-left-mid.png') }}" alt="merchants" class="pull-right" width="60" height="60">

						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/vendor-left-mid.png') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Spas and Gift Ideas</span>
							<img src="{{ asset ('assets/img/icons/vendor-right-mid.png') }}" alt="merchants" class="pull-right" width="60" height="60">
						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/vendor-right-mid.png') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="tc gray">
						<div class="tcp">
							<span class="tc-small">great for</span>
							<span class="tc-lg">Local Services and More</span>
							<img src="{{ asset ('assets/img/icons/vendor-right.png') }}" alt="merchants" class="pull-right" width="60" height="60">

						</div>
						<span class="clearfix"></span>
						<div class="tc-img" style="background:url({{ asset ('assets/img/vendor-right.png') }}) no-repeat center top;background-size:cover"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<!-- End Great For... -->
		
		<section class="content white pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">WE’LL MARKET YOUR BUSINESS AT A SAFE, AFFORDABLE & MEASURED PACE.<span></span></span>
				</div>
				<div class="col-md-6">
					<p>Plenty4/7 is the Right Advertising Choice! We'll Market Your Business at a Safe, Affordable and Measured Pace.</p>
					<p>Our program is designed to steadily drive new customers to you and then convert them into loyal patrons. Sending one-time flockers is not our approach. Everything we do is intended to steer, motivate and encourage loyalty with your business, brand or service all while being socially-conscious.</p>
					<p>Regardless of size, Plenty4/7 has viable solutions to effectively market your business as well as strategically partner you within your local community through our Preferred Merchant Program.</p>
				</div>
			</div>
		</section>
		
		<section class="content gray pad100">
			<div class="row">
				<div class="col-md-6">
					<div class="text-center">
						<img src="{{asset ('assets/img/icons/seven.png')}}" class="img-responsive ib">
					</div>
					<span class="half-title">Key Features of Working With Plenty4/7.<span></span></span>
				</div>
				<div class="col-md-6">
					<ul class="feature-list">
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">1</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Merchant Directory Page</strong><br />
Plenty4/7 will set up a beautiful, full merchant directory page that we will promote to our free subscribers and VIP Members on your behalf free of charge.</p>
								</div>
							</div>
						</li>
 						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">2</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Create Loyalty-Inducing Everyday Deals</strong><br />
Ability to create an everyday standing deal that Plenty4/7 will feature via e-mail, SMS (texts) and social media blasts to VIP Members.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">3</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Flash Deals & Vouchers</strong><br /> 
Ability to create discounted vouchers (with no revenue splitting or sharing) to a vast pool of VIP members. </p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">4</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Community Engagement</strong><br /> 
Access to exclusive sponsorship opportunities with youth sports teams, school athletic teams or groups/clubs, religious groups and charitable organizations in your vicinity.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">5</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Contest Participation</strong><br /> 
Ability to participate in Plenty4/7 contests strategically designed to drive VIP member traffic to merchants.</p>
								</div>
							</div>
						</li> 
 						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">6</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Networking & Webinars</strong><br /> 
Access to exclusive networking opportunities as well as webinar Q&As with industry leaders in small business marketing, merchandising, retail management, food distribution, tax accounting services and MORE to help grow your business.</p>
								</div>
							</div>
						</li> 
						<li>
							<div class="row">
								<div class="col-xs-2">
									<span class="number">7</span>
								</div>
								<div class="col-xs-10">
									<p><strong>Serving Community Fundraising Groups</strong><br />
A large quantity of Plenty4/7 VIP Member cards will be sold by community fundraising groups such as school athletic teams or clubs, religious organizations, youth sports teams, etc. Participating merchants will be providing discounts for parents, students and youth in their communities that will appreciate it the most!</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		
		<section class="table-top pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">Your Advertising<br />Results Matter.<span class="orange"></span></span>
					<span class="clearfix"></span>
				</div>
				<div class="col-md-6">
					<p>Let’s be honest, operating a business is expensive and decisions about where to spend limited advertising dollars require much thought and consideration. Newspaper, radio and television advertising can yield mixed results even IF you have a size-able budget to run ads during peak times or inside publications with wide, diverse audiences. Daily deal services could ‘potentially’ generate an influx of revenue in an instant. However, once the dust settles, will the operating expenses sacrificed to run the deal dwarf the revenue it generated? Additionally, will deal seekers want to ever come back to your business and pay full price for the same service? With Plenty4/7 these concerns are non-existent. That is why we are confident that our approach is the safe, sound and effective advertising choice for merchant businesses of all sizes and types.</p>
				</div>
			</div>
		</section>
		
		<section class="content white pad100">
			<div class="row">
				<div class="col-md-6">
					<span class="half-title">Nothing but respect for you!<span></span></span>
				</div>
				<div class="col-md-6">
					<p>We have the utmost respect for merchants. The grind, grit and determination you demonstrate each and every day operating your own independent business, service or franchise is what we admire the most. Honestly, we are just like you. That is why we have carefully crafted our merchant marketing program to provide a sustainable and healthy stream of loyal customers for you.</p>
				</div>
			</div>
		</section>
		
		<section class="vendorCta">
			<span>Get your business listed on Plenty4/7 Today!</span> <a href="/merchant-signup" class="">sign up</a>
		</section>

@stop()