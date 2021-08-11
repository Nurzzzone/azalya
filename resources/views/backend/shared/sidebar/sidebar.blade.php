{{--@isset($appMenues['sidebar menu'])--}}
{{--    @foreach($appMenus['sidebar menu'] as $menuItem)--}}
{{--        @if (in_array(trans()))--}}
{{--    @endforeach--}}
{{--@endisset--}}

<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="/">
            <i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="/colors">
            <i class="c-sidebar-nav-icon cil-speedometer"></i> Colors</a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
