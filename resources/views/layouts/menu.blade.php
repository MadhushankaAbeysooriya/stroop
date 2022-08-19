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

<li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
<li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
<li><a class="nav-link" href="{{ route('category.index') }}">Manage Product</a></li>
 

@endguest
