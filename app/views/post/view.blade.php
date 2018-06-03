@extends('layouts.site')

@section('title')
  {{ trimWords($post->title, 3) }}
@stop

@section('content')
    @parent
    <div class="page-img">{{ HTML::image('images/news-cover.jpg') }}</div>
    <div class="container">
        <div class="page-container">
            <div class="hline"></div>
            <div class="page-content">
                <h2 class="page-title">{{ $post->title }}</h2>
                <p>{{ $post->content }}</p><br/>
            </div>
        </div>
    </div>      
@stop