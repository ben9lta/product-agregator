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
            <label for="store_name">Введите название</label>
            <input type="text" name="name" id="store_name" class="form-control" placeholder="Введите название"
                   value="{{old('name', $store->name ?? '')}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="store_location">Расположение</label>
            <input type="text" name="location" id="store_location" class="form-control" placeholder="Расположение"
                   value="{{old('location', $store->location ?? '')}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="info">Информация</label>
            <textarea rows="5" name="info" id="info" class="form-control"
                      placeholder="Описание">{{old('info', $store->info ?? '')}}</textarea>
        </div>
    </div>
</div>
