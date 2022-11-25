<div class="mx-auto sm:px-6 lg:px-8 items-center ">
    <div class="bg-white overflow-hidden shadow-xl max-w-7xl sm:rounded-lg my-4">
        <div class="text-center my-4">
            {{ __("Login with a").' '.config('config.email-domain').' '.__("account").':' }}
        </div>
        <x-google-sign-in />
    </div>
</div>
