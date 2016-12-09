					<div class="sidebar">
					    <span class="sb-heading">Cities<span></span></span>
					    <ul class="filter-listings" id="market-list">
						    <li><a href="#" class="active" data-type="market" data-id="all"><i class="fa fa-check"></i> all markets</a></li>
						    @foreach($markets as $market)
						    <li><a href="#" data-type="market" data-id="{{$market->id}}">{{$market->market}}</a></li>
						    @endforeach()
					    </ul>
					    <span class="sb-heading" style="padding-top:40px;">Categories <span></span></span>
					    <ul class="filter-listings" id="category-list">
						    <li><a href="#" class="active" data-type="category" data-id="all"><i class="fa fa-check"></i> all categories</a></li>
						    @foreach($categories as $cat)
						    <li><a href="#" data-type="category" data-id="{{$cat->id}}">{{$cat->category}}</a></li>
						    @endforeach()
					    </ul>
					    <input id="filter-market" type="hidden" value="all">
					    <input id="filter-category" type="hidden" value="all">
				    </div>