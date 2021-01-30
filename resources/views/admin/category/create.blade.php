@extends('admin.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('categories.index')}}">Категории</a>
                </li>

                <li class="breadcrumb-item active">Добавление</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Добавить категорию</h2>
                </div>
                <form method="post" action="{{route('categories.store')}}" class="create-form"
                      enctype="multipart/form-data">
                    @csrf
                    @include('admin.category._form')
                    <button class="btn badge-primary" type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection



