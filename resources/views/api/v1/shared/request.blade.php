<div class="col-6">
    <div class="mb-2 text-underline lead">{{ $method }} <u>{{ $endpoint }}</u> HTTP/1.1</div>
    @isset($params)
        @foreach ($params as $param)
            <div>
                <b class="d-block">{{ $param['name'] }}</b>
                <div class="px-4">
                    <div class="border-bottom pb-1">
                        <em>{{ $param['type'] }}</em>
                        @if ($param['required'])
                        | <span class="text-danger">required</span>
                        @endif
                    </div>
                    <p>{{ $param['description'] }}</p>
                </div>
            </div>
        @endforeach
    @endisset
</div>