@extends('admin.index')

@section('content')
    <div class="dashboard">

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-people-fill text-danger float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>{{$users}}</h3>
                            <span>Пользователи</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-bag-fill text-primary float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>{{$products}}</h3>
                            <span>Продукты</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-card-checklist text-warning float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>{{$categories}}</h3>
                            <span>Категории</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-shop-window text-success float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>{{$stores}}</h3>
                            <span>Магазины</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-question text-success float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>???</h3>
                            <span>???</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                            <i class="bi bi-question text-success float-left"></i>
                        </div>
                        <div class="media-body text-right">
                            <h3>???</h3>
                            <span>???</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
