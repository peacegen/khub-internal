<div class="bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
    <section class="divide-y text-gray-900">
        <h1 class="text-3xl font-bold">{{ $title }}</h1>
        <article>
            <div class="mt-5 text-md">
                    {!! $content !!}
            </div>
        </article>
        @foreach ($attachments as $attachment)
        <a href="{{$attachment->url}}" download="{{$attachment->filename}}">
        <div> Download {{$attachment->filename}}</div>
        </a>
        @endforeach
    </section>
</div>
