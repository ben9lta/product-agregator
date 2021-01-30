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
                <div class="row header_box version_2 d-flex detail__header-box">
                    <h2 class="col-md-4"><i class="fa fa-book"></i>Детали категории</h2>
                    <ul class="col-md-8 detail-links">
                        <li><a href="{{route('categories.edit', $category->id)}}" class="btn badge-warning">Изменить</a></li>
                        <a class="btn badge-danger" href="#" onclick="$('#remove-category').submit()">Удалить</a>
                        <form id="remove-category" method="post" action="{{route('categories.destroy' , $category->id)}}" hidden>
                            {!! method_field('DELETE') !!}
                            @csrf
                            <button style="border: none; background: none;" type="submit" onclick="return confirm('Вы уверены?')"><a
                                    href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                            </button>
                        </form>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Изображение</label>
                            <div>
                                <img src="{{$category->getImgUrl()}}" alt="" class="img-thumbnail">
                            </div>
                        </div>
                        @if($category->icon)
                        <div class="form-group">
                            <label>Иконка</label>
                            <div>
                                <img src="{{$category->getIconUrl()}}" alt="" class="img-thumbnail">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8 add_top_30">
                        <table class="table table-sm detail-table table-bordered table-striped">
                            <tr>
                                <th>Название</th>
                                <td>{{$category->name}}</td>
                            </tr>
                            <tr>
                                <th>Описание</th>
                                <td>
                                    {{$category->description}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



