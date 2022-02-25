<div class="my-4">Catégories</div>
    <div class="list-group">
        @foreach(App\Models\Category::get() as $category)
            <a href="#" class="list-group-item">{{ $category->name }}</a>
        @endforeach
</div>

{{-- <div class="my-4">Catégories</div>
    <div class="list-group">
    <a href="#" class="list-group-item active">Laravel</a>
    <a href="#" class="list-group-item">PHP</a>
    <a href="#" class="list-group-item">Javascript</a>
</div> --}}