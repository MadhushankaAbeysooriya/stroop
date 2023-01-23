<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

@guest
    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
@else

    <li class="nav-item    has-treeview  {{ request()->is('settings*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link  ">
            <i class="nav-icon text-yellow fas fa fa-cog"></i>
            <p>Settings</p>
        </a>
        {{--        @can('user-list')--}}
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                   class="nav-link {{  request()->is('settings/users') ? 'active' : '' }}  ">
                    <i
                        class="far fa-user nav-icon text-yellow"></i>
                    <p>Users </p>
                </a>
            </li>
        </ul>
        {{--        @endcan--}}
        {{--        @can('role-list')--}}
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('roles.index') }}"
                   class="nav-link {{  request()->is('settings/roles*') ? 'active' : '' }}  ">
                    <i
                        class="far fa-address-card nav-icon text-yellow"></i>
                    <p>User Roles </p>
                </a>
            </li>
        </ul>
    {{--@endcan--}}

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('profile') }}"
                   class="nav-link {{  request()->is('settings/profile*') ? 'active' : '' }}  ">
                    <i
                        class="far fa-user nav-icon text-yellow"></i>
                    <p>Change Password </p>
                </a>
            </li>
        </ul>

@endguest
