
<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 1):?>
        <h1 class="text-4xl p-4">Edit Services</h1>
     

      
            <div class="lg:max-w-[50%] w-full p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
                {{-- <div class="flex flex-row items-center py-4">
                    <p class="lg:px-4 pr-2 whitespace-nowrap font-bold ">Lead Source</p>
                    <select name="cars" id="cars" class="border-2 px-4 py-[2px] border-gray-600">
                        <option value="volvo">Facebook</option>
                        <option value="saab">Email</option>
                        <option value="mercedes">Inhouse Applicant</option>
                        <option value="audi">Applicant Referral</option>
                    </select>
                </div> --}}
                {{-- edit form --}}
                <form method="POST" action="/settings/{{$edit->serviceID}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    
                    
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Service ID:</p>
                        <input type="text" disabled name="serviceID"   value="{{$edit->serviceID}}" placeholder="serviceID" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('serviceID')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Service Name</p>
                        <input type="text" name="serviceName"  value="{{$edit->serviceName}}" placeholder="serviceName" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('serviceName')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Status</p>
                        <input type="text" name="isActive"  disabled value="{{$edit->isActive == 1 ? 'Active' : 'Disabled'}}" placeholder="scoringName" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    
  
                
                    <div class="flex justify-end items-center py-2">
                        <button type="submit" class=" mt-2 sm:mt-0  px-6
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
                        ease-in-out">Update</button>
                    </div>
                </form>
                
                
            </div>
        <?php else: ?>
            <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>