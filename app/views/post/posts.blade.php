@extends('layouts.site')

@section('title')
  News
@stop

@section('content')
    @parent
    <div class="page-img">{{ HTML::image('images/news-cover.jpg') }}</div>
    <div class="container">
        <div class="page-container">
            <div class="hline"></div>
            <div class="page-content">
                <h2 class="page-title">{{trans('menu.topmenu.news_center')}}</h2>
                <ul class="posts-list list-unstyled">
                    @foreach($posts as $post)
                    <li class="row">
                        <a href="{{ URL::to('/post/'.$post->type.'/'.$post->id) }}">
                            <div class="posts-image col-md-2">
                                <img src="{{ (isset($post->image)) ? asset($post->getImage()) : asset('images/default-post-img.png') }}" />
                            </div>
                            <div class="col-md-10">
                                <h4 class="post-date">{{date("M d, Y", strtotime($post->updated_at))}}</h4>
                                <h3>{{ trimWords($post->title, 10) }}</h3>
                                <p>{{ trimWords($post->content, 50) }}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="pagination-tab">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>      
@stop