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
                    <a href="{{route('parsers.index')}}">Парсер</a>
                </li>

                <li class="breadcrumb-item active">{{$parser->parser_name}}</li>
            </ol>
            <h2></h2>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-plus"></i>Изменить парсер</h2>
                </div>
                <form method="post" action="{{route('parsers.update', $parser->id)}}" class="create-form" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.parser._form', ['model' => $parser])
                    <button class="btn badge-primary" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection



