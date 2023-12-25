<footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
    @guest
        <a class="text-gray-500 hover:text-yellow-500" href="{{ route('login') }}">Login</a>
    @endguest
    <a class="text-gray-500 hover:text-yellow-500" href="{{ route('profile.show') }}">profile</a>
    <a class="text-gray-500 hover:text-yellow-500" href="{{ route('posts.index') }}">Blog</a>
</footer>
