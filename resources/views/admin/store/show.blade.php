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
                <div class="row header_box version_2 d-flex detail__header-box">
                    <h2 class="col-md-4"><i class="fa fa-book"></i>Детали магазина</h2>
                    <ul class="col-md-8 detail-links">
                        <li><a href="{{route('stores.edit', $store->id)}}" class="btn badge-warning">Изменить</a></li>
                        <a class="btn badge-danger" href="#" onclick="$('#remove-category').submit()">Удалить</a>
                        <form id="remove-store" method="post" action="{{route('stores.destroy' , $store->id)}}" hidden>
                            {!! method_field('DELETE') !!}
                            @csrf
                        </form>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-8 add_top_30">
                        <table class="table table-sm detail-table table-bordered table-striped">
                            <tr>
                                <th>Название</th>
                                <td>{{$store->name}}</td>
                            </tr>
                            <tr>
                                <th>Расположение</th>
                                <td>
                                    {{$store->location}}
                                </td>
                            </tr>
                            <tr>
                                <th>Информация</th>
                                <td>
                                    {{$store->info}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



