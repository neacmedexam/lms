

{{-- @extends('layout')
@section('content') --}}
{{-- @props(['viewemployee'])
 --}}


<x-layouts>
  <x-card>
    <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 4 || auth()->user()->userType == 3):?>
    <div class="h-screen sm:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <h1 class="text-4xl p-4">Events</h1>
              <a href="/events/showaddevents" class="
                    px-6
                    py-3
                    bg-green-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-green-700 hover:shadow-lg
                    focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-green-700 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    border-amber-600
                    ">   
                        Add Events
            </a>

        </div>
        <!--  <div class="flex sm:flex-row flex-col lg:justify-end items-center py-4">-->
        <!--    <form>-->
        <!--      <div class="flex flex-row items-center justify-center">-->
        <!--        <p class="px-4">Advanced Search</p>-->
        <!--        <div class="flex items-center">-->
        <!--          <i class="bi bi-search absolute ml-4 text-gray-400"></i>-->
        <!--          <input type="text" name="search" id="search" class=" px-4 py-2 pl-8" placeholder="Search" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}">-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </form>-->
          
        <!--</div>-->
        @if(session()->has('success'))
       
            
            <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
              <!--<strong class="font-bold">Holy smokes!</strong>-->
              <span class="block sm:inline">{{ session()->get('success') }}</span>
              <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert()">
                <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-black/60" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
              </span>
            </div>
        @endif   
        @if (count($events) > 0)
           @foreach ($events as $list)
                    
                <div class=" p-8 bg-gradient-to-r from-amber-600 to-yellow-500 ... my-2 text-white text-xl transition-all duration-300 hover:scale-[1.02] shadow-lg">
                    <div class="flex justify-between flex-row items-center">
                        <div class="w-full h-full">
                            <a href="{{route('events.vieweventsrecords',$list->eventID)}}" class="w-full"><p class=" font-bold tracking-widest text-4xl">{{$list->eventName}}</p>
                            <small class="text-white/70  text-sm">{{\Carbon\Carbon::parse( $list->dateCreated)->isoFormat('MMMM DD, YYYY')}}</small></a>
                        </div>
                        <div class="flex flex-row justify-between items-center">
                            @if(auth()->user()->userType == 1 || auth()->user()->userType == 4 )
                                <a href="{{route('events.edit',$list->eventID)}}" title="Edit"><i class="bi bi-pencil-square text-blue-600"></i></a>
                           
                                @if ($list->isActive == 0)
                                <form action="{{route('events.reactivateevent',$list->eventID)}}" method="POST" class="inline">
                                  @csrf
                                  @method("PUT")
                                  <button type="submit" title="Reactivate"><i class="bi bi-check-lg text-green-600"></i></button>
                  
                                </form>
                              
                                @endif
                                <form action="{{route('events.deleteevent',$list->eventID)}}" method="POST" class="{{$list->isActive == 0 ? "hidden" : "inline"}}">
                                  @csrf
                                  @method("PUT")
                                  <button type="submit" title="Delete" onclick="return confirm('Are you sure you want to delete this event?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
                  
                                </form>
        
                            @endif
                        </div>
                    </div>
                </div>
              
            @endforeach
            <div class=" py-4 py-2 bottom-0">
                {{-- {{$list->links()}} --}}
                {{ $events->appends(request()->all())->links() }}
            </div>
        @else
            <p class="text-center flex items-center justify-center h-full">No Events as of the moment.</p>
        @endif
    </div>
    <?php else: ?>
      <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
    <?php endif; ?>
    
   
  </x-card>
</x-layouts>
<script>
    var x = document.getElementById("alert");
    function closeAlert(){
        x.style.display = "none";
    }
</script>