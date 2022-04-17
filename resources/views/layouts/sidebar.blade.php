<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <div class="d-flex align-items-center">
            <img src="{{ asset(\App\Base::$logo) }}" class="w-50" alt="">
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-item name="Home" class="feather-home" link="{{ route('home') }}"></x-menu-item>

            <x-menu-title title="Item Management"></x-menu-title>

            <x-menu-item name="Create Item" class="feather-plus"></x-menu-item>
            <x-menu-item name="Items List" class="feather-list" counter="50"></x-menu-item>


            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="Article Manager"></x-menu-title>

            <x-menu-item name="Manage Category" class="feather-layers" link="{{ route('category.index') }}"></x-menu-item>
            <x-menu-item name="Create Article" class="feather-plus" link="{{ route('article.create') }}"></x-menu-item>
            <x-menu-item name="Articles List" class="feather-list" link="{{ route('article.index') }}"></x-menu-item>


            <x-menu-spacer></x-menu-spacer>


            <x-menu-title title="User Profile"></x-menu-title>

            <x-menu-item name="Your Profile" class="feather-user" link="{{ route('profile') }}"></x-menu-item>
            <x-menu-item name="Change Password" class="feather-lock" link="{{ route('profile.edit.password') }}"></x-menu-item>
            <x-menu-item name="Update Info" class="feather-message-square" link="{{ route('profile.edit.name.email') }}"></x-menu-item>
            <x-menu-item name="Update Photo" class="feather-image" link="{{ route('profile.edit.photo') }}"></x-menu-item>

            <x-menu-spacer></x-menu-spacer>

            <a class="btn btn-outline-primary w-100" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Log Out
            </a>

        </ul>
    </div>
</div>
