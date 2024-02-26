
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-screen lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1 || auth()->user()->userType == 3):?>
        <h1 class="text-4xl p-4">Edit Event</h1>
     

      
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
               
                <form method="POST" action=" {{route('events.update',$events->eventID)}}" enctype="multipart/form-data">
                      @csrf
                    @method("PUT")
             
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Event Name</p>
                        <input type="text" name="eventname" value="{{$events->eventName}}" placeholder="Event Name" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('eventname')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
              
                
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
                        mr-2
                        ">
                            Update
                        </button>
                        <a href="/events/viewevents" class="
                        px-6
                        py-3
                        bg-red-600
                        text-white
                        font-medium
                        text-sm
                        leading-tight
                        uppercase
                        shadow-md
                        hover:bg-red-700 hover:shadow-lg
                        focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-red-700 active:shadow-lg
                        transition-all
                        duration-350
                        ease-in-out
                        ">   
                            Back
                        </a>
                    </div>
                </form>
                
                
            </div>
        <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>