<div class="profile-sb">
				<div class="psb-sect">
					<a href="/my-account" class="@if(isset($activePage) && $activePage == 'dashboard') active @endif()">
						<span class="psb-left">my bookmarks</span>
						<span class="psb-right">
							<img src="{{asset ('assets/img/icons/bookmark-orange.png')}}" width="24" height="24">
							<span>{{count($vip->bookmarks)}}</span>
						</span>
						<span class="clearfix"></span>
					</a>
				</div>
				<div class="psb-sect">
					<a href="/my-account/recommendations" class="@if(isset($activePage) && $activePage == 'recs') active @endif()">
						<span class="psb-left">my recommendations</span>
						<span class="psb-right">
							<img src="{{asset ('assets/img/icons/heart-orange.png')}}" width="24" height="24">
							<span>{{count($vip->recommendations)}}</span>
						</span>
						<span class="clearfix"></span>
					</a>
				</div>
				<div class="psb-sect">
					<a href="/my-account/settings" class="@if(isset($activePage) && $activePage == 'settings') active @endif()">
						<span class="psb-left">my account settings</span>
						<span class="psb-right">
							<img src="{{asset ('assets/img/icons/settings-orange.png')}}" width="24" height="24">
						</span>
						<span class="clearfix"></span>
					</a>
				</div>
			</div>