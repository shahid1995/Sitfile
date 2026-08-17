@extends('layouts.inner')
@section('title', 'Page')
@section('content')

    
    @if(Request::segment(2)=='altibbe-peace-of-mind-guarantee')
    
        {!! $page_details->page_content !!}
    
    @else
    <div class="information_page">
    <div class="maincontainer">
        {!! $page_details->page_content !!}
    </div>
    </div>
    @endif

       
@endsection




