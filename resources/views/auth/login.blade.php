<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
        <!-- left side -->
        <div class="flex flex-col justify-center p-8 md:p-14">
            
          <div class="mb-3 text-4xl">
            <x-application-logo class="w-[20rem]"/>
          </div>
          <span class="font-light text-gray-400">
            {{ __('Welcome back!') }} {{ __('Please enter your details') }}.
          </span>
          <form method="POST" action="{{ route('login') }}">
           @csrf
          <div class="pt-4">
            <span class="mb-2 text-md">{{ __('Email') }}</span>
            <input
              id="email"
              type="email"
              name="email"
              required
              autofocus
              placeholder="{{ __('Enter your email')}}"
              class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
          <div class="py-4">
            <span class="mb-2 text-md">{{ __('Password') }}</span>
            <input
              id="password"
              type="password"
              name="password"
              required
              placeholder="{{ __('Enter your password') }}"
              class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <button type="submit"
            class="w-full bg-[#69210B] text-[#fff] p-2 rounded-lg my-6 border border-[#69210B] border-solid border-1 hover:bg-transparent hover:text-[#69210B] duration-200">
            {{ __('Log in') }}
          </button>
        
        </div>
        <!-- right side -->
        <div class="relative">
          <img src="{{ asset('assets/images/bg-login.webp') }}" class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover"/>
        </div>
      </div>
    </div>


</x-guest-layout>