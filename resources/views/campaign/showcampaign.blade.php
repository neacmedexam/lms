

{{-- @extends('layout')
@section('content') --}}
{{-- @props(['viewemployee'])
 --}}


 <x-layouts>
    <x-card>
      <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1):?>
          <h1 class="text-4xl py-4">Facebook Ads</h1>
            {{-- <div class="flex sm:flex-row flex-col lg:justify-between lg:items-center p-4">
              <form>
                <div class="flex flex-row items-center justify-center px-2">
                  <p class="px-2">Advanced Search</p>
                  <div class="flex items-center">
                    <i class="bi bi-search absolute ml-4 text-gray-400"></i>
                    <input type="text" name="search" id="search" class="border-2 px-4 py-2 pl-8" placeholder="Search">
                  </div>
                </div>
              </form>
              <form>
                <div class="px-2 hidden lg:block">
                  <select name="category" id="category" class="border-2 px-4 py-2">
                    <option value="">Select</option>
                    <option value="id">Account ID</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="username">Username</option>
                    <option value="email">Email Address</option>
                    <option value="userType">Position/Role</option>
                  </select>
                  <input type="text" name="advSearch" class="border-2 px-4 py-2">
                  <a href="/viewemployee/?search={{$accounts}}" value="search" class="bg-blue-600 text-white px-4 py-2">
                    
                    Search
                  </a>
                  <button type="submit" class="bg-blue-600 text-white px-4 py-2 uppercase">Search</button>
                </div>
              </form>
            </div> --}}
             
            <div class="overflow-auto  shadow-md shadow-black">
              <table class="table-auto text-left text-sm w-full max-w-[50%] lg:max-w-[100%] bg-white shadow-md shadow-black py-4">
                <thead class="border-b border-black ">
                  <tr class="">
                    <th class="px-4 py-2">Month</th>
                    <th class="px-4 py-2 whitespace-nowrap">Year</th>
                    <th class="px-4 py-2 whitespace-nowrap">Reach</th>
                    <th class="px-4 py-2">Impressions</th>
                    <th class="px-4 py-2">Link Clicks</th>
                    <th class="px-4 py-2">Post Engagement</th>
                    <th class="px-4 py-2">NMC</th>
                    <th class="px-4 py-2">Amount Spent in Dollars</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
                  </tr>
                </thead>
                <tbody>
              
                  @foreach ($getRecord as $item)
                      
              
                    <tr class="border-b-2">
                      <td class="px-4">{{date("F",mktime(0,0,0,$item->month,10))}}</td>
                      <td class="px-4">{{$item->year}}</td>
                      <td class="px-4">{{number_format($item->reach)}}</td>
                      <td class="px-4">{{number_format($item->impressions)}}</td>
                      <td class="px-4">{{number_format($item->link_clicks)}}</td>
                      <td class="px-4">{{number_format($item->post_engagement)}}</td>
                      <td class="px-4">{{number_format($item->nmc)}}</td>
                      <td class="px-4">{{number_format($item->amount_spent)}}$</td>
                      <td class="text-center py-2 px-2 text-xs font-semibold leading-5 {{$item->isActive == 1 ? " text-green-800 " : " text-red-800 "}}">{{$item->isActive == 1 ? 'Active' : 'Disabled Record'}}</td>
               
            
                      <td class="px-4">
                        <a href="/editreport/campaign/edit/{{$item->campaign_number}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                     
                        @if ($item->isActive == 0)
                        <form action="/reactivatereport/campaign/{{$item->campaign_number}}" method="POST" class="inline">
                          @csrf
                          @method("PUT")
                          <button type="submit"><i class="bi bi-check-lg text-green-600"></i></button>
           
                        </form>
                       
                        @endif
                        <form action="/deletereport/campaign/{{$item->campaign_number}}" method="POST" class={{$item->isActive == 0 ? "hidden" : "inline"}}>
                          @csrf
                          @method("PUT")
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this month report?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
           
                        </form>

                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
  
            <div class=" px-4 py-2 bottom-0">
              {{$getRecord->links()}}
            </div>
        <?php else: ?>
          <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </x-card>
  </x-layouts>