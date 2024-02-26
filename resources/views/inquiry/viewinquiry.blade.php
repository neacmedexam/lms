
<x-layouts>
  <div class="bg-bgMain w-full h-screen p-7">
    
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <h1 class="text-4xl py-2">Inquiries</h1>
          
          <!--<div class="flex items-center">-->
          <!--  <p class="font-bold px-2">{{empty($_GET['search'])  ? '' : "Search: " }} </p>-->
          <!--  <p class="px-2 text-sm italic">{{empty($_GET['search']) ? '' : '"'.$_GET['search'].'"'}}</p>-->
          <!--  <p class="font-bold px-2">{{empty($_GET['category']) && empty($_GET['advSearch'])  ? '' : "Search: " }} </p>-->
          <!--  <p class="px-2 text-sm italic">{{empty($_GET['category']) ? '' : '"'.$_GET['category']}}</p>-->
          <!--  <p class="px-2 text-sm italic">{{empty($_GET['advSearch']) ? '' : $_GET['advSearch'].'"'}}</p>-->
          <!--  <p class="font-bold px-2">{{empty($_GET['category']) && empty($_GET['advSearch']) && $fetchService && $fetchStatus  ? 'Search:' : '' }} </p>-->
          <!--  <p class="px-2 text-sm italic">{{empty($_GET['services'])  ? '' : '"' .$fetchService}} {{ empty($_GET['services']) && empty($_GET['status']) ? '' : '-'}} {{empty($_GET['status']) ? '' : $fetchStatus.'"'}}-->

       
          <!--</div>-->
  

        </div>
        <!--{{-- <div class="flex sm:flex-row flex-col lg:justify-evenly lg:items-center p-4"> --}}-->
        <div class="flex sm:flex-row flex-col lg:justify-between lg:items-center">
          <!--<form>-->
          <!--  <div class="w-full px-2 flex flex-col h-full">-->
          <!--    <p class="">Advanced Search</p>-->
          <!--    <div class="flex items-center">-->
          <!--      <i class="bi bi-search absolute ml-4 text-gray-400"></i>-->
          <!--      <input type="text" name="search" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}" class=" px-4 py-2 pl-8" placeholder="Search">-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</form>-->
          
          <form class="py-2 w-full">
            <div class=" flex flex-col justify-evenly sm:flex-row items-center w-full ">
              <div class="w-full flex flex-col h-full w-full ">
                <p class="">Specific Searching</p>
                <div class="flex sm:flex-row flex-col items-center justify-center w-full">
                  <select name="category" id="category" class=" px-4 sm:pr-8 py-2 w-full">
                             @php $ref = (isset($_GET['category'])) ? $_GET['category'] : ''; @endphp
                    <option value=""  @if( $ref == '' ) selected @endif>Select</option>
                    <option value="inquiryID"  @if( $ref == 'inquiryID' ) selected @endif>Inquiry No.</option>
                    <!--<option value="serviceName" @if( $ref == 'serviceName' ) selected @endif>Service</option>-->
                    <option value="applicantName" @if( $ref == 'applicantName' ) selected @endif>Full Name</option>
                    <option value="fbName" @if( $ref == 'fbName' ) selected @endif>Facebook</option>
                    <option value="email" @if( $ref == 'email' ) selected @endif>Email Address</option>
                    <option value="scoringName" @if( $ref == 'scoringName' ) selected @endif>Scoring</option>
                    <!--<option value="phoneNumber" @if( $ref == 'phoneNumber' ) selected @endif>Phone Number</option>-->
                    <!--<option value="countryReside" @if( $ref == 'countryReside' ) selected @endif>Country Reside</option>-->
              
                  </select>
                  <input type="text" name="advSearch" class=" mx-[2px] px-4 sm:pr-8 py-2 w-full" placeholder="Search" value="{{isset($_GET['advSearch']) ? $_GET['advSearch'] : ''}}">
                </div>
              </div>
      
              
              <div class="w-full px-2 flex flex-col h-full w-full ">
                <p class="">Application Status</p>
                <div class="w-full flex flex-row justify-between h-full">
                  <select name="services" id="services" class="  px-4 sm:pr-8 py-2 w-full">
                        @php $ref = (isset($_GET['services'])) ? $_GET['services'] : ''; @endphp
                    <option value=""  @if( $ref == '' ) selected @endif>Select</option>
                    @foreach ($services as $list)
                    <option value="{{$list->serviceID}}" class="w-full"  @if( $ref == $list->serviceID ) selected @endif>{{$list->serviceName}}</option>  
                    @endforeach
              
                  </select>
                  <select name="status" id="status" class=" mx-[2px] px-4 sm:pr-8 py-2 w-full">
                              @php $ref = (isset($_GET['status'])) ? $_GET['status'] : ''; @endphp
                    <option value="">Select</option>
                    @foreach ($status as $list)
                    <option value="{{$list->statusID}}" class="w-full" @if( $ref == $list->statusID ) selected @endif>{{$list->statusName}}</option>  
                    @endforeach
              
                  </select>
                </div>
               
           
              </div>
  
              <div class=" flex flex-col justify-end w-full ">
                  <div class="w-full invisible">a</div>
                  <div class="flex flex-row items-center justify-end w-full">
                         <div class="invisible w-full">a</div>
                    <button class="
                    px-6
                    py-3
                    bg-yellow-500
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-yellow-600 hover:shadow-lg
                    focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-yellow-600 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    border-yellow-600
                    mx-2
                    ">   
                        Search
                    </button>
                           <a href="{{url('/viewinquiries')}}" class="
                    px-6
                    py-3
                    bg-red-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-red-700 hover:shadow-lg
                    focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-red-700 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    border-amber-600
                    ">   
                        Clear
                    </a>
                  </div>
             
              </div>
              
            </div>
          </form>
          
        </div>
        <div class="flex items-center justify-end py-2 w-full">
          <div class="invisible">a</div>
          <a class="px-4
          mx-[2px]
          py-3
          bg-green-600
          text-white
          font-medium
          text-sm
          leading-tight
          uppercase
          shadow-md
          hover:bg-green-700 hover:shadow-lg
          focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-green-700 active:shadow-lg
          transition-all
          duration-350
          ease-in-out
          {{auth()->user()->userType == 1  ? '' : 'hidden'}}" 
          href="{{ route('users.export') }}">
          Export Table
        </a>
        </div>
        <div class="px-4 py-2">
                 {{ $inquiries->appends(request()->all())->links() }}
        </div> 
   
        
        
        <div class="overflow-auto h-[65%] shadow-md shadow-black">

                   
          <table class="table-auto text-left text-xs w-full  max-w-[50%] lg:max-w-[100%] bg-white  py-4">
            
              <thead class="border-b bg-white shadow-sm sticky top-0">
                <tr>
                  <th class="px-4 py-2">Inquiry No.</th>
                  {{-- <th class="px-4 py-2">First Name</th>
                  <th class="px-4 py-2">Last Name</th> --}}
                  <th class="px-4 py-2">Full Name</th>
                  <th class="px-4 py-2">Facebook</th>
                  <th class="px-4 py-2">Email</th>
                  <th class="px-4 py-2">Scoring</th>
                  <th class="px-4 py-2">Department</th>
                  <!--<th class=" py-2">Status</th>-->
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody class="overflow-y-auto">
                @if (count($inquiries) > 0)
                  @foreach ($inquiries as $list)
                    <tr class="border-b-2 py-2">
                    
                      <td class="px-4 py-2">{{$list->inquiryID}}</td>
                      {{-- <td class="px-4 py-2">{{$list->applicantFirstName}}</td>
                      <td class="px-4 py-2">{{$list->applicantLastName}}</td> --}}
                      <td class="px-4 py-2">{{$list->applicantName}}</td>
                      <td class="px-4 py-2">{{$list->fbName}}</td>
                      <td class="px-4 py-2">{{$list->email}}</td>
                      <td class="px-4 py-2"><p class=" p-1 px-2 inline-block text-center rounded-full text-white text-xs {{$list->scoringName == 'Signed Up' ? 'bg-green-600' : ($list->scoringName == 'Hot Lead' ? 'bg-red-600' : ($list->scoringName == 'Warm Lead' ? 'bg-orange-600' : 'bg-blue-600') ) }}">{{$list->scoringName}}</p></td>
                      <td class="px-4 py-2">{{$list->itName}}</td>
                      <!--<td class=" py-2 px-2 text-xs font-semibold leading-5 {{$list->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$list->isActive == 1 ? 'Active' : 'Deactivated Inquiry'}}</td>-->
                
                      <td class="px-4 py-2 whitespace-nowrap">
                        <a href="viewinquiries/{{$list->inquiryID}}" title="View Inquiry" target="_blank" rel="noopener noreferrer"><i class="bi bi-eye-fill"></i></a>
                          @if(auth()->user()->userType == 1 || auth()->user()->userType == 2 || auth()->user()->userType == 3)
                            <a href="/viewinquiries/edit/{{$list->inquiryID}}" title="Edit" target="_blank" rel="noopener noreferrer"><i class="bi bi-pencil-square text-blue-600"></i></a>
                              @if ($list->isActive == 0)
                                <form action="/reactivateinquiry/{{$list->inquiryID}}" method="POST" class="inline">
                                  @csrf
                                  @method("PUT")
                                  <button type="submit"><i class="bi bi-check-lg text-green-600"></i></button>
                                </form>
                              @endif
                              <form action="/deleteinquiry/delete/{{$list->inquiryID}}" method="POST" class="{{$list->isActive == 1 && auth()->user()->userType == 1 ? "inline" : "hidden"}} ">
                              @csrf
                              @method("PUT")
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this inquiry?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
              
                              </form>
                              <a href="/sendmail/{{$list->inquiryID}}" title="Email"><i class="bi bi-envelope-fill text-sky-500"></i></a>
                          @endif
                      </td>
                    </tr>
                  @endforeach
                @else
                    <tr class="border-b-2 py-2">
                        <td class="px-4 py-2 text-center" colspan="6">No Record</td>    
                    </tr>
                @endif
                
                
              </tbody>
          </table>
        </div>
 
      <!--<div class=" p-4 bottom-0">-->
      <!--  {{-- {{$inquiries->links()}} --}}-->
      <!--  {{ $inquiries->appends(request()->all())->links() }}-->
      <!--</div>-->
  </div>

</x-layouts>