<div class="lead mb-2">
    JSON Response: <span class="{{ $status_text ?? 'text-success' }}">{{ $status ?? 200 }}</span>
</div>
<div class="text-monospace mb-4">
    {
        <div class="px-4">
            @foreach ($response as $data)
                @if (is_array($data['message']))
                    <span class="d-block">"{{ $data['name'] }}": 
                        [
                            <span class="d-block pl-4">{</span>
                                <div class="pl-4">
                                    @foreach ($data['message'] as $message)
                                        <span class="d-block pl-4">"{{ $message['name'] }}": {{ $message['message'] }},</span>
                                    @endforeach
                                </div>
                            <span class="d-block pl-4">}</span>
                        ]
                    </span>
                @else
                    <span class="d-block">"{{ $data['name'] }}": {{ $data['message'] }},</span>
                @endif
            @endforeach
        </div>
    }
</div>