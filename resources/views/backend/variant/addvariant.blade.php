@extends('backend.master.master')
@section('title', 'Biến thể')
@section('active-link-product')
    class="active"
@endsection
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <svg class="glyph stroked home">
                            <use xlink:href="#stroked-home"></use>
                        </svg>
                    </a>
                </li>
                <li class="active">Biến thể</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Biến thể</h1>
            </div>
        </div>
        @if(session()->has('alert'))
            <div class="alert alert-success">
                <strong>{{session('alert')}}</strong>
            </div>
        @endif
        <!--/.row-->
        <div class="col-md-12">
            <div class="panel panel-default">
                <form action="" method="post">
                    @csrf
                    <div class="panel-heading" align='center'>
                        Giá cho từng biến thể sản phẩm : {{$product->name}} ({{$product->product_code}})
                    </div>
                    <div class="panel-body" align='center'>
                        <table class="panel-body">
                            <thead>
                                <tr>
                                    <th width='33%'>Biến thể</th>
                                    <th width='33%'>Giá (có thể trống)</th>
                                    <th width='33%'>Tuỳ chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($product->variants as $variant)
                                <tr>
                                    <td scope="row">
                                        @for($i=0; $i<count($variant->values); $i++)
                                            @if($i == (count($variant->values)-1))
                                                {{$variant->values[$i]->attributes->name}}: {{$variant->values[$i]->value}}
                                            @else
                                                {{$variant->values[$i]->attributes->name}}: {{$variant->values[$i]->value}},
                                            @endif
                                        @endfor
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input name="variant[{{$variant->id}}]" class="form-control" placeholder="Giá cho biến thể" value="{{$variant->price}}">
                                        </div>
                                    </td>
                                    <td>
                                        <a id="" class="btn btn-warning" href="admin/product/delete-variant/{{$variant->id}}" onclick="return confirm('Bạn có chắc chắn muốn xóa biến thể không?');" role="button">Xoá</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div align='right'>
                        <button class="btn btn-success" type="submit">Cập nhật</button>
                        <a class="btn btn-warning"
                           href="admin/product/cancel" role="button">Bỏ qua</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--/.main-->
@endsection
