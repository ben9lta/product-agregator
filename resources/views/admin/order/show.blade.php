<?php
/**
 * @var \App\Models\Order\Order $order
 */
//use Illuminate\Support\Facades\Session;
?>

@extends('admin.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('orders.index')}}">Заказы</a>
                </li>

                <li class="breadcrumb-item active">{{$order->name}}</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                @if( session('message') )
                    <div class="alert alert-danger"> {{ session("message") }}</div>
                @endif
                <div class="row header_box version_2 d-flex detail__header-box">
                    <h2 class="col-md-4"><i class="fa fa-book"></i>Детали заказа</h2>
                </div>
                <div class="row">
                    <div class="col-md-8 add_top_30">
                        <table class="table table-sm detail-table table-bordered table-striped">
                            <tr>
                                <th>Заказчик</th>
                                <td>{{$order->name}}</td>
                            </tr>
                            <tr>
                                <th>Телефон</th>
                                <td>{{$order->phone}}</td>
                            </tr>
                            <tr>
                                <th>Адрес доставки</th>
                                <td>{{$order->address ?? 'Уточнить по телефону'}}</td>
                            </tr>
                            <tr>
                                <th>Дата доставки</th>
                                <td>{{$order->time_delivery ?? 'Уточнить по телефону'}}</td>
                            </tr>
                            <tr>
                                <th>Дата заказа</th>
                                <td>{{$order->created_at}}</td>
                            </tr>
                            <tr>
                                <th>Статус</th>
                                <td>
                                    @switch($order->status)
                                        @case(2)
                                            В ожидании
                                            @break
                                        @case(1)
                                            Активный
                                            @break
                                        @default
                                            Завершен
                                    @endswitch
                                </td>
                            </tr>
                            @if($order->status === 2)
                                <tr>
                                    <th>Действие</th>
                                    <td>
                                        <form style="display: inline" action="{{ route('orders.active', $order->id)}}" method="POST"
                                              class="{{"form-" . $order->id}}">
                                            @csrf
                                            <input type="submit" class="show-more btn-active-color" value="Взять заказ"/>
                                        </form>
                                    </td>
                                </tr>
                            @endif


                        </table>
                    </div>

                    <div class="col-12">
                        <h2>Продукты</h2>
                        <table class="table table-sm detail-table table-bordered ">
                            <thead>
                            <tr>
                                <th class="text-center">Магазин</th>
                                <th class="text-center">Фото</th>
                                <th class="text-center col-4">Название</th>
                                <th class="text-center col-1">Количество</th>
                                <th class="text-center col-2">Цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->carts->products as $product)
                                <tr>
                                    <td class="text-center">{{$product->store->name}}</td>
                                    <td class="text-center">
                                        <img src="{{$product->imageUrl}}" alt="{{$product->name}}"
                                             style="width: 100px"/>
                                    </td>

                                    <td class="text-center col-4">{{$product->name}}</td>

                                    <td class="text-center col-1">{{$product->pivot->quantity}}</td>

                                    <td class="text-center col-2">{{$product->price}} руб.</td>
                                </tr>
                            @endforeach

                            <tr class="total">
                                <td></td>
                                <td></td>
                                <td></td>
                                <th class="text-center col-1">Итого</th>
                                <td class="text-center col-2">{{$order->total}} руб.</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



