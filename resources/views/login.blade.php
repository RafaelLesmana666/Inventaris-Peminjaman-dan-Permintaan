@extends('layout.master')
@section('content')

        <div class="flex flex-row items-center top-6 left-36 absolute">
            <img src="/assets/logo.png" alt="logo" class="w-18 h-14 pr-3">
                <div class="text-left">
                   <div class="text-lg text-blue-600 font-semibold">Inventaris</div>
                   <div class="text-xs text-gray-400">SMK Wikrama bogor</div>
                </div>
        </div>
            <img src="/assets/people.svg" class="z-index-0 relative left-56 h-96 top-32">  
            <img src="/assets/gradasi.svg" class="absolute bottom-0 h-72">
        <div class="right-52 absolute top-44">
            <form action="/login" method="POST">
                @csrf
                <div class="w-96 flex flex-col">
                  <h3 class="text-left text-blue-600 font-semibold text-3xl">Selamat Datang !</h3>
                   @if( session('error'))
                   <h4 class="text-sm mb-2 text-gray-400">Ada banyak peminjamam yang menunggu</h4>
                    {{ session('error') }}
                    @else 
                    <h4 class="text-sm mb-6 text-gray-400">Ada banyak peminjamam yang menunggu</h4>
                   @endif
                    <input type="text" name="username" placeholder="Username" class="border border-gray-600 rounded-md pt-2.5 pb-2.5 pl-3 pr-3 mb-6">
                    <input type="password" name="password" placeholder="Password" class="border border-gray-600 rounded-md pt-2.5 pb-2.5 pl-3 pr-3 mb-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-2  rounded-md">Log In</button>
                </div>
            </form>
        </div>
@endsection