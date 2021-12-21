@foreach($categories as $categoryItem)
    <option value="{{ $categoryItem->id ?? '' }}"
            @isset($category->id)

            @if($category->parent_id == $categoryItem->id)
            selected
            @endif

            @if($category->id == $categoryItem->id)
            disabled
            @endif

            @endisset
    >
        {{ $delimiter ?? '' }}{{ $categoryItem->title }}

        @isset($categoryItem->children)
            @include('admin.category._categories', [
                'categories' => $categoryItem->children,
                'delimiter' => ' - ' . $delimiter
            ])
        @endisset
    </option>
@endforeach
