<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>

            @if($sidebar)
                @foreach($sidebar as $iMenu)
                    @if(in_array(Auth::user()->role, explode(',', $iMenu->show)))
                        <li class="nav-item @if(in_array($iMenu->route, explode('.', $uri))) active open @endif">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="{{ $iMenu->icon }}"></i>
                                <span class="title">{{ $iMenu->label }}</span>
                                @if(in_array($iMenu->route, explode('.', $uri)))
                                    <span class="selected"></span>
                                @endif
                                <span class="arrow @if(in_array($iMenu->route, explode('.', $uri))) open @endif"></span>
                            </a>

                            @if(isset($iMenu->child) && $iMenu->child)
                                <ul class="sub-menu">
                                    @foreach($iMenu->child as $iSubMenu)
                                        @if(in_array(Auth::user()->role, explode(',', $iSubMenu->show)))
                                            <li class="nav-item @if($iSubMenu->route == $uri) active open @endif">
                                                <a href="@if(Route::has($iSubMenu->route)) {{ route($iSubMenu->route) }} @endif" class="nav-link">
                                                    <span class="title">{{ $iSubMenu->label }}</span>
                                                    @if($iSubMenu->route == $uri)
                                                        <span class="selected"></span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            @endif

        </ul>
    </div>
</div>