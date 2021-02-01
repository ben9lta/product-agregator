<?php
/**
 * @var \App\Models\Product\Product $products
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
                <li class="breadcrumb-item active">Продукты</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2 d-flex mb-4">
                    <h2 class="col-md-4"><i class="fa fa-fw fa-list"></i>Продукты</h2>
                    <div class="col-md-8 text-right">
                        <a href="{{route('products.create')}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="stores">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Магазин</th>
                                <th scope="col">Действие</th>
                            </tr>

                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{$product->id}}
                                    </td>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{$product->category->name}}
                                    </td>
                                    <td>
                                        {{$product->store->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('products.show', $product->id)}}"><i
                                                class="fa fa-fw fa-eye"></i></a>

                                        <a href="{{route('products.edit', $product->id)}}"><i
                                                class="fa fa-fw fa-edit"></i></a>

                                        <form style="display: inline" action="{{ route('products.destroy' , $product->id)}}" method="POST"
                                              class="{{"form-" . $product->id}}">
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
                    {{$products->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection



