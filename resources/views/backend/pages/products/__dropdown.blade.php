<div class="dropdown">
    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if (url()->current() == route('backend.products.index'))
            @lang('pages.products')
        @elseif(url()->current() == route('backend.categories.index'))
          @lang('pages.categories')
        @elseif(url()->current() === route('backend.formats.index'))
          @lang('pages.formats')
        @elseif(url()->current() === route('backend.size.index'))
          @lang('pages.size')
        @elseif(url()->current() === route('backend.type.index'))
          @lang('pages.type')
        @endif
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a @class(['disabled bg-dark text-white' => url()->current() == route('backend.products.index'), 'dropdown-item']) href="{{ route('backend.products.index') }}">@lang('pages.products')</a>
      <a @class(['disabled bg-dark text-white' => url()->current() == route('backend.categories.index'), 'dropdown-item']) href="{{ route('backend.categories.index') }}">@lang('pages.categories')</a>
      <a @class(['disabled bg-dark text-white' => url()->current() === route('backend.formats.index'), 'dropdown-item']) href="{{ route('backend.formats.index') }}">@lang('pages.formats')</a>
      <a @class(['disabled bg-dark text-white' => url()->current() === route('backend.size.index'), 'dropdown-item']) href="{{ route('backend.size.index') }}">@lang('pages.size')</a>
      <a @class(['disabled bg-dark text-white' => url()->current() === route('backend.type.index'), 'dropdown-item']) href="{{ route('backend.type.index') }}">@lang('pages.type')</a>
    </div>
</div>