
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-screen lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1 || auth()->user()->userType == 3):?>
        <h1 class="text-3xl px-4 py-2 text-center">Edit Record</h1>
        <!--<p class="p-4">Add Participant</p>-->
     

      
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
               @if(session()->has('success'))
       
            
                    <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                      <!--<strong class="font-bold">Holy smokes!</strong>-->
                      <span class="block sm:inline">{{ session()->get('success') }}</span>
                      <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert()">
                        <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-black/60" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                      </span>
                    </div>
                @endif 
                <form method="POST" action="{{route('events.editparticipant',$events->eventRecordID)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
    
                        <input type="hidden" name="events" value="{{$events->eventID}}" placeholder="Full Name" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
      
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Full Name<span class="text-red-600">*</span></p>
                        <input type="text" name="fullName" value="{{$events->fullName}}" placeholder="Full Name" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('fullName')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Email<span class="text-red-600">*</span></p>
                        <input type="text" name="email" value="{{$events->email}}" placeholder="Email" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Contact Number<span class="text-red-600">*</span></p>
                        <input type="text" name="contactNumber" value="{{$events->contactNumber}}" placeholder="Contact Number" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('contactNumber')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">PREFERRED STATE/COUNTRY/SERVICE<span class="text-red-600">*</span></p>
                        <input type="text" name="statecountry" value="{{$events->statecountry}}" placeholder="PREFERRED STATE/COUNTRY/SERVICE" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('statecountry')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Facebook</p>
                        <input type="text" name="facebook" value="{{$events->fb}}" placeholder="Facebook" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('facebook')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[38.1%]">Status</p>
                        <select name="status" class="px-4 py-2 border border-gray-600 w-full">
                            <option value="Inquiry" {{$events->status == 'Inquiry' ? 'selected' : ''}}>Inquiry</option>
                            <option value="Existing" {{$events->status == 'Existing' ? 'selected' : ''}}>Existing</option>
                            <option value="Availed" {{$events->status == 'Availed' ? 'selected' : ''}}>Availed</option>
                        </select>
                        <!--<input type="text" name="facebook" value="{{$events->fb}}" placeholder="Facebook" class="px-4 py-2 border border-gray-600 w-full">-->
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('facebook')
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
                        mr-1
                        ">
                            Update
                        </button>
                        <a href="/events/viewevents/record/{{$events->eventID}}" class="
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

<script>
    var x = document.getElementById("alert");
    function closeAlert(){
        x.style.display = "none";
    }
</script>