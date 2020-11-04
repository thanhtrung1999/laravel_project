@extends('backend.master.master')
@section('title', 'Quản lý thuộc tính')
@section('active-link-product')
    class="active"
@endsection
@section('content')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home">
							<use xlink:href="#stroked-home"></use>
						</svg></a></li>
				<li class="active">Danh mục</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý thuộc tính</h1>

			</div>
		</div>
        @if(session()->has('alert'))
        <div class="alert alert-success">
            <strong>{{session('alert')}}</strong>
        </div>
        @endif
		<!--/.row-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        @foreach($attributes as $attribute)
                            <div class="row magrin-attr">
                                <div class="col-md-2 panel-blue widget-left">
                                    <strong class="large">{{$attribute->name}}</strong>
                                    <a class="delete-attr" href="admin/product/delete-attr/{{$attribute->id}}"><i class="fas fa-times"></i></a>
                                    <a class="edit-attr" href="admin/product/edit-attr/{{$attribute->id}}"><i class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-md-10 widget-right boxattr">
                                    @foreach($attribute->values as $value)
                                        <div class="text-attr">
                                            <span>{{$value->value}}</span>
                                            <a href="#" class="edit-value"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="del-value"><i class="fas fa-times"></i></a>
                                        </div>
                                    @endforeach
                                        <div class="text-attr"><a href="#" class="add-value"><i class="fas fa-plus-circle"></i></a></div>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
			<!--/.col-->
		</div>
		<!--/.row-->
	</div>
	<!--/.main-->
@endsection
