<!-- Modal -->
<div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="profileImageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="profileImageModalLabel">Upload/Change Profile Image</h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-12">
				<p>Upload some photos of anything you would like people browsing your fundraising profile to see.</p>
				<div id="fr-profileImageList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
				<br />
				
				<div id="fr-container">
				    <a id="fr-pickProfileImage" href="javascript:;" class="btn btn-default">Select Photos</a> 
				    <a id="fr-uploadProfileImage" href="javascript:;" class="btn btn-success">Upload Profile Image</a>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<section class="merchant-hero fund-min compTop" style="background: url( {{$profileImage}} ) no-repeat center top;background-size:cover;">
	<a href="#" class="fundraiser-editDetails" data-toggle="modal" data-target="#profileDetailsModal"><i class="fa fa-gear fa-2x"></i></a>
	<div class="clearfix"></div>
	<div class="frh-left">
		@if($fundraiser->logo)
		<img src="{{asset ('uploads/'.$fundraiser->logo)}}" class="fundraiser-logo currentLogo">
		@else()
		<img src="{{asset ('assets/img/default-logo.jpg')}}" class="fundraiser-logo currentLogo">
		@endif()
		
		<div id="fr-dets">
			@include('fundraisers.partials.dets')
		</div>
	</div>
	<span class="clearfix"></span>
	<div class="frh-right">
		<span class="frh-pitch">Support us with the purchase of a VIP Card!</span>
		<a href="/vip-signup?fundraiser={{$fundraiser->id}}" class="btn btn-lg green">sign up</a>
		<span class="clearfix"></span>
	</div>
</section>