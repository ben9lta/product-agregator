<?php
$category_id = $category ?? '';
?>

<div class="sidebar sidebar-right">
    <form method="POST" action="/api/filtering" class="filtering-form">
        @csrf
        <input type="text" hidden name="category_id" value="{{isset($category_id) ? $category_id : 'all'}}">
        <div class="shop-list">
            <h3>
                Магазины
            </h3>

            <ul>
                @foreach($stores as $store)
                    <li>
                        <input type="checkbox" id="store{{$store->id}}" name="stores[{{$store->id}}]" value="{{$store->name}}">
                        <label for="store{{$store->id}}">{{$store->name}}</label>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="filter-list">
            <h3>
                Цена
            </h3>

            <ul class="filter-price">
                <li>
                    <label for="price_from">от</label>
                    <input type="text" id="price_from" maxlength="7" name="price_from" placeholder="0"/>
                    <label for="price_to">до</label>
                    <input type="text" id="price_to" maxlength="7" name="price_to" placeholder="1000"/>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <input type="submit" class="submit-btn btn-active-color" value="Применить">
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('.filtering-form');
            form.onsubmit = (e) => filtering(e);

            const filtering = (e) => {
                e.preventDefault();
                const data = $(form).serialize();
                window.fetchProducts('/api/filtering', 'post', {data: data}, true);
                // return false;
            }
        })
    </script>

</div>

