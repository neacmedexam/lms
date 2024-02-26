<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{!! asset('assets/NEACLOGOLMS.ico') !!}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                fontFamily: {
                sans: ['Inter', 'sans-serif'],
                },
            }
            }
        }
    </script>
    <title>NEAC LMS</title>
</head>
<body class="">

    <div class="flex justify-center items-center m-auto h-screen w-screen bg-homepage bg-center bg-no-repeat bg-cover">
            <form method="POST" action="/users/login">
                @csrf
                <div class="uppercase bg-[#fec821] p-12 px-14 shadow-lg shadow-black z-[100] rounded-sm max-w-[90%] lg:max-w-[100%]">
                    <div class="flex flex-col justify-center items-center ">
                        {{-- <img src="assets/NEACLogo.png" alt="neac logo" class="text-center w-[80px] h-[30px]"> --}}
                        <h1 class="text-md uppercase lg:text-5xl text-4xl text-center text-darkMode tracking-wide font-bold">NEAC - LMS</h1>
                        <h1 class="text-md uppercase text-2xl text-center py-4 text-darkMode tracking-wide font-bold">Sign in to your account.</h1>
                    </div>
                    <div class="">
                        <p class="text-lg text-darkMode ">email</p>
                        <input type="email" name="email" value="{{old('email')}}" id="email" placeholder="email" class="border py-2 px-4 border-gray-300 w-full outline-none">
                    </div>
                    @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                    @enderror

                    <div class="py-2">
                        <p class="text-lg text-darkMode ">password</p>
                        <input type="password" name="password" id="password" placeholder="password" class="border py-2 px-4 border-gray-300 w-full focus:outline-none">
                    </div>
                    @error('password')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                    @enderror
                 
                    <div class="flex justify-end text-sm text-darkMode pb-4">
                        <a href="http://itsupport.medexamscenter.com/" target="_blank" class="text-blue-600 font-medium"><p>forgot password?</p></a>
                    </div>
                    <div class="py-2 flex justify-center items-center w-full ">
                        <button type="submit" class="hover:scale-105 hover:shadow-lg shadow-red-600 duration-300 transition-all px-4 py-2 text-white font-bold tracking-wide text-xl uppercase border border-[#eda31d] w-full bg-cyan-600">Sign In</button>
                    </div>
                    
                </div>
            </form>

     
       
    </div>

    <x-flash-message/>
</body>
</html>