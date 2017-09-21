@extends('admin/public/layout')

@section('title')活动管理@endsection

@section('content')
    <section class="content-header">
        <h1>活动管理</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form role="form" name="listForm" method="post" action="{{ route('admin.activities.destroy') }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.activities.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="添加新活动"><i class="fa fa-plus"></i></a>
                                        <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body  no-padding">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-toggle"/></th>
                                        <th>活动标题</th>
                                        <th>图片</th>
                                        <th>描述</th>
                                        <th>状态</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $activity->id }}" name="ids[]"/></td>
                                            <td>{{ $activity->title }}</td>
                                            <td>
                                                @if($activity->image)
                                                    <img src="{{ route('website.image.show',['image_name'=>$activity->image]) }}"  style="width: 27px;"/>
                                                @endif
                                            </td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ trans_common_status($activity->status) }}</td>
                                            <td>{{ $activity->updated_at }}</td>
                                            <td>
                                                <div class="btn-group-xs" >
                                                    <a class="btn btn-default" href="{{ route('admin.activities.edit',['id'=>$activity->id]) }}" data-toggle="tooltip" title="编辑信息"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            {!! str_replace('/?', '?', $activities->render()) !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.activities.index') }}");
    </script>
@endsection

