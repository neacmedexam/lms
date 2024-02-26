
@props(['settings'])

<x-layouts>
    <div class="bg-bgMain w-full p-7 flex flex-col items-center lg:h-screen text-sm ">
        <?php if(auth()->user()->userType == 1):?>
        <h1 class="text-4xl p-4">Settings</h1>

            <div class=" w-full p-6 py-10 bg-[#fff]/80 shadow-lg shadow-gray-600 overflow-auto h-full  ">
              
                <div class="w-full  flex flex-col   mx-auto ">

                    <div class="flex flex-col sm:flex-row justify-center items-center " id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                      
                        <button class="lcdashboard px-4 uppercase font-bold" id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">services</button>
                        <button class="lcdashboard px-4 uppercase font-bold" id="scoring-tab" data-tabs-target="#scoring" type="button" role="tab" aria-controls="scoring" aria-selected="true  ">scoring</button>
                        <button class="lcdashboard px-4 uppercase font-bold" id="status-tab" data-tabs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="false  ">inquiry status</button>
                        {{-- <button class="lcdashboard px-4 uppercase font-bold" id="usertype-tab" data-tabs-target="#usertype" type="button" role="tab" aria-controls="usertype" aria-selected="false  ">usertype</button> --}}
                        <button class="lcdashboard px-4 uppercase font-bold" id="leadsource-tab" data-tabs-target="#leadsource" type="button" role="tab" aria-controls="leadsource" aria-selected="false  ">leadsource</button>
                      
                    </div>
            
                        <div id="myTabContent w-full">
                            <div class="px-4 " id="services" role="tabpanel" aria-labelledby="services-tab">
                                <table class="table-auto  text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white  shadow-md shadow-black">
                                    <thead class="border-b border-gray-600 ">
                                        <tr class="">
                                            <th class="px-4 py-2">Service ID</th>
                                            <th class="px-4 py-2">Service Name</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $item)
                                            <tr class="border-b-2 py-2">
                                                <td class="px-4 py-2">{{$item->serviceID}}</td>
                                                <td class="px-4 py-2">{{$item->serviceName}}</td>
                                                <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$item->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$item->isActive == 1 ? 'Active' : 'Disabled'}}</td>
               
                                                <td class="px-4 py-2">
                                                    <a href="/settings/services/edit/{{$item->serviceID}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                                                    @if ($item->isActive == 0)
                                                    <form action="/reactivateservice/{{$item->serviceID}}" method="POST" class="inline">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                                    
                                                    </form>
                                                
                                                    @endif
                                                    <form action="/deleteservice/{{$item->serviceID}}" method="POST" class= {{$item->isActive == 0 ? "hidden" : "inline"}}>
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this service?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
                                         
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <div class="mt-6 p-4 bottom-0">
                                        {{$services->links()}}
                                    </div>
                                </table>
                                <div class="flex justify-end items-center py-4">
                                    <a href="/settings/services/addservice" title="Add Service">
                                                  
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
                                    ease-in-out">Add New Service</button>
                                    </a>
                                </div>
                                <div class="mt-6 p-4 bottom-0 ">
                                    {{$services->links()}}
                                </div>
                            </div>
                            
                            <div class="p-4" id="scoring" role="tabpanel" aria-labelledby="scoring-tab">
                                <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black  ">
                                    <thead class="border-b border-black ">
                                        <tr class="">
                                            <th class="px-4 py-2">Scoring ID</th>
                                            <th class="px-4 py-2">Scoring Name</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scoring as $item)
                                            <tr class="border-b-2 py-2">
                                                <td class="px-4 py-2">{{$item->scoringID}}</td>
                                                <td class="px-4 py-2">{{$item->scoringName}}</td>
                                                <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$item->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$item->isActive == 1 ? 'Active' : 'Disabled'}}</td>
               
                                                <td class="px-4 py-2">
                                                    <a href="/settings/scoring/edit/{{$item->scoringID}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                                                    {{-- <a href="" title="Delete"><i class="bi bi-trash3-fill text-red-600"></i></a> --}}
                                                    @if ($item->isActive == 0)
                                                    <form action="/reactivatescoring/{{$item->scoringID}}" method="POST" class="inline">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                                    
                                                    </form>
                                                
                                                    @endif
                                                    <form action="/deletescoring/{{$item->scoringID}}" method="POST" class={{$item->isActive == 0 ? "hidden" : "inline"}}>
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this scoring?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
                                         
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    </table>
                                    {{-- <div class="mt-6 p-4 bottom-0">
                                
                                    </div> --}}
                                    <div class="flex justify-end items-center py-4">
                                        <a href="/settings/services/addscoring" title="Add Scoring">
                                                  
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
                                            ease-in-out">Add New Scoring</button>
                                        </a>
                                    </div>
                            </div>
                            <div class="p-4" id="status" role="tabpanel" aria-labelledby="status-tab">
                                <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black  ">
                                    <thead class="border-b border-black ">
                                        <tr class="">
                                            <th class="px-4 py-2">Status ID</th>
                                            <th class="px-4 py-2">Status Name</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status as $item)
                                            <tr class="border-b-2 py-2">
                                                <td class="px-4 py-2">{{$item->statusID}}</td>
                                                <td class="px-4 py-2">{{$item->statusName}}</td>
                                                <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$item->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$item->isActive == 1 ? 'Active' : 'Disabled'}}</td>
               
                                                <td class="px-4 py-2">
                                                    <a href="/settings/inquirystatus/edit/{{$item->statusID}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                                                    @if ($item->isActive == 0)
                                                    <form action="/reactivatestatus/{{$item->statusID}}" method="POST" class="inline">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                                    
                                                    </form>
                                                
                                                    @endif
                                                    <form action="/deletestatus/{{$item->statusID}}" method="POST" class={{$item->isActive == 0 ? "hidden" : "inline"}}>
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this status?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
                                         
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    </table>
                                    {{-- <div class="mt-6 p-4 bottom-0">
                                
                                    </div> --}}
                                    <div class="flex justify-end items-center py-4">
                                        <a href="/settings/services/addstatus" title="Add Inquiry Status">
                                                  
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
                                            ease-in-out">Add New Status</button>
                                        </a>
                                    </div>
                            </div>
                            {{-- <div class="p-4" id="usertype" role="tabpanel" aria-labelledby="usertype-tab">
                                <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black  ">
                                    <thead class="border-b border-black ">
                                        <tr class="">
                                            <th class="px-4 py-2">Usertype ID</th>
                                            <th class="px-4 py-2">Usertype Name</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usertype as $item)
                                            <tr class="border-b-2 py-2">
                                                <td class="px-4 py-2">{{$item->utID}}</td>
                                                <td class="px-4 py-2">{{$item->utName}}</td>
                                                <td class="px-4 py-2">{{$item->isActive == 1 ? 'Active' : 'Disabled'}}</td>
                                                <td class="px-4 py-2">
                                                    <a href="/settings/usertype/edit/{{$item->utID}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                                                    @if ($item->isActive == 0)
                                                    <form action="/reactivateusertype/{{$item->utID}}" method="POST" class="inline">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                                    
                                                    </form>
                                                
                                                    @endif
                                                    <form action="/deleteusertype/{{$item->utID}}" method="POST" class="inline">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" title="Delete"><i class="bi bi-trash3-fill text-red-600"></i></button>
                                         
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    </table>
                                 
                                    <div class="flex justify-end items-center py-4">
                                        <a href="/settings/services/addusertype" title="Add Inquiry Status">
                                                  
                                            <button type="submit" class="px-4 py-2 border-2 bg-yellow-600  text-darkMode uppercase tracking-wide hover:scale-105 duration-300 transition-all ease-in-out">Add</button>
                                        </a>
                                    </div>
                            </div> --}}
                            <div class="p-4" id="leadsource" role="tabpanel" aria-labelledby="leadsource-tab">
                                <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black  ">
                                    <thead class="border-b border-black ">
                                        <tr class="">
                                            <th class="px-4 py-2">Lead Source ID</th>
                                            <th class="px-4 py-2">Lead Source Name</th>
                                            <th class="px-4 py-2">Status</th>
                                            <th class="px-4 py-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leadsource as $item)
                                            <tr class="border-b-2 py-2">
                                                <td class="px-4 py-2">{{$item->leadsourceID}}</td>
                                                <td class="px-4 py-2">{{$item->leadSourceName}}</td>
                                                <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$item->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$item->isActive == 1 ? 'Active' : 'Disabled'}}</td>
               
                                                <td class="px-4 py-2">
                                                    <a href="/settings/leadsource/edit/{{$item->leadsourceID}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                                                    @if ($item->isActive == 0)
                                                    <form action="/reactivateleadsource/{{$item->leadsourceID}}" method="POST" class="inline">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                                    
                                                    </form>
                                                
                                                    @endif
                                                    <form action="/deleteleadsource/{{$item->leadsourceID}}" method="POST" class={{$item->isActive == 0 ? "hidden" : "inline"}}>
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this lead source?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
                                         
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    </table>
                                    {{-- <div class="mt-6 p-4 bottom-0">
                                        <button class="p-4 bg-blue-600">Add</button>
                                        
                                    </div> --}}
                                    <div class="flex justify-end items-center py-4">
                                        <a href="/settings/services/addleadsource" title="Add Inquiry Status">    
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
                                            ease-in-out">Add New Lead Source</button>
                                        </a>
                                    </div>
                            </div>
                            
                        
                        </div>
                  
                </div>
                
            </div>
        <?php else: ?>
            <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </div>
</x-layouts>