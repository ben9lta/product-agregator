<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Выберите категорию</option>
                @if(isset($categories))
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{isset($product) && $category->id === $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="store_id">Магазин</label>
            <select name="store_id" id="store_id" class="form-control">
                <option value="">Выберите магазин</option>
                @if(isset($stores))
                    @foreach($stores as $store)
                        <option value="{{$store->id}}" {{isset($product) && $store->id === $product->store_id ? 'selected' : ''}}>{{$store->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="product_name">Название продукта</label>
            <input type="text" name="name" id="product_name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $product->name ?? '')}}">
        </div>
    </div>
</div>

<h2>Информация о продукте</h2>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Цена"
                   value="{{old('price', $product->price ?? '')}}">
        </div>

        <div class="form-group">
            <label for="old_price">Старая цена</label>
            <input type="text" name="old_price" id="old_price" class="form-control" placeholder="Старая цена"
                   value="{{old('old_price', $product->old_price ?? '')}}">
        </div>

        <div class="form-group">
            <label for="count">Количество</label>
            <input type="text" name="count" id="count" class="form-control" placeholder="Количество"
                   value="{{old('count', $product->count ?? '')}}">
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                @foreach(\App\Models\Product\Product::getStatusVariants() as $key => $status)
                    <option value="{{$key}}" {{isset($product) && $key === $product->status ? 'selected' : ''}}>{{$status}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Выберите изображение</label>
            <input id="input-img" name="img" type="file" class="file" data-browse-on-zone-click="true">
            <div>
                <img src="{{old('img', isset($product) ? $product->getImgUrl() : '')}}" width="400" alt="" data-id="input-img">
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea rows="5" name="info" id="description" class="form-control"
                      placeholder="Описание">{{old('info', $product->description ?? '')}}</textarea>
        </div>
    </div>
    <script>
        document.querySelectorAll('input.file').forEach(a => a.addEventListener("change", handleFiles));
        function handleFiles(e) {
            const fileImg = e.target.files[0];
            const img = document.querySelector(`img[data-id="${e.target.id}"]`)
            if(fileImg) img.src = URL.createObjectURL(fileImg);
        }
    </script>
</div>
