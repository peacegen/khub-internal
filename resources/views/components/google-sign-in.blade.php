<div x-data="{ imageUrl: '{{ env('APP_URL').'/assets/img/google-sign-in-normal.png' }}' }" >
    <img class="h-14 ml-auto mr-auto block" :src="imageUrl" @click="imageUrl = '{{ env('APP_URL').'/assets/img/google-sign-in-pressed.png' }}'">
</div>
