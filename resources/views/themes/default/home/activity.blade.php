@extends('theme::layout.public')


@section('seo_title')活动 @if($activities->currentPage()>1)- 第{{ $activities->currentPage() }}页@endif - {{ Setting()->get('website_name') }}@endsection


@section('content')
    <h1 class="h3">活动<br><small></small></h1>
    <div class="row  mt-20">
        <div class="col-xs-12 col-md-9 main">
            @foreach( $activities as $activity )
            <section class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img alt="{{ $activity->title }}" src="{{ route('website.image.show',['image_name'=>$activity->image]) }}" style="height: 200px; width: 100%; display: block;">
                    <div class="caption">
                        <h4 class="text-center"><a href="{{ route('activity.detail',['id'=>$activity->id]) }}">{{ $activity->title }}</a></h4>
                    </div>
                </div>
            </section>
            @endforeach

            <div class="text-center">
                {!! str_replace('/?', '?', $activities->render()) !!}
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript" src="{{ asset('/js/activity.js') }}"></script>
@endsection


