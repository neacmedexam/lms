
<x-layouts>       



    <div class="bg-bgMain w-full h-screen p-7">
        
        <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4):?>
       
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl py-4">Facebook Analytics Dashboard</h1>
            <p class="">{{$month ? date("F", mktime(0, 0, 0, $month, 1)) : null}} {{$year}}</p>
            <form class="flex flex-col sm:flex-row justify-between items-center py-4" method="GET" action="{{url('/viewreport/fbanalytics/search')}}">
                <div class="px-2">
                    <select name="month" id="month" class="px-4 py-2 pr-8">
                        <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <p class="px-2 inline">-</p>
                    <select name="year" id="year" class="px-4 py-2 pr-8">
                        <option value="">Select Year</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>

                </div>
              
                {{-- <button class="py-2 px-4 mt-2 sm:mt-0 text-white uppercase tracking-wide bg-yellow-600 hover:bg-amber-600 duration-300 transition all">Search</button> --}}
                <button class=" mt-2 sm:mt-0  px-6
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
                ease-in-out">Search</button>
            </form>
            
        </div>
        <div class="flex flex-col justify-center items-center w-full">
            @error('month')
                <p class="text-red-600 text-xs whitespace-nowrap text-left">{{$message}}</p>
            @enderror
        </div>
        <div class="flex flex-col justify-center items-center w-full">
            @error('year')
                <p class="text-red-600 text-xs whitespace-nowrap text-left">{{$message}}</p>
            @enderror
        </div>
        @foreach ($fb as $item)
        <div class="grid sm:grid-cols-4 gap-2 py-2">
          
            <div class="h-[110px] bg-[#092327] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all ">
                <p class="text-white text-sm">Page Likes</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2 ">{{number_format($item->page_likes)}}</p>
            </div>
            <div class="h-[110px] bg-[#0B5351] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Post Reach</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->post_reach)}}</p>
            </div>
            <div class="h-[110px] bg-[#00A9A5] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Post Engagement</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->post_engagement)}}</p>
            </div>
            <div class="h-[110px] bg-[#4E8098] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Videos</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->videos)}}</p>
            </div>
            {{-- <div class="h-[110px] bg-cyan-600 p-2 uppercase shadow-md shadow-black  hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">New Messaging</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->nmc)}}</p>
            </div>
            <div class="h-[110px] bg-amber-600 p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Amount Spent</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">${{number_format($item->amount_spent)}}</p>
            </div>
         --}}
        </div>
        @endforeach
        <div class="py-2 grid  sm:grid-cols-4 gap-2 ">
        
            <div id="overall" class="  col-span-4 h-[250px] shadow-md shadow-black"></div>
            <div id="pagelikes" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="postreach" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="postengagements" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="videos" class="  h-[250px] shadow-md shadow-black"></div>
            {{-- <div id="nmc" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="amountspent" class="  h-[250px] shadow-md shadow-black"></div> --}}
            
        </div>
        <?php else: ?>
        <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
        <?php endif; ?>
    </div>


</x-layouts>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">


  
    var getMonths = <?php echo json_encode($getMonths)?>;

    var page_likes_raw =  <?php echo json_encode($getPageLikes)?>;
    var post_reach_raw = <?php echo json_encode($getPostReach)?>;
    var post_engagement_raw = <?php echo json_encode($getPostEngagement)?>;
    var videos_raw = <?php echo json_encode($getVideos)?>;
    
    var page_likes = page_likes_raw.map(Number);
    var post_reach =  post_reach_raw.map(Number);
    var post_engagement = post_engagement_raw.map(Number);
    var videos = videos_raw.map(Number);
   
    Highcharts.setOptions({
    colors: ['#092327', '#0B5351', '#00A9A5', '#4E8098']
    });
    
    function getAll(){
        Highcharts.chart('overall', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Facebook Analytics'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Page Likes',
                marker: {
                    symbol: 'diamond'
                },
                data: page_likes
            },{
                name: 'Post Reach',
                marker: {
                    symbol: 'diamond'
                },
                data: post_reach
            },{
                name: 'Post Engagement',
                marker: {
                    symbol: 'diamond'
                },
                data: post_engagement
            },{
                name: 'Videos',
                marker: {
                    symbol: 'diamond'
                },
                data: videos
            }]
        });
    }
    function getPageLikes(){
        
        Highcharts.chart('pagelikes', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Page Likes'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Page Likes'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Page Likes',
                marker: {
                    symbol: 'diamond'
                },
                data: page_likes
            }]
        });

    }

    
    function getPostReach(){
        Highcharts.chart('postreach', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Post Reach'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Post Reach'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
           
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Post Reach',
                marker: {
                    symbol: 'diamond'
                },
                data: post_reach
            }]
        });
    }
    function getPostEngagement(){
        Highcharts.chart('postengagements', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Post Engagement'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Post Engagement'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Post Engagement',
                marker: {
                    symbol: 'diamond'
                },
                data: post_engagement
            }]
        });
    }
    function getVideos(){
        Highcharts.chart('videos', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Videos'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Videos'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Videos',
                marker: {
                    symbol: 'diamond'
                },
                data: videos
            }]
        });
    }
    // function getNMC(){
    //     Highcharts.chart('nmc', {
    //         chart: {
    //             type: 'spline'
    //         },
    //         title: {
    //             text: 'TOTAL New Messaging Connections'
    //         },
            
    //         xAxis: {
    //             categories: getMonths,
                
    //         },
    //         yAxis: {
    //             title: {
    //                 text: 'New Messaging Connections'
    //             },
    //             labels: {
    //                 formatter: function () {
    //                     return this.value;
    //                 }
    //             }
    //         },
    //         tooltip: {
    //             crosshairs: true,
    //             shared: true
    //         },
    //         plotOptions: {
    //             spline: {
    //                 marker: {
    //                     radius: 4,
    //                     lineColor: '#666666',
    //                     lineWidth: 1
    //                 }
    //             }
    //         },
    //         series: [{
    //             name: 'New Messaging Connections',
    //             marker: {
    //                 symbol: 'diamond'
    //             },
    //             data: nmc
    //         }]
    //     });
    // }
    // function getAmountSpent(){
    //     Highcharts.chart('amountspent', {
    //         chart: {
    //             type: 'spline'
    //         },
    //         title: {
    //             text: 'TOTAL AMOUNT SPENT IN DOLLARS'
    //         },
            
    //         xAxis: {
    //             categories: getMonths,
                
    //         },
    //         yAxis: {
    //             title: {
    //                 text: 'Amount Spent'
    //             },
    //             labels: {
    //                 formatter: function () {
    //                     return this.value;
    //                 }
    //             }
    //         },
    //         tooltip: {
    //             crosshairs: true,
    //             shared: true
    //         },
    //         plotOptions: {
    //             spline: {
    //                 marker: {
    //                     radius: 4,
    //                     lineColor: '#666666',
    //                     lineWidth: 1
    //                 }
    //             }
    //         },
    //         series: [{
    //             name: 'Amount Spent',
    //             marker: {
    //                 symbol: 'diamond'
    //             },
    //             data: amountspent
    //         }]
    //     });
    // }
    // getReach();
    // getImpressions();
    // getLinkClicks();
    // getNMC();
    // getPostEngagement();
    // getAmountSpent();
    getPageLikes();
    getPostEngagement();
    getPostReach();
    getVideos();
    getAll();
</script>