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
    <div class="col-md-12">
        <div class="form-group">
            <label for="parent_id">Связь с категорией</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Главная</option>
                @foreach ($categories as $cat)
                    @include('admin.category.form.options', [
                        'category' => $category ?? [],
                        'categories' => $cat,
                        'name' => ''
                    ])
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="category_name">Введите название</label>
            <input type="text" name="name" id="category_name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $category->name ?? '')}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Выберите изображение</label>
            <input id="input-b1" name="img" type="file" class="file" data-browse-on-zone-click="true">
            <div>
                <img src="{{old('img', $category->getImgUrl() ?? '')}}" width="400" alt="" data-id="input-b1">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Выберите иконку</label>
            <input id="input-b2" name="icon" type="file" class="file" data-browse-on-zone-click="true">
            <div>
                <img src="{{old('icon', $category->getIconUrl() ?? '')}}" width="50" alt="" data-id="input-b2">
            </div>
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

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="editor">Описание</label>
            <textarea rows="5" name="description" class="form-control" id="editor"
                      placeholder="Описание">{{old('description', $category->description ?? '')}}</textarea>
        </div>
    </div>
</div>
