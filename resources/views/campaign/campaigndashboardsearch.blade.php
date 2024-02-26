
<x-layouts>       



    <div class="bg-bgMain w-full h-screen p-7">
        
        <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4):?>
       
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl py-4">Facebook Ads Dashboard</h1>
            <!--<p class="">{{$month ? date("F", mktime(0, 0, 0, $month, 1)) : null}} {{$year}}</p>-->
            <form class="flex flex-col sm:flex-row justify-between items-center py-4">
                <div class="px-2">
                    <select name="month" id="month" class="px-4 py-2 pr-8">
                           @php $ref = (isset($_GET['month'])) ? $_GET['month'] : ''; @endphp
                        <option value="" @if( $ref == "" ) selected @endif>Select Month</option>
                        <option value="01" @if( $ref == '01' ) selected @endif>January</option>
                        <option value="02" @if( $ref == '02' ) selected @endif>February</option>
                        <option value="03" @if( $ref == '03' ) selected @endif>March</option>
                        <option value="04" @if( $ref == '04' ) selected @endif>April</option>
                        <option value="05" @if( $ref == '05' ) selected @endif>May</option>
                        <option value="06" @if( $ref == '06' ) selected @endif>June</option>
                        <option value="07" @if( $ref == '07' ) selected @endif>July</option>
                        <option value="08" @if( $ref == '08' ) selected @endif>August</option>
                        <option value="09" @if( $ref == '09' ) selected @endif>September</option>
                        <option value="10" @if( $ref == '10' ) selected @endif>October</option>
                        <option value="11" @if( $ref == '11' ) selected @endif>November</option>
                        <option value="12" @if( $ref == '12' ) selected @endif>December</option>
                    </select>
                    <p class="px-2 inline">-</p>
                    <select name="year" id="year" class="px-4 py-2 pr-8">
                         @php $ref = (isset($_GET['year'])) ? $_GET['year'] : ''; @endphp
                        <option value="" @if( $ref == '' ) selected @endif>Select Year</option>
                        <option value="2019" @if( $ref == '2019' ) selected @endif>2019</option>
                        <option value="2020" @if( $ref == '2020' ) selected @endif>2020</option>
                        <option value="2021" @if( $ref == '2021' ) selected @endif>2021</option>
                        <option value="2022" @if( $ref == '2022' ) selected @endif>2022</option>
                        <option value="2023" @if( $ref == '2023' ) selected @endif>2023</option>
                        <option value="2024" @if( $ref == '2024' ) selected @endif>2024</option>
                        <option value="2025" @if( $ref == '2025' ) selected @endif>2025</option>
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
        @foreach ($campaign as $item)
        <div class="grid sm:grid-cols-6 gap-2 py-2">
          
            <div class="h-[110px] bg-[#0A9396] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all ">
                <p class="text-white text-sm">Reach</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2 ">{{number_format($item->reach)}}</p>
            </div>
            <div class="h-[110px] bg-[#005F73] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Impressions</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->impressions)}}</p>
            </div>
            <div class="h-[110px] bg-[#EE9B00] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Link Clicks</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->link_clicks)}}</p>
            </div>
            <div class="h-[110px] bg-[#AE2012] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Post Engagement</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->post_engagement)}}</p>
            </div>
            <div class="h-[110px] bg-[#9B2226] p-2 uppercase shadow-md shadow-black  hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">New Messaging</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">{{number_format($item->nmc)}}</p>
            </div>
            <div class="h-[110px] bg-[#001219] p-2 uppercase shadow-md shadow-black hover:scale-[102%] duration-300 transition-all">
                <p class="text-white text-sm">Amount Spent</p>
                <p class="text-2xl text-white uppercase font-bold  text-center pt-2">${{number_format($item->amount_spent)}}</p>
            </div>
        
        </div>
        @endforeach
        <div class="py-2 grid griw-rows-3 sm:grid-cols-3 gap-2 ">
        
            <div id="reach" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="impressions" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="linkclicks" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="postengagement" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="nmc" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="amountspent" class="  h-[250px] shadow-md shadow-black"></div>
            
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
    
    var reach_raw =  <?php echo json_encode($getReach)?>;
    var impressions_raw = <?php echo json_encode($getImpressions)?>;
    var linkclicks_raw = <?php echo json_encode($getLinkClicks)?>;
    var postengagement_raw = <?php echo json_encode($getPostEngagement)?>;
    var nmc_raw = <?php echo json_encode($getNMC)?>;
    var amountspent_raw = <?php echo json_encode($getAmountSpent)?>;
    
    var reach = reach_raw.map(Number);
    var impressions =  impressions_raw.map(Number);
    var linkclicks = linkclicks_raw.map(Number);
    var postengagement = postengagement_raw.map(Number);
    var nmc = nmc_raw.map(Number);
    var amountspent = amountspent_raw.map(Number);

   
    Highcharts.setOptions({
    colors: ['#0A9396', '#005F73', '#EE9B00', '#AE2012', '#9B2226', '#001219']
    });
    
    function getReach(){
        
        Highcharts.chart('reach', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'Reach'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Reach'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total Reach',
                data: reach

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL REACH'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'Reach'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'Reach',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: reach
            // }]
        });

    }

    
    function getImpressions(){
        Highcharts.chart('impressions', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'Impressions'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Impressions'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Impressions',
                data: impressions

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL Impressions'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'Impressions'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'Impressions',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: impressions
            // }]
        });
    }
    function getLinkClicks(){
        Highcharts.chart('linkclicks', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'Link Clicks'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Link Clicks'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Link Clicks',
                data: linkclicks

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL LINK CLICKS'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'Link Clicks'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'Link Clicks',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: linkclicks
            // }]
        });
    }
    function getPostEngagement(){
        Highcharts.chart('postengagement', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'Post Engagement'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Post Engagement'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Post Engagement',
                data: postengagement

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL POST ENGAGEMENT'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'Post Engagement'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'Post Engagement',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: postengagement
            // }]
        });
    }
    function getNMC(){
        Highcharts.chart('nmc', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'New Messaging Connections'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'New Messaging Connections'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'NMC',
                data: nmc

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL NMC'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'NMC'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'NMC',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: nmc
            // }]
        });
    }
    function getAmountSpent(){
        Highcharts.chart('amountspent', {
            chart: {
            type: 'column'
            },
            title: {
                text: 'TOTAL AMOUNT SPENT IN DOLLARS'
            },
        
            xAxis: {
                categories: getMonths
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Amount Spent'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Amount Spent',
                data: amountspent

            }]
            // chart: {
            //     type: 'spline'
            // },
            // title: {
            //     text: 'TOTAL AMOUNT SPENT IN DOLLARS'
            // },
            
            // xAxis: {
            //     categories: getMonths,
                
            // },
            // yAxis: {
            //     title: {
            //         text: 'Amount Spent'
            //     },
            //     labels: {
            //         formatter: function () {
            //             return this.value;
            //         }
            //     }
            // },
            // tooltip: {
            //     crosshairs: true,
            //     shared: true
            // },
            // plotOptions: {
            //     spline: {
            //         marker: {
            //             radius: 4,
            //             lineColor: '#666666',
            //             lineWidth: 1
            //         }
            //     }
            // },
            // series: [{
            //     name: 'Amount Spent',
            //     marker: {
            //         symbol: 'diamond'
            //     },
            //     data: amountspent
            // }]
        });
    }
    getReach();
    getImpressions();
    getLinkClicks();
    getNMC();
    getPostEngagement();
    getAmountSpent();
    
</script>