

{{-- @extends('layout')
@section('content') --}}
{{-- @props(['viewemployee'])
 --}}


<x-layouts>
  <x-card>
    <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 3):?>
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <h1 class="text-4xl py-4">Employees</h1>
        <!--  <div class="flex items-center">-->
        <!--    <p class="font-bold px-2">{{empty($_GET['search'])  ? '' : "Search: " }} </p>-->
        <!--    <p class="px-2 text-sm italic">{{empty($_GET['search']) ? '' : '"'.$_GET['search'].'"'}}</p>-->
        <!--    <p class="font-bold px-2">{{empty($_GET['category']) && empty($_GET['advSearch'])  ? '' : "Search: " }} </p>-->
        <!--    <p class="px-2 text-sm italic">{{empty($_GET['category']) ? '' : '"'.$_GET['category']}}</p>-->
        <!--    <p class="px-2 text-sm italic">{{empty($_GET['advSearch']) ? '' : $_GET['advSearch'].'"'}}</p>-->
        <!--</div>-->
        </div>
          <div class="flex sm:flex-row flex-col lg:justify-between lg:items-center py-4">
            <form>
              <div class="flex flex-row items-center justify-center">
                <p class="pr-2">Advanced Search</p>
                <div class="flex items-center">
                  <i class="bi bi-search absolute ml-4 text-gray-400"></i>
                  <input type="text" name="search" id="search" class=" px-4 py-2 pl-8" placeholder="Search" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}">
                </div>
              </div>
            </form>
            <form>
              <div class=" hidden lg:block">
                <select name="category" id="category" class="px-4 py-2">
                      @php $ref = (isset($_GET['category'])) ? $_GET['category'] : ''; @endphp
                  <option value="" @if( $ref == '' ) selected @endif>Select</option>
                  <option value="id" @if( $ref == 'id' ) selected @endif>Account ID</option>
                  {{-- <option value="firstName">First Name</option>
                  <option value="lastName">Last Name</option> --}}
                  <option value="fullName" @if( $ref == 'fullName' ) selected @endif>Full Name</option>
                  {{-- <option value="username">Username</option> --}}
                  <option value="email" @if( $ref == 'email' ) selected @endif>Email Address</option>
                  <option value="userType" @if( $ref == 'userType' ) selected @endif>Position/Role</option>
                </select>
                <input type="text" name="advSearch" class="px-4 py-2" value="{{isset($_GET['advSearch']) ? $_GET['advSearch'] : ''}}">
                
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
                ">   
                    Search
                </button>
                <a href="{{url('/viewemployee')}}" class="
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
            </form>
          </div>
           
          <div class="overflow-auto h-[66%] shadow-md shadow-black block">
            <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black py-4">
              <thead class="border-b bg-white shadow-sm sticky top-0">
                <tr class="">
                  <th class="px-4 py-2">ID</th>
                  <th class="px-4 py-2">Role/Position</th>
                  {{-- <th class="px-4 py-2 whitespace-nowrap">First Name</th>
                  <th class="px-4 py-2 whitespace-nowrap">Last Name</th> --}}
                  <th class="px-4 py-2 whitespace-nowrap">Full Name</th>
                  {{-- <th class="px-4 py-2 whitespace-nowrap">Image</th> --}}
                  {{-- <th class="px-4 py-2">Username</th> --}}
                  {{-- <th class="px-4 py-2">Password</th> --}}
                  <th class="px-4 py-2">Email Address</th>
                  <th class="px-4 py-2">First Name</th>
                  <th class="px-4 py-2">Status</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody class="h-96 overflow-y-auto">
                @if (count($accounts) > 0)
           
                @foreach ($accounts as $account)
                    
            
                  <tr class="border-b-2">
                    <td class="px-4">{{$account->id}}</td>
                    <td class="px-4">{{$account->utName}}</td>
                    {{-- <td class="px-4">{{$account->firstName}}</td>
                    <td class="px-4">{{$account->lastName}} </td> --}}
                    <td class="px-4">{{$account->firstName.' '.$account->lastName}} </td>
                    {{-- <td class="px-4">
                      <img src="{{$account->accountPicture ? asset('storage/' .$account->accountPicture) : asset('storage/no_image/no-image.png')}} " alt="asdads" srcset="">
                    </td> --}}
                    {{-- <td class="px-4">{{$account->username}}</td> --}}
                    {{-- <td class="px-4">{{$account->password}}</td> --}}
                    <td class="px-4">{{$account->email}}</td>
                    <td class="px-4">{{$account->firstName}}</td>
                    <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$account->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$account->isActive == 1 ? 'Active' : 'Deactivated Account'}}</td>
               
                    <td class="px-4">
                      {{-- <a href="" title="View Inquiries"><i class="bi bi-eye-fill"></i></a> --}}
                      @if(auth()->user()->userType == 1 )
                        <a href="viewemployee/edit/{{$account->id}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                        {{-- <a href="/viewemployee/{{$account->id}}"><i class="bi bi-trash3-fill text-red-600"></i></a> --}}
                        {{-- delete form --}}
                        @if ($account->isActive == 0)
                        <form action="/reactivateemployee/{{$account->id}}" method="POST" class="inline">
                          @csrf
                          @method("PUT")
                          <button type="submit"><i class="bi bi-check-lg text-green-600"></i></button>
          
                        </form>
                      
                        @endif
                        <form action="/deleteemployee/{{$account->id}}" method="POST" class="{{$account->isActive == 0 ? "hidden" : "inline"}}">
                          @csrf
                          @method("PUT")
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this employee?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
          
                        </form>
                        {{-- <a href="" title="Information"><i class="bi bi-info-square-fill text-yellow-400"></i></a> --}}
                        {{-- <a href="" title="Message"><i class="bi bi-chat-left-text-fill text-sky-500"></i></a> --}}
                      @endif
                    </td>
                  </tr>
                @endforeach
               
                @else
                    <tr class="border-b-2 py-2">
                        <td class="px-4 py-2 text-center " colspan="6">No Record</td>    
                    </tr>
                @endif
                
              </tbody>
            </table>
          </div>

          <div class=" px-4 py-2 bottom-0">
            {{-- {{$accounts->links()}} --}}
            {{ $accounts->appends(request()->all())->links() }}
          </div>
    <?php else: ?>
      <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
    <?php endif; ?>
  </x-card>
</x-layouts>