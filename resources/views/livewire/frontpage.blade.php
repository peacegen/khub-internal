<div class="mx-auto bg-gray-100 p-12 sm:w-8/12 md:w-9/12 lg:w-10/12">
    <section class="divide-y text-gray-900">
        <div>
        <h1 class="text-3xl font-bold">{{ $page->title }}</h1>
            <div class="py-2 flex-auto">
                @if($page->tags)
                    @foreach($page->tags as $tag)
                        <x-tag-container :tag="$tag"/>
                    @endforeach
                @endif
            </div>
        </div>
        <article>
            <div class="mt-5 text-md">
                {!! $page->content !!}
            </div>
        </article>

        <div class="flex overflow-auto">
        @foreach ($attachments as $attachment)
        <div class="mx-1">
        {{-- <a href="{{$attachment['url']}}" download="{{$attachment['filename']}}"> --}}
        {{-- <li class="items-center leading-sm px-3 py-1 bg-primary-100 outline outline-primary-500 outline-1 rounded-full"> Download {{$attachment['filename']}}</li> --}}
            <x-download-container :file="$attachment"/>
        {{-- </a> --}}
        </div>
        @endforeach
        </div>
    </section>
</div>
