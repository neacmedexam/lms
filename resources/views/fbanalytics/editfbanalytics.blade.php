
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1):?>
        <h1 class="text-4xl px-4">Edit Report</h1>
        <p class="px-4 py-2">(Facebook Analytics)</p>
        <p class="pb-4"> {{date("F",mktime(0,0,0,$edit->month,10))}} {{$edit->year}} </p>
     

      
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
           
                <form method="POST" action="/editreport/fbanalytics/edit/{{$edit->fbanalytics_number}}" enctype="multipart/form-data">
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
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Page Likes</p>
                        <input type="text" name="page_likes" value="{{$edit->page_likes}}" placeholder="page_likes" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('page_likes')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Post Reach</p>
                        <input type="text" name="post_reach" value="{{$edit->post_reach}}" placeholder="post_reach" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('post_reach')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Post Engagement</p>
                        <input type="text" name="post_engagement" value="{{$edit->post_engagement}}" placeholder="post_engagement" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('post_engagement')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[34.5%]">Videos</p>
                        <input type="text" name="videos" value="{{$edit->videos}}" placeholder="videos" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('videos')
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