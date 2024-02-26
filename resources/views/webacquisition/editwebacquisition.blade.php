
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1):?>
        <h1 class="text-4xl px-4">Edit Report</h1>
        <p class="px-4 py-2">(Web Acquisition)</p>
        <p class="pb-4"> {{date("F",mktime(0,0,0,$edit->month,10))}} {{$edit->year}} </p>
     

      
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
           
                <form method="POST" action="/editreport/webacquisition/edit/{{$edit->webacquisition_number}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Month</p>
                        <input type="text" name="month" value="{{date("F",mktime(0,0,0,$edit->month,10))}}" disabled placeholder="reach" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('month')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Year</p>
                        <input type="text" name="year" value="{{$edit->year}}" disabled placeholder="reach" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('year')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div> --}}
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Direct Traffic</p>
                        <input type="text" name="direct_traffic" value="{{$edit->direct_traffic}}" placeholder="direct_traffic" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('direct_traffic')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Email Marketing</p>
                        <input type="text" name="email_marketing" value="{{$edit->email_marketing}}" placeholder="email_marketing" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('email_marketing')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Organic Search</p>
                        <input type="text" name="organic_search" value="{{$edit->organic_search}}" placeholder="organic_search" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('organic_search')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Paid Search</p>
                        <input type="text" name="paid_search" value="{{$edit->paid_search}}" placeholder="paid_search" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('paid_search')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Referrals</p>
                        <input type="text" name="referrals" value="{{$edit->referrals}}" placeholder="referrals" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('referrals')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Social Media</p>
                        <input type="text" name="social_media" value="{{$edit->social_media}}" placeholder="social_media" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('social_media')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Other Campaigns</p>
                        <input type="text" name="other_campaigns" value="{{$edit->other_campaigns}}" placeholder="other_campaigns" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('other_campaigns')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Offline Sources</p>
                        <input type="text" name="offline_sources" value="{{$edit->offline_sources}}" placeholder="offline_sources" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('offline_sources')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Display</p>
                        <input type="text" name="display" value="{{$edit->display}}" placeholder="display" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('display')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                   

          
                
                    <div class="flex justify-end items-center py-4">
                        <button type="submit"   class="
                        px-6
                        py-3
                        bg-yellow-600
                        text-white
                        font-medium
                        text-sm
                        leading-tight
                        uppercase
                        shadow-md
                        hover:bg-amber-600 hover:shadow-lg
                        focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-amber-600 active:shadow-lg
                        transition-all
                        duration-350
                        ease-in-out
                        ">Update</button>
                    </div>
                </form>
                
                
            </div>
        <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>