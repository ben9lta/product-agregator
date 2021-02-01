<?php
/**
 * @var \App\Models\Store\Store $stores
 */
?>
@extends('admin.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('stores.index')}}">Магазины</a>
                </li>

                <li class="breadcrumb-item active">{{$store->name}}</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Изменить магазин</h2>
                </div>
                <form method="post" action="{{route('stores.update', $store->id)}}" class="create-form" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.store._form', ['model' => $store])
                    <button class="btn badge-primary" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection



