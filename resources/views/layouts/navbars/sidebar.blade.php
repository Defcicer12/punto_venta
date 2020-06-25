<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('OS') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Siempre fallan') }}</a>
        </div>
        <ul class="nav">
            {{-- <li @if ($pageSlug=='Corte de caja' ) class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Corte de caja') }}</p>
                </a>
            </li>
            <li @if ($pageSlug=='corte' ) class="active " @endif>
                <a href="{{ route('corte') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Flujo de efectivo') }}</p>
                </a>
            </li> --}}
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('Empleados') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug=='profile' ) class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Perfil') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug=='users' ) class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Administración') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#Caja" aria-expanded="true">
                    <i class="tim-icons icon-bag-16"></i>
                    <span class="nav-link-text">{{ __('Ordenes de servicio') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="Caja">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug=='caja' ) class="active " @endif>
                            <a href="{{ route('pages.maps') }}">
                                <i class="tim-icons icon-bank"></i>
                                <p>{{ __('Ventas') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug=='devoluciones' ) class="active " @endif>
                            <a href="{{ route('pages.refunds') }}">
                                <i class="fas fa-retweet"></i>
                                <p>{{ __('Devoluciones') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#Productos" aria-expanded="true">
                    <i class="tim-icons icon-basket-simple"></i>
                    <span class="nav-link-text">{{ __('Insumos') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="Productos">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug=='productos' ) class="active " @endif>
                            <a href="{{ route('pages.products') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Administración') }}</p>
                            </a>
                        </li>
                        {{-- <li @if ($pageSlug=='inventario' ) class="active " @endif>
                            <a href="{{ route('pages.inventory') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('inventario') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug=='ajustes' ) class="active " @endif>
                            <a href="{{ route('pages.adjusment') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Ajuste de inventario') }}</p>
                            </a>
                        </li> --}}
                    </ul>
                </div>

            </li>
            <li>
                <a data-toggle="collapse" href="#Clientes" aria-expanded="true">
                    <i class="tim-icons icon-badge"></i>
                    <span class="nav-link-text">{{ __('Clientes') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="Clientes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug=='clients' ) class="active " @endif>
                            <a href="{{ route('pages.clients') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Administración') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li>
                <a data-toggle="collapse" href="#Ventas" aria-expanded="true">
                    <i class="tim-icons icon-book-bookmark"></i>
                    <span class="nav-link-text">{{ __('Ventas') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="Ventas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug=='sales' ) class="active " @endif>
                            <a href="{{ route('pages.sales') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Administración') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{-- <li @if ($pageSlug=='icons' ) class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li> --}}
            {{-- <li @if ($pageSlug=='notifications' ) class="active " @endif>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li @if ($pageSlug=='tables' ) class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li @if ($pageSlug=='typography' ) class="active " @endif>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li @if ($pageSlug=='rtl' ) class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
