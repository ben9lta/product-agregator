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
            <label for="parser_name">Название парсера</label>
            <input type="text" name="parser_name" id="parser_name" class="form-control" placeholder="Введите название"
                   value="{{old('parser_name', $parser->parser_name ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                <option value="0" {{isset($parser) && $parser->status === 0 ? 'selected' : ''}}>Неактивный</option>
                <option value="1" {{isset($parser) && $parser->status === 1 ? 'selected' : ''}}>Активный</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Категория товара</label>
            <select name="category_id" id="category" class="form-control">
                <option value="">Выберите категорию</option>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{isset($parser) && $category->id === $parser->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    @endif
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="store">Магазин товара</label>
            <select name="store_id" id="store" class="form-control">
                <option value="">Выберите магазин</option>
                    @if(isset($stores))
                        @foreach($stores as $store)
                            <option value="{{$store->id}}" {{isset($parser) && $store->id === $parser->store_id ? 'selected' : ''}}>{{$store->name}}</option>
                        @endforeach
                    @endif
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="url">Ссылка для парсинга товаров</label>
            <input type="text" name="url" id="url" class="form-control" placeholder="Введите ссылку"
                   value="{{old('url', $parser->url ?? '')}}">
        </div>
    </div>
</div>

<h2>Селекторы товара</h2>
@if(isset($options))
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="parser_options">Парсер</label>
            <select name="parser_options" id="parser_options" class="form-control">
                <option value="">Новый</option>
                    @foreach($options as $option)
                        <option value="{{$option->id}}" {{isset($parser) && $option->id === $parser->option_id ? 'selected' : ''}}>{{$option->parser['parser_name']}}</option>
                    @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[encoding]">Кодировка (UTF-8)</label>
            <input type="text" name="option[encoding]" id="option[encoding]" class="form-control" placeholder="UTF-8"
                   value="{{old('option[encoding]', $parser->option->encoding ?? '')}}">
        </div>
    </div>
</div>
@endif
<div class="row options__block">
    <div class="col-md-6">
        <div class="form-group">
            <label for="option[name]">Заголовок товара</label>
            <input type="text" name="option[name]" id="option[name]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[name]', $parser->option->name ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[next_page]">Следующая страница</label>
            <input type="text" name="option[next_page]" id="option[next_page]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[next_page]', $parser->option->next_page ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[description]">Описание товара</label>
            <input type="text" name="option[description]" id="option[description]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[description]', $parser->option->description ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[img]">Изображение товара</label>
            <input type="text" name="option[img]" id="option[img]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[img]', $parser->option->img ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[price]">Цена товара</label>
            <input type="text" name="option[price]" id="option[price]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[price]', $parser->option->price ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[old_price]">Старая цена товара</label>
            <input type="text" name="option[old_price]" id="option[old_price]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[old_price]', $parser->option->old_price ?? '')}}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="option[count]">Количество товара</label>
            <input type="text" name="option[count]" id="option[count]" class="form-control" placeholder="Введите селектор"
                   value="{{old('option[count]', $parser->option->count ?? '')}}">
        </div>
    </div>

</div>
<script>
    const options = @json(\Illuminate\Support\Collection::make($options)->keyBy(function ($item) {
        return $item->id;
    }));
    const parserOptions = document.querySelector('#parser_options');
    parserOptions.onchange = function () {
        const selectedOption = options[this.value];
        if(selectedOption) {
            const inputs = Object.keys(selectedOption)
               .map(key => {
                  const input = document.querySelector(`input[name="option[${key}]"]`);
                  if(input) {
                      input.value = selectedOption[key];
                      // input.disabled = true;
                  }
               });
        } else {
            const inputs = document.querySelectorAll('.options__block input')
                .forEach(input => {
                    input.value = '';
                    // input.disabled = false;
                });
        }
    }
    // if(parserOptions.selectedIndex > 0) {
    //     const inputs = document.querySelectorAll('.options__block input')
    //         .forEach(input => {
    //             input.disabled = true;
    //         });
    // }

</script>
