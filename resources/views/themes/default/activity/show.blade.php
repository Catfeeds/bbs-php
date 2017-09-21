@extends('theme::layout.public')

@section('seo_title'){{ $activity->title }} - 商品详情 - {{ Setting()->get('website_name') }}@endsection


@section('content')
    <div class="row mt-20">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-box mb-10">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ route('website.image.show',['image_name'=>$activity->image]) }}" alt="{{ $activity->title }}">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $activity->title }}</h4>
                        @if(Setting()->get('website_share_code')!='')
                            <div class="mb-10">
                                {!! Setting()->get('website_share_code')  !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-box-title">商品详情</div>
                <div class="text-fmt">{{ $activity->description }}</div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3 side">

            @if(Auth()->check())
                
            @endif

               


        </div>

    </div>


@endsection


@section('script')
    <script  src="{{ asset('/js/activity.js') }}"></script>
@endsection