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
                    <a href="{{route('admin.index')}}">Доска</a>
                </li>
                <li class="breadcrumb-item active">Категории</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2 d-flex mb-4">
                    <h2 class="col-md-4"><i class="fa fa-fw fa-list"></i>Категории</h2>
                    <div class="col-md-8 text-right">
                        <a href="{{route('categories.create')}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="categories">
                    <table class="table table-sm table-striped">
                        <tbody>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Действие</th>
                        </tr>

                        @foreach($categories as $category)
                            @include('admin.category.categories', [$category, 'name' => ''])
                        @endforeach

                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection



