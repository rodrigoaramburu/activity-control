<div class="mt-4 p-2">
    @foreach($categories as $category)
        <livewire:categories.item :category="$category" :key="$category->id" />
    @endforeach
</div>
