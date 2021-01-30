<option value="{{ $cat->id }}" @empty(!$category) {{ $cat->id === $category->parent_id ? 'selected' : '' }} @endempty >
    {!!$name!!} <b>{{ $cat->name }}</b>
</option>

@foreach ($cat->children as $child)
    @include('admin.category.form.options', [
        'category' => $category ?? [],
        'cat' => $child,
        'name' => $name . "$cat->name &#x279B; "
    ])
@endforeach
