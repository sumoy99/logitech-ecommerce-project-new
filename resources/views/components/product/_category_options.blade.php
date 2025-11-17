@foreach($categories as $category)
    <option value="{{ $category->id }}"
        {{ in_array((int)$category->id, $selectedCategories ?? []) ? 'selected' : '' }}>
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level ?? 0) !!}
        {{ $level > 0 ? '⤷ ' : '' }}{{ $category->name }}
    </option>

    @if($category->children && $category->children->count() > 0)
        @include('components.product._category_options', [
            'categories' => $category->children,
            'selectedCategories' => $selectedCategories ?? [],
            'level' => ($level ?? 0) + 1
        ])
    @endif
@endforeach
