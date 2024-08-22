@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-900">
    <div class="w-full max-w-md">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-purple-400 mb-6 text-center">{{ __('Register') }}</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-300">{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full p-2 rounded bg-gray-900 text-gray-100 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-300">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full p-2 rounded bg-gray-900 text-gray-100 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="text-red-500 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-300">{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full p-2 rounded bg-gray-900 text-gray-100 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="block text-gray-300">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="w-full p-2 rounded bg-gray-900 text-gray-100" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
