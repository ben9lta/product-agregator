<?php
$category_id = $category ?? '';
?>
<div class="sidebar sidebar-left">
    <h3>
        Категории
    </h3>

    <ul>
        @foreach($categories as $category)
            <li><a class="{{$category->id == $category_id ? 'selected' : ''}}" href="/catalog/category/{{$category->id}}">{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>
