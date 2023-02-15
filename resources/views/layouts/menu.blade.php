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

    @can('receive-list')
        <li class="nav-item    has-treeview  {{ request()->is('receive*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-green fas fa fa-box"></i>
                <p>Receive Items</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('receive.create') }}"
                       class="nav-link {{  request()->is('receive/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-green"></i>
                        <p>New Receive Item</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('receive.index') }}"
                       class="nav-link   {{  request()->is('receive') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-green"></i>
                        <p>All Receive Items</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

@can('issue-list')
        <li class="nav-item    has-treeview  {{ request()->is('issue*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-red fas fa fa-shipping-fast"></i>
                <p>Issue Items</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('issue.create') }}"
                       class="nav-link {{  request()->is('issue/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>New Issue Item</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('issue.index') }}"
                       class="nav-link   {{  request()->is('issue') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>All Issue Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('issue.approve') }}"
                       class="nav-link   {{  request()->is('issue/approve') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Fwd Issue Items</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan


    @can('item-list')
        <li class="nav-item    has-treeview  {{ request()->is('item*') || request()->is('title*')? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-warning fas fa fa-cubes"></i>
                <p>Items</p>
            </a>
            <ul class="nav nav-treeview">
                @can('item-create')
                    <li class="nav-item">
                        <a href="{{ route('item.create') }}"
                           class="nav-link {{  request()->is('item/create*') ? 'active' : '' }}  ">
                            <i
                                class="far fa-circle nav-icon text-warning"></i>
                            <p>Create Item </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('item.index') }}"
                       class="nav-link   {{  request()->is('item') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-warning"></i>
                        <p>All Items</p>
                    </a>
                </li>
                @can('title-list')
                    <li class="nav-item">
                        <a href="{{ route('title.index') }}"
                           class="nav-link   {{  request()->is('title') ? 'active' : '' }} ">
                            <i
                                class="far fa-circle nav-icon text-warning"></i>
                            <p>All Titles</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('purchase-order-list')
        <li class="nav-item    has-treeview  {{ request()->is('purchase*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-orange fas fa fa-shopping-cart"></i>
                <p>Purchase Orders</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('purchase.create') }}"
                       class="nav-link {{  request()->is('purchase/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-orange"></i>
                        <p>New Purchase Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('purchase.index') }}"
                       class="nav-link   {{  request()->is('purchase') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-orange"></i>
                        <p>All Purchase Order</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('supplier-list')
        <li class="nav-item    has-treeview  {{ request()->is('supplier*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-lime fas fa fa-truck"></i>
                <p>Supplier</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('supplier.create') }}"
                       class="nav-link {{  request()->is('supplier/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-lime"></i>
                        <p>New Supplier </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}"
                       class="nav-link   {{  request()->is('supplier') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-lime"></i>
                        <p>All Suppliers</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('vote-list')
        <li class="nav-item    has-treeview  {{ request()->is('vote*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-blue fas fa fa-ticket-alt"></i>
                <p>Vote</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('vote.create') }}"
                       class="nav-link {{  request()->is('vote/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-blue"></i>
                        <p>New Vote Head </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vote.index') }}"
                       class="nav-link   {{  request()->is('vote') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-blue"></i>
                        <p>All Vote Head</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('establishment-list')
        <li class="nav-item    has-treeview  {{ request()->is('establishment*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-pink fas fa fa-building"></i>
                <p>Establishment</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('establishment.create') }}"
                       class="nav-link {{  request()->is('establishment/create*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-pink"></i>
                        <p>New Establishment </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('establishment.index') }}"
                       class="nav-link   {{  request()->is('establishment') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-pink"></i>
                        <p>All Establishment</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    @can('stock-list')
        <li class="nav-item    has-treeview  {{ request()->is('stock*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-purple fas fa fa-cash-register"></i>
                <p>Stocks</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('stock.index') }}"
                       class="nav-link   {{  request()->is('stock') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-purple"></i>
                        <p>All Stocks</p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('serno.index') }}"
                       class="nav-link   {{  request()->is('serno') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-purple"></i>
                        <p>Search S/N</p>
                    </a>
                </li>
            </ul>

        </li>
    @endcan

    @can('temp-list')
        <li class="nav-item    has-treeview  {{ request()->is('temp*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon text-lightblue fas fa fa-box-open"></i>
                <p>Return Temp Issued</p>
            </a>
            <ul class="nav nav-treeview">
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('temp.create') }}"--}}
{{--                       class="nav-link {{  request()->is('temp/create*') ? 'active' : '' }}  ">--}}
{{--                        <i--}}
{{--                            class="far fa-circle nav-icon text-lightblue"></i>--}}
{{--                        <p>New Temp Issued </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a href="{{ route('temp.index') }}"
                       class="nav-link   {{  request()->is('temp') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-lightblue"></i>
                        <p>All Temp Issued</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan

    <li class="nav-item    has-treeview  {{ request()->is('settings*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link  ">
            <i class="nav-icon text-yellow fas fa fa-cog"></i>
            <p>Settings</p>
        </a>

        @can('user-list')
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
        @endcan

        @can('role-list')
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
        @endcan

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
