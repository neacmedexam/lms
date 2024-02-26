
<x-layouts>
    <div class="bg-bgMain w-full px-7 py-7 lg:p-7 flex flex-col lg:justify-center items-center h-full md:h-screen text-sm ">
        <?php if(auth()->user()->userType == 3 || auth()->user()->userType == 1 || auth()->user()->userType == 2):?>
        <h1 class="text-4xl p-4">Add Inquiry</h1>
        <div class="lg:max-w-[75%] w-full  justify-center p-6 bg-[#fff] shadow-lg shadow-gray-600">
            <form method="POST" action="/addinquiry" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col sm:flex-row justify-between items-center py-4">
                    <div class="flex flex-col items-center">
                        <div class="flex flex-row items-center">
                            <p class="lg:px-4 pr-2 whitespace-nowrap font-bold ">Lead Source<span class="text-red-600 font-bold">*</span></p>
                            <select id="inquiryLeadSource" name="inquiryLeadSource" class=" px-2 pr-8 py-[2px] " onchange="inhouseevent()">
                                
                                <option value="" class="w-full">Select</option>  
                                @foreach ($leadsource as $list)
                                    <option value="{{$list->leadsourceID}}" class="w-full">{{$list->leadSourceName}}</option>  
                                @endforeach
                                
                            </select>
                        </div>
                        @error('inquiryLeadSource')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="flex flex-row items-center">
                            <p class="lg:px-4 pr-2 whitespace-nowrap font-bold ">Scoring</p>
                            <select id="scoring" name="scoring" class=" px-2 pr-8 py-[2px] ">
                                
                            
                                <option value="1" class="w-full" >Hot Lead</option>
                                <option value="4" class="w-full">Warm Lead</option>  
                                <option value="2" class="w-full" selected>Cold Lead</option>  
                    
                                
                            </select>
                        </div>
                        @error('scoring')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                </div>
        
                {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">First Name</p>
                    <input type="text" placeholder="First name" name="applicantFirstName" class="px-4 py-2 border border-gray-600 w-full">
                </div>
                @error('applicantFirstName')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror

                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Last Name</p>
                    <input type="text" placeholder="Last name" name="applicantLastName" class="px-4 py-2 border border-gray-600 w-full">
                </div>
                @error('applicantLastName')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror --}}
                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Full Name<span class="text-red-600 font-bold">*</span></p>
                    <div class="w-full">
                    <input type="text" placeholder="Full name" name="applicantName" class="px-4 py-2 border border-gray-600 w-full">
                    @error('applicantName')
                        <p class="text-red-600 text-xs whitespace-nowrap text-center">{{$message}}</p>
                    @enderror
                    </div>
                </div>
                
                {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Nick Name</p>
                    <input type="text" placeholder="Nick name" name="" class="px-4 py-2 border border-gray-600 w-full">
                </div> --}}
                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Facebook Name</p>
                    <div class="flex flex-col  justify-evenly lg:items-center py-[2px] w-full">
                        <input type="text" placeholder="Facebook" name="fbName" class="px-4 py-2 border border-gray-600 w-full">
                        @error('fbName')
                        <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                </div>
              

                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Email Address</p>
                    <div class="flex flex-col  justify-evenly lg:items-center py-[2px] w-full">
                        <input type="text" placeholder="sample@email.com" name="email" class="px-4 py-2 border border-gray-600 w-full">
                
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                  
                </div>
                

                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Phone Number</p>
                    <input type="text" placeholder="09xxxxxxxxx" name="phoneNumber" class="px-4 py-2 border border-gray-600 w-full">
                </div>
                @error('phoneNumber')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror

                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 py-[4px] whitespace-nowrap font-bold lg:w-[25%]">country Reside</p>
                    <select  id="countryReside" name="countryReside" class="border px-4 py-2 w-full border-gray-600">
                        <option value="">Unknown</option>
                        @foreach ($countries as $list)
                        <option value="{{$list}}">{{$list}}</option>
                            
                        @endforeach
                    
                    </select>
                </div>
                @error('countryReside')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror
                
                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[25%]">Inquiry Type</p>
                    <!--<input type="text" placeholder="" name="nationality" class="px-4 py-2 border border-gray-600 w-full">-->
                    <select  id="inquiryType" name="inquiryType" class="border px-4 py-2 w-full border-gray-600">
                        @foreach ($inquirytype as $list)
                        <option value="{{$list->itID}}">{{$list->itName}}</option>
                            
                        @endforeach
                    
                    </select>
                </div>
                @error('nationality')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror

                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4   font-bold lg:w-[25%]">Services</p>
                    {{-- <select  id="cars" name="serviceType" class="border px-4 py-2 w-full border-gray-600"> --}}
                    <div class="border px-4 py-2 w-full h-[150px] overflow-auto border-gray-600 grid-container grid grid-cols-2">
     
                        @foreach ($services as $list)
                            {{-- <option value="{{$list->serviceID}}" class="">{{$list->serviceName}}</option> --}}
                                <div class="p-2">
                                <input class="p-2" type="checkbox" id="{{$list->serviceID}}" name="serviceType[]" value="{{$list->serviceID}}">
                                <label for="{{$list->serviceID}}" class="text-xs" >{{$list->serviceName}}</label>
                                </div>
                        @endforeach
                    </div>
                      @error('serviceType')
                    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                @enderror
                    {{-- </select> --}}
                </div>
              
                <div class="hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  font-bold lg:w-[29.5%]">representative</p>
                    <input type="text" name="representative" value="{{auth()->user()->id}}" placeholder="paymentStatus" class="px-4 py-2 border border-gray-600 w-full">
                    
                </div>
                <div class=" hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  font-bold lg:w-[29.5%]">account status</p>
                    <input type="text" name="paymentStatus" value="1" placeholder="paymentStatus" class="px-4 py-2 border border-gray-600 w-full">
                    
                </div>


                <!--<div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">-->
                <!--    <p class="lg:px-4 py-[4px] whitespace-nowrap font-bold lg:w-[25%]">Representative</p>-->
                <!--    {{-- <select  id="cars" name="representative" class="border px-4 py-2 w-full border-gray-600">-->
                <!--        @foreach ($representatives as $list)-->
                <!--            <option value="{{$list->id}}">{{$list->firstName .' '. $list->lastName}}</option>  -->
                <!--        @endforeach-->
                        
                <!--    </select> --}}-->
                <!--    <p class=" px-4 py-2 w-full">{{auth()->user()->firstName .' '. auth()->user()->lastName }}</p>-->
                <!--</div>-->
                <!--@error('representative')-->
                <!--    <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>-->
                <!--@enderror-->
                {{--             
                <div class="hidden  flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  font-bold lg:w-[29.5%]">date</p>
                    <input type="datetime-local" id="getdate" name="dateCreated" value="{{old('dateCreated')}}" placeholder="date created" class="px-4 py-2 border border-gray-600 w-full">
                </div>
                <div class=" hidden flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  font-bold lg:w-[29.5%]">account status</p>
                    <input type="text" name="isActive" value="1" placeholder="isActive" class="px-4 py-2 border border-gray-600 w-full">
                    
                </div> --}}

                <div class="flex justify-end items-center py-4" >
                    <a  href="/importinquiries" class=" mx-2 
                    px-6
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
                    transition-all
                    duration-350
                    ease-in-out
                    border
                    border-amber-600
                    {{auth()->user()->userType == 1  ? '' : 'hidden'}}
                    ">
                        Upload CSV
                    </a>
                    {{-- <button type="submit" class="px-4 py-2 border-2 bg-yellow-600  text-darkMode uppercase tracking-wide hover:scale-105 duration-300 transition-all ease-in-out"> --}}
                    <button class="
                    px-6
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
                    transition-all
                    duration-350
                    ease-in-out
                    border
                    border-amber-600
                    ">         
                        Submit
                    </button>
                </div>
            </form>
            
        </div>
     
        {{-- <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" 
        class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" 
        id="exampleModal" 
        tabindex="-1" 
        aria-labelledby="exampleModalLabel" 
        aria-hidden="true">
            @csrf
            @if ($errors->any())
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ol>
                
            @endif
            
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Upload CSV</h5>
                        <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body relative p-4">
                        <div class="flex flex-col lg:flex-col border justify-evenly p-4">
                   
                                                        
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700/10 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" 
                                    id="file_input" type="file" accept=".csv" name="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-700" id="file_input_help">CSV File only</p>

                        </div>
                        <div class="flex flex-col justify-center items-center w-full">
                            @error('file')
                                <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                            @enderror
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
                            ease-in-out">Upload</button>

                        <button type="button" class="px-6
                            py-2.5
                            bg-red-600
                            text-white
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            shadow-md
                        
                            transition
                            duration-150
                            ease-in-out
                            ml-1" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form> --}}
        <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
    </div>
    <script>
        function inhouseevent(){
            
            var country = document.getElementById("countryReside");
            var leaddsource = document.getElementById("inquiryLeadSource");
            if(leaddsource.options[leaddsource.selectedIndex].value == 5 || leaddsource.options[leaddsource.selectedIndex].value == 8){
                country.value = 'Philippines';
                // alert(leaddsource.options[leaddsource.selectedIndex].value);
            }
            else{
                country.value = "";
            }
           
        }

    </script>
</x-layouts>