<?php
/**
 * @var \App\Models\Parser\Parser $parser
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
                <li class="breadcrumb-item active">Парсер</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2 d-flex mb-4">
                    <h2 class="col-md-4"><i class="fa fa-fw fa-list"></i>Парсеры</h2>
                    <div class="col-md-8 text-right">
                        <a href="{{route('parsers.create')}}" class="btn badge-primary">Добавить</a>
                    </div>
                </div>

                <div class="stores">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Ссылка</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Парсить</th>
                                <th scope="col">Действие</th>
                            </tr>

                            @foreach($parsers as $parser)
                                <tr>
                                    <td>
                                        {{$parser->id}}
                                    </td>
                                    <td>
                                        {{$parser->parser_name}}
                                    </td>
                                    <td>
                                        {{$parser->url}}
                                    </td>
                                    <td>
                                        {{$parser->status ? "Активный" : "Неактивный"}}
                                    </td>
                                    <td>
                                        <a href="javascript:;" onclick="children[0].submit();">Парсить
                                            <form action="{{route('parsers.parse.one', $parser->id)}}" method="post" hidden>
                                                @csrf
                                            </form>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('parsers.show', $parser->id)}}"><i
                                                class="fa fa-fw fa-eye"></i></a>

                                        <a href="{{route('parsers.edit', $parser->id)}}"><i
                                                class="fa fa-fw fa-edit"></i></a>

                                        <form style="display: inline" action="{{ route('parsers.destroy' , $parser->id)}}" method="POST"
                                              class="{{"form-" . $parser->id}}">
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
                    {{$parsers->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection



