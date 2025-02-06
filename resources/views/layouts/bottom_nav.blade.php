<!-- Bottom Navbar for Mobile View-->
<nav class="bottom-nav">
    <a href="{{ route('front.index')  }}">
        <div class="nav-item active">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </div>
    </a>
{{--    <a href="category.html">--}}
{{--        <div class="nav-item">--}}
{{--            <i class="fa-solid fa-list"></i>--}}
{{--            <span>Category</span>--}}
{{--        </div>--}}
{{--    </a>--}}
    @if(\Illuminate\Support\Facades\Auth::check())
        <div class="nav-item">
            <i class="fa-solid fa-plus"></i>
            <span>Add Place</span>
        </div>
{{--        <div class="nav-item">--}}
{{--            <i class="fas fa-bookmark"></i>--}}
{{--            <span>Bookmarks</span>--}}
{{--        </div>--}}
        <div class="nav-item">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </div>
    @endif
{{--    <a href="category.html">--}}
{{--        <div class="nav-item">--}}
{{--            <i class="fa-regular fa-circle-question"></i>--}}
{{--            <span>Category</span>--}}
{{--        </div>--}}
{{--    </a>--}}
</nav>
