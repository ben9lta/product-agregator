<?php
/**
 * @var \App\Models\Category\Category $category
 */
?>
@extends('admin.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('categories.index')}}">Категории</a>
                </li>

                <li class="breadcrumb-item active">{{$category->name}}</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Изменить категорию</h2>
                </div>
                <form method="post" action="{{route('categories.update', $category->id)}}" class="create-form" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.category._form', ['model' => $category])
                    <button class="btn badge-primary" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection



