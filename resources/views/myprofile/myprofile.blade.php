
<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <h1 class="text-4xl p-4">My Profile</h1>
   
            <div class="lg:max-w-[50%] w-full   justify-center p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
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
                <form method="POST" action="/myprofile/{{$edit->id}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="flex flex-row justify-center items-center w-full py-4">
                        <img class="w-[100px] h-[100px]" src="{{$edit->accountPicture ? asset('public/storage/' .$edit->accountPicture) : asset('public/storage/no_image/No_Image_Available.jpg')}} " alt="asdads" srcset="">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 font-bold lg:w-[29.2%]">Image</p>
                        <input type="file" name="accountPicture" placeholder="Image" accept="image/*" class=" border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('accountPicture')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-row justify-between items-center w-full">
                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full mr-1">
                            <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[68%] ">First Name</p>
                            <input type="text" name="firstName" value="{{$edit->firstName}}" placeholder="First name" class="px-4 py-2 border border-gray-600 w-full">
                            
                        </div>
                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full">
                            <p class="lg:px-4 whitespace-nowrap font-bold ">Last Name</p>
                            <input type="text" name="lastName" value="{{$edit->lastName}}" placeholder="Last name" class="px-4 py-2 border border-gray-600 w-full">
                            
                        </div>
                    </div>
                    <div class="flex flex-row justify-evenly items-center w-full">
                        <div class="flex flex-col justify-center items-center w-full">
                            @error('firstName')
                                <p class="text-red-600 text-xs whitespace-nowrap text-left">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-center items-center w-full">
                            @error('lastName')
                                <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- 
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Username</p>
                        <input type="text" name="username"  value="{{$edit->username}}" placeholder="Username" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('username')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div> --}}
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Email</p>
                        <input type="text" name="email" disabled value="{{$edit->email}}" placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                        
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                    
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>



                   
                  
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[29.5%]">Role</p>
                        <select name="userType" id="userType" disabled class="border px-4 py-2 w-full border-gray-600">
                            
                            @foreach ($usertype as $list)
                                {{-- <option value="{{$edit->userType}}">{{($edit->userType == 1 ? 'Admin' : ($edit->userType == 2 ? 'LC' : ($edit->userType == 3 ? 'QA' : 'Managers')))}}</option>
                   --}}
                                <option <?php if($list->utID == $edit->userType) echo 'selected="selected"'; ?> value="{{$list->utID}}">{{$list->utName}}</option>
                                @endforeach
                        
                        </select>
                    </div>
                    <div class="hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">date created</p>
                  
                        <input type="datetime-local" name="dateCreated" value="{{$edit->dateCreated}}" placeholder="date created" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="hidden  flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Status</p>
                        <input type="text" name="isActive"  value="{{$edit->isActive}}" placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                        
                    </div>
                
                    <div class="flex justify-end items-center py-2">
                        <button type="submit" class="
                        px-6
                        py-2
                        mx-2
                        bg-yellow-600
                        text-white
                        font-medium
                        text-xs
                        leading-tight
                        uppercase
                        shadow-md
                        hover:bg-amber-600 hover:shadow-lg
                        focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-amber-600 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out
                        ">Update Account</button>
                        <a href="/myprofile/changepassword/{{$edit->id}}" type="button" class="px-6
                        py-2
                        bg-yellow-600
                        text-white
                        font-medium
                        text-xs
                        leading-tight
                        uppercase
                        shadow-md
                        hover:bg-amber-600 hover:shadow-lg
                        focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-amber-600 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out">
                        Change Password
                        </a>
                    </div>
                </form>
                {{-- <div class=" flex justify-end items-center w-full">
                
                </div>
                 --}}

                <!-- Modal -->
                
            </div>
         </div>
</x-layouts>
