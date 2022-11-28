<div>
    <a href="{{$file->getUrl()}}" download="{{$file->name}}">
        <div class="leading-sm px-3 py-3 bg-primary-100 outline outline-primary-500 outline-1 rounded-xl my-2 max-w-xs">
            <div class="mx-auto my-2">
                @if ($file->hasGeneratedConversion('thumb'))
                    <img src="{{ $file->getUrl('thumb') }}" alt="" class="w-16 h-16">
                @else
                    <img src="{{ env('APP_URL').'/assets/img/blank-file.png' }}" alt="" class="w-16 h-16">
                @endif
            </div>
            <div class="my-2 break-words">
                {{ __('Download') }} {{$file->name}}
            </div>
        </div>
    </a>
</div>
