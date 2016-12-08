<!-- Modal -->
					<div class="modal fade" id="newDealModal" tabindex="-1" role="dialog" aria-labelledby="newDealModalLabel">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="newDealModalLabel">Add a New Deal</h4>
					      </div>
					      <form id="vendor-add-deal-form">
						      <div class="modal-body">
						        <div class="form-group">
							        <label>Deal Title</label>
							        <input type="text" name="title" placeholder="50% OFF" class="form-control">
						        </div>
						        <div class="form-group">
							        <label>Deal Tagline</label>
							        <input type="text" name="tagline" placeholder="The Bacon Cheeseburger Meal" class="form-control">
						        </div>
						        <div class="form-group">
							        <label>Describe the Deal</label>
							        <textarea name="description" class="form-control"></textarea>
						        </div>
						        <div class="form-group">
							        <label>The Fine Print</label>
							        <p class="help-block">legalities, restrictions, etc</p>
							        <textarea name="finePrint" class="form-control"></textarea>
							        
						        </div>
						        <div class="form-group">
							        <label>Redemption Instructions</label>
							        <p class="help-block">Instructions for the venue cashier to validate the deal, or for the VIP member to claim the deal at the venue, or both.</p>
							        <textarea name="redemptionInstructions" class="form-control"></textarea>
							        
						        </div>
						        <div class="form-group">
							        <label>Is this a Flash Deal?</label>
							        <p class="help-block">A flash deal is a deal that has an expiration date. If you add a date below, this deal will be a flash deal expiring on the chosen date. Otherwise, leave this field blank.</p>

							        <input type="text" class="datepicker form-control" name="expirationDate">
							    </div>
							    <div class="form-group">
							        <label>Large Image</label>
							        <p class="help-block">We use a 2000px wide by 600px tall image as your profile image if you have an active deal. Upload one here</p>
									<hr />
									<div id="dealLargeList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="deal-large-container">
									    <a id="pickLargePhoto" href="javascript:;" class="btn btn-default">Select Image</a> 
									    <a id="uploadLargePhoto" href="javascript:;" class="btn btn-success">Upload Image</a>
									</div>
									<hr />
							        <input type="hidden" id="largeImage" name="largeImage">
							    </div>
							    <div class="form-group">
							        <label>Square Image</label>
							        <p class="help-block">We use an 800px wide by 800px tall SQUARE image as the image that shows for your listing. Consider this your main deal image, so choose wisely.</p>
									<hr />
									<div id="dealSquareList">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="deal-square-container">
									    <a id="pickSquarePhoto" href="javascript:;" class="btn btn-default">Select Image</a> 
									    <a id="uploadSquarePhoto" href="javascript:;" class="btn btn-success">Upload Image</a>
									</div>
									<hr />
							        <input type="hidden" id="squareImage" name="squareImage">
							    </div>
						      </div>
						      <div class="modal-footer">
							    <input type="hidden" name="_token" value="{{ Session::get('_token') }}">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="submit" id="newDealSubmit"  class="btn btn-primary">Save changes</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>