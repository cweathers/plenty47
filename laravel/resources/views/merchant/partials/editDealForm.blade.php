							<form id="vendor-edit-deal-form">
						      <div class="modal-body">
						        <div class="form-group">
							        <label>Deal Title</label>
							        <input type="text" name="title" placeholder="50% OFF" class="form-control" value="{{$deal->title}}">
						        </div>
						        <div class="form-group">
							        <label>Deal Tagline</label>
							        <input type="text" name="tagline" placeholder="The Bacon Cheeseburger Meal" class="form-control" value="{{$deal->tagline}}">
						        </div>
						        <div class="form-group">
							        <label>Describe the Deal</label>
							        <textarea name="description" class="form-control">{{$deal->description}}</textarea>
						        </div>
						        <div class="form-group">
							        <label>The Fine Print</label>
							        <p class="help-block">legalities, restrictions, etc</p>
							        <textarea name="finePrint" class="form-control">{{$deal->finePrint}}</textarea>
							        
						        </div>
						        <div class="form-group">
							        <label>Redemption Instructions</label>
							        <p class="help-block">Instructions for the venue cashier to validate the deal, or for the VIP member to claim the deal at the venue, or both.</p>
							        <textarea name="redemptionInstructions" class="form-control">{{$deal->redemptionInstructions}}</textarea>
							        
						        </div>
						        <div class="form-group">
							        <label>Is this a Flash Deal?</label>
							        <p class="help-block">A flash deal is a deal that has an expiration date. If you add a date below, this deal will be a flash deal expiring on the chosen date. Otherwise, leave this field blank.</p>

							        <input type="text" class="datepicker form-control" name="expirationDate" @if($deal->expirationDate !== NULL) value="{{date('m/d/Y', strtotime($deal->expirationDate))}}" @endif >
							    </div>
							    <div class="form-group">
								    
								    <p><img src="{{asset ('/uploads/'.$deal->largeImage)}}" class="currentImg img-responsive"></p>
								    
							        <label>Replace Large Image</label>
							        <p class="help-block">We use a 2000px wide by 600px tall image as your profile image if you have an active deal. Upload one here</p>
									<hr />
									<div id="dealLargeListEdit">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="deal-large-container-edit">
									    <a id="pickLargePhotoEdit" href="javascript:;" class="btn btn-default">Select Image</a> 
									    <a id="uploadLargePhotoEdit" href="javascript:;" class="btn btn-success">Upload Image</a>
									</div>
									<hr />
							        <input type="hidden" id="largeImageEdit" name="largeImage" value="{{$deal->largeImage}}">
							    </div>
							    <div class="form-group">
								    
								    <p><img src="{{asset ('/uploads/'.$deal->squareImage)}}" class="currentImg img-responsive"></p>
								    
							        <label>ReplaceSquare Image</label>
							        <p class="help-block">We use an 800px wide by 800px tall SQUARE image as the image that shows for your listing. Consider this your main deal image, so choose wisely.</p>
									<hr />
									<div id="dealSquareListEdit">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
									<br />
									
									<div id="deal-square-container-edit">
									    <a id="pickSquarePhotoEdit" href="javascript:;" class="btn btn-default">Select Image</a> 
									    <a id="uploadSquarePhotoEdit" href="javascript:;" class="btn btn-success">Upload Image</a>
									</div>
									<hr />
							        <input type="hidden" id="squareImageEdit" name="squareImage" value="{{$deal->squareImage}}">
							    </div>
						      </div>
						      <div class="modal-footer">
							    <input type="hidden" name="_token" value="{{ Session::get('_token') }}">
							    <input type="hidden" name="id" value="{{$deal->id}}">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="submit" id="editDealSubmit"  class="btn btn-primary">Save changes</button>
						      </div>
					      </form>