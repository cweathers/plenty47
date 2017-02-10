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
				<p>Upload some photos of your products, services, office building or anything you would like people browsing your merchant profile to see.</p>
				<div id="profileImageList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
				<br />
				
				<div id="container">
				    <a id="pickProfileImage" href="javascript:;" class="btn btn-default">Select Photos</a> 
				    <a id="uploadProfileImage" href="javascript:;" class="btn btn-success">Upload</a>
				</div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<section class="merchant-hero compTop" style="background: url( {{$profileImage}} ) no-repeat center top;background-size:cover;">
	<div class="mh-sidebar">
		@include('merchant.partials.mhSidebar')
	</div>
	<div class="clearfix"></div>
	<div class="mh-bot">
		<div class="mhb-left">
			<div class="hidden-lg lg-btns">
				<a href="#" class="btn blue merchant-editProfileImage" data-toggle="modal" data-target="#profileImageModal"><i class="fa fa-gear"></i> Edit Profile Image</a>
			</div>
		</div>
		<div class="mh-rel">
			<div class="mhb-right visible-lg">
				<a href="#" class="btn blue merchant-editProfileImage" data-toggle="modal" data-target="#profileImageModal"><i class="fa fa-gear"></i> Edit Profile Image</a>
			</div>
		</div>
	</div>
</section>
