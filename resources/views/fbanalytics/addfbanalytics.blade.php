
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1):?>
        <h1 class="text-4xl px-4">Add Report</h1>
        <p class="pb-2 text-md">FB Analytics</p>
     

      
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
               
                <form method="POST" action="/addreport/fbanalytics" enctype="multipart/form-data">
                    @csrf
                
                    <div class="flex flex-col lg:flex-row justify-between lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Month</p>
                        <select name="month" id="" class="px-4 py-2 w-full">
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('month')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-between lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Year</p>
                        <select name="year" id="" class="px-4 py-2 w-full">
                            <option value="">Select Year</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('year')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Page Likes</p>
                        <input type="text" name="page_likes" value="{{old('page_likes')}}" placeholder="Page Likes" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('page_likes')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Post Reach</p>
                        <input type="text" name="post_reach" value="{{old('post_reach')}}" placeholder="Post Reach" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('post_reach')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Post Engagements</p>
                        <input type="text" name="post_engagement" value="{{old('post_engagement')}}" placeholder="Post Engagements" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('post_engagement')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Videos</p>
                        <input type="text" name="videos" value="{{old('videos')}}" placeholder="Videos" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('videos')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">NMC</p>
                        <input type="text" name="nmc" value="{{old('nmc')}}" placeholder="nmc" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('nmc')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Amount Spent</p>
                        <input type="text" name="amount_spent" value="{{old('amount_spent')}}" placeholder="amount_spent" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('amount_spent')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                   
                    <div class="hidden  flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">date</p>
                        <input type="datetime-local" id="getdate" name="dateCreated" value="{{old('dateCreated')}}" placeholder="date created" class="px-4 py-2 border border-gray-600 w-full">
                    </div> --}}
              
                
                    <div class="flex justify-end items-center py-4">
                        <button type="submit" 
                        class="
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
                        ">
                            Submit
                        </button>
                    </div>
                </form>
                
                
            </div>
        <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>