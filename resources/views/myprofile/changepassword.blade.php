
<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col items-center h-full lg:h-screen text-sm ">
        <h1 class="text-4xl p-4">Change Password</h1>
     

      
            <div class="lg:max-w-[50%] w-full p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
             
                <form method="POST" action="/myprofile/changepassword/{{$edit->id}}">
                    @csrf
                    @method("PUT")
                     
                            <div class="p-4">
                                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                    <p class="lg:px-4  font-bold lg:w-[25%]">Password</p>
                                    <input id="password" type="password" name="password" placeholder="Password" value="" class="password px-4 py-2 border border-gray-600 w-full">
                         
                                    <p id="showpassword" onclick="showPw()" class="showpassword absolute sm:right-[350px] cursor-pointer"></p>
                                    <p id="hidepassword" onclick="showPw()" class="hidepassword hidden absolute sm:right-[350px] cursor-pointer"></p>

                                
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

                            <div class=" flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
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
                </form>
                
                
            </div>
      
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