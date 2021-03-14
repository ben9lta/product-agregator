<?php
/**
 * @var \App\Models\Order\Order $order
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
                <li class="breadcrumb-item active">Заказы</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2 d-flex mb-4">
                    <h2 class="col-md-4"><i class="fa fa-fw fa-list"></i>Заказы</h2>
                </div>

                <div class="orders">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">Дата заказа</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Действие</th>
                            </tr>

                            @foreach($orders as $order)
                                <tr style="background-color: {{$order->status ? 'transparent' : '#e83232'}}">
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        {{$order->name}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
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
                                    <td>
                                        <a href="{{route('orders.show', $order->id)}}"><i
                                                class="fa fa-fw fa-eye"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$orders->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection



