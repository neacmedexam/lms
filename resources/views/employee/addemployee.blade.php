
@props(['addemployees'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 1):?>
            <h1 class="text-4xl p-4">Add Employee</h1>
     

      
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
                <form method="POST" action="/addemployee" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[29.5%]">Work site</p>
                        <select name="worksite" id="worksite" class="border px-4 py-2 w-full border-gray-600">
                            
                  
                            <option name ="worksite" value=0>Inhouse</option>
                            <option name ="worksite" value=1>Online</option>
            
                        
                        </select>
                    </div>
                    
                    <div class="flex flex-row justify-between items-center w-full">
                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full mr-1">
                            <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[68%] ">First Name</p>
                            <input type="text" name="firstName" value="{{old('firstName')}}" placeholder="First name" class="px-4 py-2 border border-gray-600 w-full">
                            
                        </div>
                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full">
                            <p class="lg:px-4 whitespace-nowrap font-bold ">Last Name</p>
                            <input type="text" name="lastName" value="{{old('lastName')}}" placeholder="Last name" class="px-4 py-2 border border-gray-600 w-full">
                            
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
                
                    
                                
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 font-bold lg:w-[29.2%]">Image</p>
                        <input type="file" name="accountPicture" placeholder="Image" accept="image/*" class=" border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('accountPicture')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Username</p>
                        <input type="text" name="username" value="{{old('username')}}" placeholder="Username" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('username')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[25%]">Password</p>
                        <input id="password" type="password" name="password" placeholder="Password" class="password px-4 py-2 border border-gray-600 w-full">
                        <p id="showpassword" onclick="showPw()" class="showpassword absolute right-[340px] cursor-pointer"><i class="bi bi-eye text-lg"></i></p>
                        <p id="hidepassword" onclick="showPw()" class="hidepassword hidden absolute right-[340px] cursor-pointer"><i class="bi bi-eye-slash text-lg"></i></p>
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('password')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col lg:flex-row justify-end lg:items-center py-[2px]">
                     
                        <p class="cursor-pointer px-2 border border-yellow-600" onclick="genPassword()"><i class="bi bi-key-fill text-lg"></i></p>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[25%]">Confirm Password</p>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('password_confirmation')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Email</p>
                        <input type="text" name="email" value="{{old('email')}}" placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                        
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                    
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[29.5%]">Role</p>
                        <select name="userType" id="userType" class="border px-4 py-2 w-full border-gray-600">
                            
                            @foreach ($usertype as $ut)
                            <option value="{{$ut->utID}}">{{$ut->utName}}</option>
                            @endforeach
                        
                        </select>
                    </div>
                    
                    {{-- <div class="hidden  flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">date</p>
                        <input type="datetime-local" id="getdate" name="dateCreated" value="{{old('dateCreated')}}" placeholder="date created" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class=" hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">active</p>
                        <input type="text" name="isActive" value="1" placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                        
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
            <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>
<script>
    var password=document.getElementById("password");
 
    function genPassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 8;
    var password = "";
    for (var i = 0; i <= passwordLength; i++) {
    var randomNumber = Math.floor(Math.random() * chars.length);
    password += chars.substring(randomNumber, randomNumber +1);
    }
        document.getElementById("password").value = password;
    }

    var show = document.getElementById("showpassword");
    var hide = document.getElementById("hidepassword");

    function showPw(){
        const pw = document.querySelector('.password')
        if(pw.type == 'password'){
            pw.type = 'text';
            show.style.display = "none";
            hide.style.display = "block";
            
        }else{
            pw.type = 'password'
        }
    }
 
</script>