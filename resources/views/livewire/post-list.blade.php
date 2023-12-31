<div class="px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-400">
            {{ $search ? "Searching '$search'" : '' }}
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <x-checkbox wire:model.live='papular' />
            <x-label>Popular</x-label>

            <button wire:click="setSort('desc')"
                class="{{ $sort == 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4">
                Latest
            </button>

            <button wire:click="setSort('asc')"
                class="{{ $sort == 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 ">
                Oldest
            </button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item wire:key="{{ $post->id }}" :$post />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
