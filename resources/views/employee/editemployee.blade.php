<style>
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col justify-center items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 1):?>
        <h1 class="text-4xl p-4">Edit Employee</h1>
     

      
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
                <form method="POST" action="/viewemployee/{{$edit->id}}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="flex flex-row justify-center items-center w-full py-4">
                        <img class="w-[100px] h-[100px]" src="{{$edit->accountPicture ? asset('storage/' .$edit->accountPicture) : asset('storage/no_image/no-image.png')}} " alt="asdads" srcset="">
                    </div>
                    <div class="grid grid-cols-4 py-[2px]">
                        <p class="lg:px-4 font-bold">Image</p>
                        <input type="file" name="accountPicture" placeholder="Image" accept="image/*" class="col-span-3 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('accountPicture')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-4 py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold">Work site</p>
                        <select name="worksite" id="worksite" class="col-span-3 border px-4 py-2 w-full border-gray-600">
                            
                            @foreach ($worksite as $item)
                                <option name ="worksite" value={{$item->worksite}} <?php if($edit->worksite == $item->worksite) echo 'selected="selected"';?>>{{$item->worksite == 0 ? 'Inhouse' : 'Online'}}</option>
                            @endforeach
            
                        
                        </select>
                    </div>
                
                    
                    <div class="grid grid-cols-2 w-full">
                        
                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] w-full">
                            <p class="lg:px-4 whitespace-nowrap font-bold w-full ">First Name</p>
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

                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Username</p>
                        <input type="text" name="username"  value="{{$edit->username}}" placeholder="Username" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('username')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div> --}}
                    <div class="grid grid-cols-4 py-[2px]">
                        <p class="lg:px-4  font-bold w-full align-middle">Email</p>
                        <input type="text" name="email" disabled value="{{$edit->email}}" placeholder="Email address" class="col-span-3 px-4 py-2 border border-gray-600 w-full">
                        
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                    
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    

                   
            
                 
                    
                    <div class="grid grid-cols-4 py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold">Role</p>
                        <select name="userType" id="userType" class="col-span-3 border px-4 py-2 w-full border-gray-600">
                            
                            @foreach ($usertype as $list)
                                
                                <option <?php if($list->utID == $edit->userType) echo 'selected="selected"'; ?> value="{{$list->utID}}">{{$list->utName}}</option>
                                @endforeach
                          
                        
                        </select>
                    </div>
                    <div class="hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold">date created</p>
                  
                        <input type="datetime-local" name="dateCreated" value="{{$edit->dateCreated}}" placeholder="date created" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="hidden  flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Status</p>
                        <input type="text" name="isActive"  value="{{$edit->isActive}}" placeholder="status" class="px-4 py-2 border border-gray-600 w-full">
                        
                    </div>
                
                    {{-- <div class="flex justify-end items-center py-2">
                        <button type="submit" class="px-4 py-2 border-2 bg-yellow-600  text-darkMode uppercase tracking-wide hover:scale-105 duration-300 transition-all ease-in-out">Update Account</button>
                    </div> --}}

                    
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
                        <button type="button" class="px-6
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
                        ease-in-out" 
                        id="myBtn">
                        Change Password
                        </button>
                    </div>
                </form>
                
                
            </div>
            <form id="myModal" method="POST" action="/myprofile/changepassword/{{$edit->id}}" class="modal" >
                @csrf
                @method("PUT")
       
                <div class="modal-dialog relative pointer-events-none max-w-[50%] text-center w-full h-full m-auto ">
                    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Update Password</h5>
                            <button type="button"
                                class="close btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body relative p-4">
                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                <p class="lg:px-4  font-bold lg:w-[25%]">Password</p>
                                <input id="password" type="password" name="password" placeholder="Password" value="" class="password px-4 py-2 border border-gray-600 w-full">
                                {{-- <div class=" flex justify-end items-center absolute right-[15%]">
                                    <button><i class="bi bi-eye-slash  "></i></button>
                                </div> --}}
                                <p id="showpassword" onclick="showPw()" class="showpassword absolute right-[20px] cursor-pointer"><i class="bi bi-eye text-lg"></i></p>
                                <p id="hidepassword" onclick="showPw()" class="hidepassword hidden absolute right-[20px] cursor-pointer"><i class="bi bi-eye-slash text-lg"></i></p>

                            
                            </div>
                            <div class="flex flex-col justify-center items-center w-full">
                                @error('password')
                                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col lg:flex-row justify-end lg:items-center py-[2px]">
                            
                                <p class="cursor-pointer px-2 border border-yellow-600" onclick="genPassword()"><i class="bi bi-key-fill text-lg"></i></p>
                            </div>
                        </div>

                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="submit" class="px-6
                                py-2.5
                                bg-yellow-600
                                text-white
                                font-medium
                                text-xs
                                leading-tight
                                uppercase
                                rounded
                                shadow-md
                                transition
                                duration-150
                                ease-in-out">Save</button>

                        </div>
                    </div>
                </div>
            </form>
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
    
    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>