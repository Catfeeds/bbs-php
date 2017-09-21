@extends('admin/public/layout')
@section('title')编辑活动@endsection

@section('content')
    <section class="content-header">
        <h1>
            编辑活动
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <form role="form" name="editForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.activities.update',['id'=>$activity->id]) }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">

                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                <label>活动名称</label>
                                <input type="text" name="title" class="form-control " placeholder="活动名称" value="{{ old('title',$activity->title) }}">
                                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>图片</label>
                                <input type="file" name="image" />
                                @if($activity->image)
                                <div style="margin-top: 10px;">
                                    <img src="{{ route('website.image.show',['image_name'=>$activity->image]) }}" style="width: 200px;"/>
                                </div>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label>详情</label>
                                <textarea name="description" class="form-control" placeholder="简介" style="height: 80px;">{{ old('description',$activity->description) }}</textarea>
                                @if($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>


                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" @if($activity->status === 1) checked @endif /> 启用
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" @if($activity->status === 0 ) checked @endif /> 禁用
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-success">重置</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('script')
    <script type="text/javascript">
        set_active_menu('operations',"{{ route('admin.notice.index') }}");
    </script>
@endsection