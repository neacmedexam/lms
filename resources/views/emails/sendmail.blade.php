
<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col items-center h-full lg:h-screen text-sm ">
      
        <h1 class="text-4xl p-4">Send Email</h1>
     
            <div class="lg:max-w-[50%] w-full p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
             
                <form id="createPostForm" method="POST" action="/sendmail/send/{{$getEmail->inquiryID}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Send To:</p>
                        <input type="email" name="email"  value="{{$getEmail->email}}" placeholder="sendto@email.com" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('email')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">From:</p>
                        <input type="email" name="from"  value="" placeholder="sender@email.com" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('from')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]">Subject:</p>
                        <input type="text" name="subject"  value="" placeholder="Subject" class="px-4 py-2 border border-gray-600 w-full">
                    
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        @error('subject')
                            <p class="text-red-600 text-xs whitespace-nowrap">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  font-bold lg:w-[29.5%]"></p>
                        <textarea class="px-4 py-2 border border-gray-600 w-full" name="content" id="content" cols="30" rows="10"></textarea>
                     
                    </div> --}}
                    
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <label for="editor" class="text-gray-600 font-semibold">Content</label>
                        <div id="editor" class="editor px-4 py-2 border border-gray-600 w-full"><div>
                    </div> --}}

                    {{-- <div class="flex flex-col space-y-2">
                       
                            <label for="editor" class="text-gray-600 font-semibold">Content</label>
                            <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><div>
                    </div> --}}


                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                         <div class="element px-4 py-2 border border-gray-600 w-full"></div>
                         <input type="text" name="content" id="content" class="content">
                    </div> --}}
                    <div class="flex justify-end items-center py-2 z-[99] mt-5">
                   
                        <button  type="submit" class=" px-4 py-2 border-2 bg-yellow-600  text-darkMode uppercase tracking-wide hover:scale-105 duration-300 transition-all ease-in-out">Send Email</button>
                    </div>

                    <textarea class="hidden" name="content" id="content"></textarea>
                    <div class="flex flex-row justify-evenly lg:items-center py-[2px] ">
                     
                        <div id="editor" class="mt-1  w-full rounded-md border-gray-300 shadow-sm"><div>
                        
                    </div>
                 

                  
                 
                
                </form>
          
            </div>
            
    </div>
</x-layouts>

