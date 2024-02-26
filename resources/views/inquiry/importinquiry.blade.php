

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col items-center h-full lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 1):?>
        <h1 class="text-4xl p-4">Import Inquiry</h1>
     

      
            <div class="lg:max-w-[50%] w-full p-6 py-10 bg-[#fff] shadow-lg shadow-gray-600">
             
                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" >
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
                    <div class="p-4">
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
                    <div class="flex justify-end px-4"> 
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
                    </div>
                   
                </form>
                
                
            </div>
        <?php else: ?>
            <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>

