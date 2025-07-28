@extends('layout.app')
@section('content')
<x-nav />

<div class="container bg-white mx-auto p-6 shadow-lg rounded-lg overflow-hidden">
    <div class="relative bg-cover bg-center bg-no-repeat h-[300px] mb-4 w-full"
        style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrSJrJqjQi0Rb603136SDw96pJANUpa603Qw&s'); height:400px ">

        <div class="w-full h-full flex flex-col justify-center items-center bg-black/50 px-4">
            <h1 class="text-2xl md:text-4xl text-center text-white font-semibold max-w-3xl leading-snug">
                contactez nous
            </h1>


        </div>
    </div>




    <div class="max-w-6xl mx-auto">

        <div  
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 place-items-center">
             
                <a href=""
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
    
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-facebook-icon lucide-facebook">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                </svg>
                <span>facebook</span>
            </a>
            <a href=""
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-instagram-icon lucide-instagram">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                </svg> <span>instagram</span>
            </a>
            <a href=""
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-twitter-icon lucide-twitter">
                    <path
                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                </svg> <span>twitter</span>
            </a>
            <a href=""
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-linkedin-icon lucide-linkedin">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                    <rect width="4" height="12" x="2" y="9" />
                    <circle cx="4" cy="4" r="2" />
                </svg> <span>linkedin</span>
            </a>
            <a href="mailto:devjunior242@gmail.com"
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-mail-icon lucide-mail">
                    <rect width="20" height="16" x="2" y="4" rx="2" />
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                </svg> <span>mail</span>
            </a>
            <a href=""
                class="flex items-center text-red-500 hover:text-blue-300 transition-colors duration-300 rounded-lg  shadow-md m-4 space-x-1 h-24 w-36 bg-white hover:bg-zinc-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-map-pin-icon lucide-map-pin">
                    <path
                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                    <circle cx="12" cy="10" r="3" />
                </svg> <span>Address</span>
            </a>
        </div>
    </div>

</div>




<x-footer />

@endsection