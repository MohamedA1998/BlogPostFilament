<div id="recommended-topics-box">
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-3">
        @foreach ($categorys as $category)
            <x-badge wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}" :$category />
        @endforeach
    </div>
</div>
