<div class="sm:px-10 lg:px-72 items-center">
    <div class="bg-white overflow-hidden shadow-xl max-w-7xl sm:rounded-lg mt-16 mx-auto">
        <div class="text-center my-4">
            {{ __("Login with a").' '.config('config.email-domain').' '.__("account").':' }}
        </div>
        <x-google-sign-in />
    </div>
</div>
