@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(()=> show = false, 1500)" x-show="show" class="fixed top-0 left-0 w-screen h-screen flex flex-col justify-center items-center m-auto z-[99]">
    <div class="w-full h-full bg-black/70 flex flex-col justify-center items-center">
        <div class="bg-white rounded-lg max-w-[350px] h-[350px] p-7 flex flex-col justify-center items-center shadow-lg shadow-black">
            <i class="bi bi-check-circle-fill  text-green-600 text-6xl py-4"></i>
            <p class="text-3xl text-black uppercase text-center">
                {{session('message')}}
            </p>
        </div>
    </div>
</div>
@endif