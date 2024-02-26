
<x-layouts>       



    <div class="bg-bgMain w-full h-screen p-7">
        
        <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4):?>
       
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl py-4">Web Acquisition Dashboard</h1>
            <p>{{old('month')}} {{old('year')}}</p>
            <form class="flex flex-col sm:flex-row justify-between items-center py-4" method="GET" action="{{url('/viewreport/webacquisition/search')}}">
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
        @foreach ($web as $item)
        <div class="grid sm:grid-cols-5 gap-2 py-2">
          
            <div class="h-[110px] bg-[#001427] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all ">
                <p class="text-white text-sm">Direct Traffic</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2 ">{{number_format($item->direct_traffic)}}</p>
            </div>
            <div class="h-[110px] bg-[#708D81] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Organic Search</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->organic_search)}}</p>
            </div>
            <div class="h-[110px] bg-[#F4D58D] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Paid Search</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->paid_search)}}</p>
            </div>
            <div class="h-[110px] bg-[#BF0603] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Referrals</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->referrals)}}</p>
            </div>
            <div class="h-[110px] bg-[#8D0801] p-2 uppercase shadow-md shadow-black  hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Social Media</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->social_media)}}</p>
            </div>
      
        
        </div>
        @endforeach
        <div class="py-2 grid griw-rows-5 sm:grid-cols-5 gap-2 ">
        
            <div id="overall" class=" sm:col-span-3 h-[250px] shadow-md shadow-black"></div>
            <div id="total" class=" sm:col-span-2 h-[250px] shadow-md shadow-black"></div>
            <div id="direct_traffic" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="organic_search" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="paid_search" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="referrals" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="social_media" class="  h-[250px] shadow-md shadow-black"></div>
            
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
    var total = <?php echo json_encode($getTotal)?>;
    var email_marketing_raw = <?php echo json_encode($getEmailMarketing)?>;
    var direct_traffic_raw =  <?php echo json_encode($getDirectTraffic)?>;
    var organic_search_raw = <?php echo json_encode($getOrganicSearch)?>;
    var paid_search_raw = <?php echo json_encode($getPaidSearch)?>;
    var referrals_raw = <?php echo json_encode($getReferrals)?>;
    var social_media_raw = <?php echo json_encode($getSocialMedia)?>;


    var email_marketing = email_marketing_raw.map(Number);
    var direct_traffic =  direct_traffic_raw.map(Number);
    var organic_search = organic_search_raw.map(Number);
    var paid_search = paid_search_raw.map(Number);
    var referrals = referrals_raw.map(Number);
    var social_media = social_media_raw.map(Number);
   
    Highcharts.setOptions({
    colors: ['#001427','#708D81', '#F4D58D', '#BF0603', '#8D0801']
    });

    function getOverall(){
        Highcharts.chart('overall', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Website Acquisition w/ Paid Ads'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Website Acquisition w/ Paid Ads'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
             
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                },
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        formatter:function(){return this.value}
                    }
                }
            },
            series: [{
                name: 'Direct Traffic',
                marker: {
                    symbol: 'circle'
                },
                data: direct_traffic
            },{
                name: 'Email Marketing',
                marker: {
                    symbol: 'circle'
                },
                data: email_marketing
            },{
                name: 'Organic Search',
                marker: {
                    symbol: 'circle'
                },
                data: organic_search
            },{
                name: 'Paid Search',
                marker: {
                    symbol: 'circle'
                },
                data: paid_search
            },{
                name: 'Referrals',
                marker: {
                    symbol: 'circle'
                },
                data: referrals
            },{
                name: 'Social Media',
                marker: {
                    symbol: 'circle'
                },
                data: social_media
            }]
        });
    }

    function getTotal(){
        Highcharts.chart('total', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Total Website Visit'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Total Website Visit'
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
                name: 'Direct Traffic',
                marker: {
                    symbol: 'circle'
                },
                data: total
            }]
        });
    }

    function getReach(){
        
        Highcharts.chart('direct_traffic', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Direct Traffic'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Direct Traffic'
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
                name: 'Direct Traffic',
                marker: {
                    symbol: 'circle'
                },
                data: direct_traffic
            }]
        });

    }

    
    function getImpressions(){
        Highcharts.chart('organic_search', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Organic Search'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Organic Search'
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
                name: 'Organic Search',
                marker: {
                    symbol: 'circle'
                },
                data: organic_search
            }]
        });
    }
    function getLinkClicks(){
        Highcharts.chart('paid_search', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Paid Search'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Paid Search'
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
                name: 'Paid Search',
                marker: {
                    symbol: 'circle'
                },
                data: paid_search
            }]
        });
    }
    function getPostEngagement(){
        Highcharts.chart('referrals', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Referrals'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Referrals'
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
                name: 'Referrals',
                marker: {
                    symbol: 'circle'
                },
                data: referrals
            }]
        });
    }
    function getNMC(){
        Highcharts.chart('social_media', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Social Media'
            },
            
            xAxis: {
                categories: getMonths,
                
            },
            yAxis: {
                title: {
                    text: 'Social Media'
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
                name: 'Social Media',
                marker: {
                    symbol: 'circle'
                },
                data: social_media
            }]
        });
    }
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
    getOverall();
    getTotal();
    getReach();
    getImpressions();
    getLinkClicks();
    getNMC();
    getPostEngagement();
    getAmountSpent();
    
</script>