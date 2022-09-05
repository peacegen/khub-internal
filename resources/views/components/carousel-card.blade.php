<div class="relative">
    <a href="{{ $link }}" class="absolute inset-0 z-10 bg-white bg-opacity-0 text-center flex flex-col items-center justify-center hover:bg-opacity-70 duration-300">
        <div class=tracking-wider > {{ $content }} </div>
    </a>
    <a href="{{ $link }}" class="relative">
        <div class="flex flex-wrap content-center">
            <img src="{{ $backgroundUrl }}" class="mx-auto" alt="">
        </div>
    </a>
</div>
