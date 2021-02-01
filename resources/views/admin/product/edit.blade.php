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
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Изменить продукт</h2>
                </div>
                <form method="post" action="{{route('products.update', $product->id)}}" class="create-form" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.product._form', ['model' => $product])
                    <button class="btn badge-primary" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection



