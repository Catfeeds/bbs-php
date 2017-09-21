@extends('admin/public/layout')
@section('title')
    添加活动
@endsection

@section('content')
    <section class="content-header">
        <h1>
            活动管理
            <small>添加活动</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.activities.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">


                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label>活动名称</label>
                                <input type="text" name="title" class="form-control " placeholder="活动名称" value="{{ old('title','') }}">
                                @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                            </div>

                            <div class="form-group">
                                <label>图片</label>
                                <input type="file" name="image" />
                            </div>


                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label>活动详情</label>
                                <textarea name="description" class="form-control" placeholder="活动简介" style="height: 80px;">{{ old('description','') }}</textarea>
                                @if($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                            </div>


                            <div class="form-group">
                                <label>状态</label>
                                <span class="text-muted">(禁用后前台不会显示)</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="1" checked /> 启用
                                    </label>&nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0" /> 禁用
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
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
