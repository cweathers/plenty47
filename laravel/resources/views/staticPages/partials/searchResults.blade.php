@if(count($searchResults) > 0))
<?php $i = 1; ?>
@foreach($searchResults as $res)
<a href="/merchant/{{$res->vendor->slug}}?deal={{$res->id}}" class="ind-result @if($i <= 1) first @endif()">
	<div class="media">
	  <div class="media-left">
	      <img class="media-object" src="{{asset ('/uploads/'.$res->squareImage)}}" alt="{{$res->vendor->companyName}}">
	  </div>
	  <div class="media-body">
	    <h4 class="media-heading">{{$res->title}}</h4>
	    {{$res->tagline}}
	  </div>
	</div>
</a>
<span class="clearfix"></span>
<?php $i++; ?>
@endforeach()
@endif()