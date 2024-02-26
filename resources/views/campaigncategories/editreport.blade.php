
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-14 flex flex-col items-center m-auto  h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1):?>

            <h1 class=" text-4xl">Edit Report</h1>
            <h1 class="font-bold">Category</h1>

            {{-- <div class=" w-full   justify-evenly px-10 py-2 flex flex-col sm:flex-row items-center h-[250px]"> --}}
            <div class=" w-full justify-evenly  px-10 py-4 m-auto h-full flex flex-col sm:flex-row items-center ">
                <div class=" p-4 m-2">
                    <a href="/editreport/fbanalytics" class="h-full w-full flex items-center justify-center hover:scale-[105%] duration-300 transition-all ">
                        {{-- <h1 class="font-extrabold text-transparent text-xl bg-clip-text bg-gradient-to-r from-purple-400 to-blue-600">
                        FB Analytics
                        </h1> --}}
                        <img src="{{asset('public/storage/categories/FBA.png')}}" alt="" class="h-[70%] w-[70%]">
                    </a> 
                </div>
                <div class=" p-4 m-2">
                    <a href="/editreport/webacquisition" class="h-full w-full flex items-center justify-center hover:scale-[105%] duration-300 transition-all">
                        {{-- <h1 class="font-extrabold text-transparent text-xl bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">
                            Web Acquisition
                        </h1> --}}
                        <img src="{{asset('public/storage/categories/WEB.png')}}" alt="" class="h-[70%] w-[70%]">
                    </a> 
                </div>
                <div class=" p-4 m-2">
                    <a href="/editreport/campaign" class="h-full w-full flex items-center justify-center hover:scale-[105%] duration-300 transition-all">
                        {{-- <h1 class="font-extrabold text-transparent text-xl bg-clip-text bg-gradient-to-r from-red-400 to-violet-600">
                            Facebook Ads
                        </h1> --}}
                        <img src="{{asset('public/storage/categories/FB_ADS.png')}}" alt="" class="h-[70%] w-[70%]">
                    </a> 
                </div>
            </div>
        <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>