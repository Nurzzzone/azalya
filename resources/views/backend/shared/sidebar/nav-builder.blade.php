@php
    if (!function_exists('renderDropdown')) {
        function renderDropdown($data) {
            if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
                echo '<li class="c-sidebar-nav-dropdown">';
                echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
                if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                    echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';
                }
                echo trans('pages.'. $data['name']) . '</a>';
                echo '<ul class="c-sidebar-nav-dropdown-items">';
                renderDropdown( $data['elements'] );
                echo '</ul></li>';
            }else{
                for($i = 0; $i < count($data); $i++){
                    if( $data[$i]['slug'] === 'link' ){
                        echo '<li class="c-sidebar-nav-item">';
                        echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                        echo '<span class="c-sidebar-nav-icon"></span>' . trans('pages.'. $data[$i]['name']) . '</a></li>';
                    }elseif( $data[$i]['slug'] === 'dropdown' ){
                        renderDropdown( $data[$i] );
                    }
                }
            }
        }
    }
@endphp

<ul class="c-sidebar-nav">
    @if(isset($appMenus['sidebar menu']))
        @foreach($appMenus['sidebar menu'] as $menuel)
            @if($menuel['slug'] === 'link')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                        @lang('pages.'. $menuel['name'])
                    </a>
                </li>
                @if($menuel['name'] === 'pages') 
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('backend.orders.index') }}">
                                <i class="cil-calculator c-sidebar-nav-icon"></i>
                            @lang('pages.orders')
                        @if (!empty($order_count))
                            <span class="badge badge-success">{{ $order_count }}</span>
                        @endif
                        </a>
                    </li>
                @endif
            @elseif($menuel['slug'] === 'dropdown')
                <?php renderDropdown($menuel) ?>
            @elseif($menuel['slug'] === 'title')
                <li class="c-sidebar-nav-title">
                    @if($menuel['hasIcon'] === true)
                        @if($menuel['iconType'] === 'coreui')
                            <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                        @endif
                    @endif
                    @lang('pages.'. $menuel['name'])
                </li>
            @endif
        @endforeach
    @endif
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
