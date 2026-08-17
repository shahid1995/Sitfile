@extends('layouts.inner')
@section('title', $pages->meta_title)
@section('content')

<section class="container-fluid breadcrumbcontainer">
	<div class="maincontainer">
		@if($breadcrumbs)
		<ol class="breadcrumb">
		  @foreach($breadcrumbs as $breadcrumb)
		  <li @if($breadcrumb['active']) class="active" @endif ><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
		  @endforeach
		</ol>
		@endif
	</div>
</section>
          
<section class="container-fluid cmscontainer">
	<div class="maincontainer">
		<div class="row">
			<div class="col-lg-12">
				<h2>{{ $pages->page_title }}</h2>
				{!! $pages->page_content !!}
			</div>
		</div>
	</div>
</section>
@endsection




