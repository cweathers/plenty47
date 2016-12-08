		<div class="modal-body">
			<fieldset>
				<legend>User Account Information</legend>
				<div class="alert-nofade alert-info">This information is not changeable. It is attached to stripe subscriptions and core application functionality. If a user needs to change their email or legal name, cancel the account, manually refund them / cancel their stripe subscription through the stripe interface and have them sign up for a new account!</div>
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control disabled" value="{{$vip->user->firstName}} {{$vip->user->lastName}}">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control disabled" value="{{$vip->user->email}}">
				</div>
				@if($vip->user->stripe_active == 1)
				<div class="alert-nofade alert-success">
					<p><strong>This user has a stripe subscription!</strong></p>
					<p><strong>Stripe Id:</strong> {{$vip->user->stripe_id}}<br />
					   <strong>Stripe Subscription Id:</strong> {{$vip->user->stripe_subscription}}</p>
					@if($vip->user->subscription_ends_at)
					<p><strong>This user has cancelled their subscription. They will become inactive on: {{date('F j, Y', strtotime($vip->user->subscription_ends_at))}}</strong></p>
					@endif
				</div>
				@else()
				<div class="alert-nofade alert-danger">This user does NOT have an active stripe subscription!</div>
				@endif()
			</fieldset>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>