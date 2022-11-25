<div x-data="{ imageUrl: '{{ env('APP_URL').'/assets/img/google-sign-in-normal.png' }}' }" >
    <a href="{{ route('auth.google') }}">
    <img class="h-14 ml-auto mr-auto block my-4" :src="imageUrl" @click="imageUrl = '{{ env('APP_URL').'/assets/img/google-sign-in-pressed.png' }}'">
    </a>
</div>
