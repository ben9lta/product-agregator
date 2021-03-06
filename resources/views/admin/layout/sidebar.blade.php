<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dashboard">
        <a class="nav-link" href="{{route('admin.index')}}">
            <i class="fa fa-dashboard"></i>
            <span class="nav-link-text">&nbsp;Доска</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Parser">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseParser">
            <i class="fa fa-cloud-download " aria-hidden="true"></i>
            <span class="nav-link-text">&nbsp;Парсер</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseParser">
            <li>
                <a href="{{route('parsers.index')}}">Все</a>
            </li>
            <li>
                <a href="javascript:;" onclick="children[0].submit();">Парсить активные
                    <form action="{{route('parsers.parse.all')}}" method="post" hidden>
                        @csrf
                    </form>
                </a>
            </li>
            <li>
                <a href="{{route('parsers.create')}}">Создать</a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Магазины">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseStores" data-parent="#Stores">
            <i class="fa fa-shopping-cart"></i>
            <span class="nav-link-text">&nbsp;Магазины</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseStores">
            <li>
                <a href="{{route('stores.index')}}">Все</a>
            </li>
            <li>
                <a href="{{route('stores.create')}}">Создать</a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Категории">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCategories" data-parent="#Categories">
            <i class="fa fa-list"></i>
            <span class="nav-link-text">&nbsp;Категории</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseCategories">
            <li>
                <a href="{{route('categories.index')}}">Все</a>
            </li>
            <li>
                <a href="{{route('categories.create')}}">Создать</a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Продукты">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProduct" data-parent="#Products">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            <span class="nav-link-text">&nbsp;Продукты</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseProduct">
            <li>
                <a href="{{route('products.index')}}">Все</a>
            </li>

            <li>
                <a href="{{route('products.create')}}">Добавить</a>
            </li>
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" data-original-title="Заказы">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOrder" data-parent="#Order">
            <i class="fa fa-credit-card" aria-hidden="true"></i>
            <span class="nav-link-text">&nbsp;Заказы</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseOrder">
            <li>
                <a href="{{route('orders.index')}}">Все</a>
            </li>
        </ul>
    </li>

</ul>

