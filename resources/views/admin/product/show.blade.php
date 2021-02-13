<?php
/**
 * @var \App\Models\Product\Product $product
 */
?>

@extends('admin.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('products.index')}}">Продукты</a>
                </li>

                <li class="breadcrumb-item active">{{$product->name}}</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="row header_box version_2 d-flex detail__header-box">
                    <h2 class="col-md-4"><i class="fa fa-book"></i>Детали продукта</h2>
                    <ul class="col-md-8 detail-links">
                        <li><a href="{{route('productReducer.edit', $product->id)}}" class="btn badge-warning">Изменить</a></li>
                        <a class="btn badge-danger" href="#" onclick="$('#remove-category').submit()">Удалить</a>
                        <form id="remove-store" method="post" action="{{route('products.destroy' , $product->id)}}" hidden>
                            {!! method_field('DELETE') !!}
                            @csrf
                        </form>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Изображение</label>
                            <div>
                                <img src="{{$product->getImgUrl()}}" alt="" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <table class="table table-sm detail-table table-bordered table-striped">
                            <tr>
                                <th>Название</th>
                                <td>{{$product->name}}</td>
                            </tr>
                            <tr>
                                <th>Категория</th>
                                <td>{{$product->category->name}}</td>
                            </tr>
                            <tr>
                                <th>Магазин</th>
                                <td>{{$product->store->name}}</td>
                            </tr>
                            <tr>
                                <th>Цена</th>
                                <td>{{$product->price}}</td>
                            </tr>
                            <tr>
                                <th>Старая цена</th>
                                <td>{{$product->old_price}}</td>
                            </tr>
                            <tr>
                                <th>Количество</th>
                                <td>{{$product->count}}</td>
                            </tr>
                            <tr>
                                <th>Статус</th>
                                <td>{{$product::getStatusVariants()[$product->status]}}</td>
                            </tr>
                            <tr>
                                <th>Описание</th>
                                <td>{{$product->description}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



