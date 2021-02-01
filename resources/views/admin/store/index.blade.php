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
                    <a href="{{route('admin.index')}}">Доска</a>
                </li>
                <li class="breadcrumb-item active">Магазины</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2 d-flex mb-4">
                    <h2 class="col-md-4"><i class="fa fa-fw fa-list"></i>Магазины</h2>
                    <div class="col-md-8 text-right">
                        <a href="{{route('stores.create')}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="stores">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Действие</th>
                            </tr>

                            @foreach($stores as $store)
                                <tr>
                                    <td>
                                        {{$store->id}}
                                    </td>
                                    <td>
                                        {{$store->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('stores.show', $store->id)}}"><i
                                                class="fa fa-fw fa-eye"></i></a>

                                        <a href="{{route('stores.edit', $store->id)}}"><i
                                                class="fa fa-fw fa-edit"></i></a>

                                        <form style="display: inline" action="{{ route('stores.destroy' , $store->id)}}" method="POST"
                                              class="{{"form-" . $store->id}}">
                                            {!! method_field('DELETE') !!}
                                            @csrf
                                            <button style="border: none; background: none;" type="submit" onclick="return confirm('Вы уверены?')"><a
                                                    href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$stores->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection



