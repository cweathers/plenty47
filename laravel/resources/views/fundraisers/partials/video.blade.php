						@if($fundraiser->videoLink)
						<div class='embed-container'>
							<iframe src='https://player.vimeo.com/video/{{$fundraiser->videoLink}}' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
						@endif()