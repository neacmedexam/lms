<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{!! asset('public/assets/NEACLOGOLMS.ico') !!}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" type="text/css" href="../../css/app.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" /> -->

    <title>NEAC LMS</title>

</head>
<style>
    /* Style the buttons that are used to open and close the accordion panel */
.accordion {
  background-color: rgb(202 138 4 / var(--tw-bg-opacity));
  color: #fff;
  cursor: pointer;
  padding: 18px;
  margin-bottom:5px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.accordion:hover {
  background-color: rgb(217 119 6);
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 10px 10px;
  background-color: white;
  display: none;
  overflow: hidden;
}
</style>
<body class="font-Poppins">

 {{-- SideNav --}}
    
    <div class="flex uppercase tracking-wide text-darkMode h-full">
        <!--desktop-->
        <div class=" text-sm lg:flex flex-col justify-evenly top-0 px-7 py-2 w-[10%] lg:w-[25%]  overflow-y-auto bg-gradient-to-r from-yellow-500 to-amber-600 lg:left-0 hidden">
            <div class="p-2 flex flex-col items-center ">
                <a href="/"></a>
                {{-- <i class="bi bi-person-circle text-darkMode text-7xl text-center w-full"></i> --}}
                <img class="w-[100px] h-[100px] rounded-full border-2 border-darkMode bg-white/80" src="{{auth()->user()->accountPicture ? asset('public/storage/' .auth()->user()->accountPicture) : asset('public/storage/no_image/No_Image_Available.jpg')}} " alt="profile image">
                  
                <p class="pt-[4px] text-darkMode font-bold">{{auth()->user()->firstName }} {{auth()->user()->lastName}}</p>
                <p class=" text-darkMode">
             
                    <?php
                        if(auth()->user()->userType == 1){
                            echo 'Admin';
                        }
                        elseif (auth()->user()->userType == 2) {
                            echo 'LC';
                        }
                        elseif (auth()->user()->userType == 3) {
                            echo 'Manager/Supervisor';
                        }
                        elseif (auth()->user()->userType == 4) {
                            echo 'Marketing';
                        }
                   
                    ?>
                </p>
            </div>
            <hr class=" border-darkMode">
            <div class="h-full text-darkMode w-full py-2">
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all 
                    {{auth()->user()->userType != 2 ? 'block' : 'hidden'}}
                ">
                    <a href="/home" class="flex flex-row items-center  py-2">
                        <i class="bi bi-house-door-fill px-2"></i>
                        <p>Home</p>
                    </a>
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all
               
                ">
                    <a href="/lcdashboard" class="flex flex-row items-center py-2">
                        <i class="bi bi-pie-chart-fill px-2"></i>
                        <p>LC Dashboard</p>
                    </a>
                    
                </div>
                <div class="" >
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-ui-checks px-2"></i>
                        <p>Inquiries</p>
                    </div>
                    
                </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                        {{auth()->user()->userType != 4 ? 'block' : 'hidden'}}
                    ">
                        @if(auth()->user()->userType != 5)
                            <a href="/addinquiry" class="flex flex-row items-center py-2">
                                <i class="bi bi-journal-plus px-2"></i>
                                <p>Add Inquiry</p>
                            </a>
                        @else
                        <a href="/addinquiries" class="flex flex-row items-center py-2">
                            <i class="bi bi-journal-plus px-2"></i>
                            <p>Add Inquiry</p>
                        </a>
                        @endif
                        
                        
                    </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6">
                        <a href="/viewinquiries" class="flex flex-row items-center py-2">
                            <i class="bi bi-view-stacked px-2"></i>
                            <p>View Inquiries</p>
                        </a>
                        
                    </div>
                <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                    ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-people-fill px-2"></i>
                        <p>Employees</p>
                    </div>
                    
                </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 ? 'block' : 'hidden'}}
                    ">
                        <a href="/addemployee" class="flex flex-row items-center py-2">
                            <i class="bi bi-person-plus-fill px-2"></i>
                            <p>Add Employee</p>
                        </a>
                        
                    </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                        {{auth()->user()->userType == 1 || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                    ">
                        <a href="/viewemployee" class="flex flex-row items-center py-2">
                            <i class="bi bi-person-lines-fill px-2"></i>
                            <p>View Employee</p>
                        </a>
                        
                    </div>
                <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-clipboard2-data-fill px-2"></i>
                        <p class="whitespace-nowrap">Campaign Dashboard</p>
                    </div>
                
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/addreport/categories" class="flex flex-row items-center py-2">
                        <i class="bi bi-clipboard2-plus-fill px-2"></i>
                        <p>Add Report</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/editreport/categories" class="flex flex-row items-center py-2">
                        <i class="bi bi-pencil-square px-2"></i>
                        <p>Edit Report</p>
                    </a>
                    
                </div>
             
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <a href="/viewreports/category" class="flex flex-row items-center py-2">
                      
                        <i class="bi bi-journal-richtext px-2"></i>
                        <p>View Report</p>
                    </a>
                    
                </div>
                <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-calendar2-fill px-2"></i>
                        <p class="whitespace-nowrap">Events</p>
                    </div>
                
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                ">
                    <a href="/events/showaddevents" class="flex flex-row items-center py-2">
                        <i class="bi bi-calendar-plus-fill px-2"></i>
                        <p>Add Event</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4  || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                ">
                    <a href="/events/viewevents" class="flex flex-row items-center py-2">
                        <i class="bi bi-calendar2-check px-2"></i>
                        <p>View Events</p>
                    </a>
                    
                </div>
             
            
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all
                    {{auth()->user()->userType == 1 ? 'block' : 'hidden'}}
                ">
                    <a href="/settings" class="flex flex-row items-center py-2">
                        <i class="bi bi-gear-fill px-2"></i>
                        <p>Settings</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all">
                    <a href="/myprofile/edit/{{auth()->user()->id}}" class="flex flex-row items-center py-2">
                        <i class="bi bi-person-fill px-2"></i>
                        <p>My Profile</p>
                    </a>
                
                </div>
            </div>
            
            <form class="text-darkMode flex justify-end items-center font-bold" method="POST" action="/logout">
                @csrf
                <i class="bi bi-box-arrow-right px-2"></i>
                <button type="submit" class="uppercase">Logout</button>
          
            </form>
        </div>
            
        <!--tablet and phone-->
        <div class=" text-sm flex justify-evenly items-center py-2 sm:w-[3.5%] h-screen bg-gradient-to-r from-yellow-500 to-amber-600 lg:hidden">
            
            <div class="h-full text-darkMode w-full py-2">
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all 
                    {{auth()->user()->userType != 2 ? 'block' : 'hidden'}}
                ">
                    <a href="/home" class="flex flex-row items-center  py-2">
                        <i class="bi bi-house-door-fill px-2"></i>
                        <p>Home</p>
                    </a>
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all
               
                ">
                    <a href="/lcdashboard" class="flex flex-row items-center py-2">
                        <i class="bi bi-pie-chart-fill px-2"></i>
                        <p>LC Dashboard</p>
                    </a>
                    
                </div>
                <div class="" >
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-ui-checks px-2"></i>
                        <p>Inquiries</p>
                    </div>
                    
                </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                        {{auth()->user()->userType != 4 ? 'block' : 'hidden'}}
                    ">
                        @if(auth()->user()->userType != 5)
                            <a href="/addinquiry" class="flex flex-row items-center py-2">
                                <i class="bi bi-journal-plus px-2"></i>
                                <p>Add Inquiries</p>
                            </a>
                        @else
                        <a href="/addinquiries" class="flex flex-row items-center py-2">
                            <i class="bi bi-journal-plus px-2"></i>
                            <p>Add Inquiries</p>
                        </a>
                        @endif
                        
                        
                    </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6">
                        <a href="/viewinquiries" class="flex flex-row items-center py-2">
                            <i class="bi bi-view-stacked px-2"></i>
                            <p>View Inquiries</p>
                        </a>
                        
                    </div>
                <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                    ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-people-fill px-2"></i>
                        <p>Employees</p>
                    </div>
                    
                </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 ? 'block' : 'hidden'}}
                    ">
                        <a href="/addemployee" class="flex flex-row items-center py-2">
                            <i class="bi bi-person-plus-fill px-2"></i>
                            <p>Add Employee</p>
                        </a>
                        
                    </div>
                    <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                        {{auth()->user()->userType == 1 || auth()->user()->userType == 3 ? 'block' : 'hidden'}}
                    ">
                        <a href="/viewemployee" class="flex flex-row items-center py-2">
                            <i class="bi bi-person-lines-fill px-2"></i>
                            <p>View Employee</p>
                        </a>
                        
                    </div>
                <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-clipboard2-data-fill px-2"></i>
                        <p class="whitespace-nowrap">Campaign Dashboard</p>
                    </div>
                
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/addreport/categories" class="flex flex-row items-center py-2">
                        <i class="bi bi-clipboard2-plus-fill px-2"></i>
                        <p>Add Report</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/editreport/categories" class="flex flex-row items-center py-2">
                        <i class="bi bi-pencil-square px-2"></i>
                        <p>Edit Report</p>
                    </a>
                    
                </div>
             
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <a href="/viewreports/category" class="flex flex-row items-center py-2">
                      
                        <i class="bi bi-journal-richtext px-2"></i>
                        <p>View Report</p>
                    </a>
                    
                </div>
                 <div class="
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4  ? 'block' : 'hidden'}}
                ">
                    <div class="flex flex-row items-center py-2 font-bold">
                        <i class="bi bi-calendar2-fill px-2"></i>
                        <p class="whitespace-nowrap">Events</p>
                    </div>
                
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/events/showaddevents" class="flex flex-row items-center py-2">
                        <i class="bi bi-calendar-plus-fill px-2"></i>
                        <p>Add Event</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all lg:ml-6
                    {{auth()->user()->userType == 1 || auth()->user()->userType == 4 ? 'block' : 'hidden'}}
                ">
                    <a href="/events/viewevents" class="flex flex-row items-center py-2">
                        <i class="bi bi-calendar2-check px-2"></i>
                        <p>View Events</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all
                    {{auth()->user()->userType == 1 ? 'block' : 'hidden'}}
                ">
                    <a href="/settings" class="flex flex-row items-center py-2">
                        <i class="bi bi-gear-fill px-2"></i>
                        <p>Settings</p>
                    </a>
                    
                </div>
                <div class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all">
                    <a href="/myprofile/edit/{{auth()->user()->id}}" class="flex flex-row items-center py-2">
                        <i class="bi bi-person-fill px-2"></i>
                        <p>My Profile</p>
                    </a>
                
                </div>
                
                <form class="hover:bg-white/20 hover:ml-2 hover:shadow-lg duration-300 transition-all" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex flex-row items-center py-2">
                        <i class="bi bi-box-arrow-right font-bold text-red-800 px-2"></i>
                        <p class="text-red-800 font-bold">Logout</p>
                    </button>
                
                </form>
                
               
            </div>
            
         
        </div>
        
        
     
        {{$slot}}

  
    </div>
       
    <x-flash-message/>
    <!-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

<!-- <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script> -->
    <script>
        tailwind.config = {
            theme: {
            extend: {
                fontFamily: {
                sans: ['Inter', 'sans-serif'],
                },
            }
            }
        }
    </script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
            panel.style.display = "none";
            } else {
            panel.style.display = "block";
            }
        });
        }
    </script>
    <!-- <script type="text/javascript" src="../../js/app.js"></script> -->

    <!-- <script
  type="text/javascript"
  src="../../../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script> -->
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


</body>
</html>