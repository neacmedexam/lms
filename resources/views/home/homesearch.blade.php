
<x-layouts>


    <div class="bg-bgMain w-full h-full p-7">
        <?php if(auth()->user()->userType == 1 || auth()->user()->userType == 3 || auth()->user()->userType == 4):?>
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-4xl py-4">Hi, {{auth()->user()->firstName }} {{auth()->user()->lastName}}</h1>
            <!--<div class="flex flex-row items-center text-lg py-2 ">-->
            <!--    <p class="px-2 font-bold {{$datestart & $dateend ? 'block' : 'hidden'}}">Search: </p>-->
            <!--    <p class="px-2  text-sm italic {{$datestart && $dateend ? 'block' : 'hidden'}}">-->
            <!--        {{$datestart && $dateend ? '"' : "" }}{{$datestart}} - {{$dateend}}{{$datestart && $dateend ? '"' : "" }}-->
            <!--    </p>-->
           
        
            <!--</div>-->
        </div>
        <form class="flex flex-col sm:flex-row justify-between items-center py-4" method="GET" action="{{url('/home/search')}}">
       
            <div>
                <input type="date" name="datestart" id="datestart" value="{{isset($_GET['datestart']) ? $_GET['datestart'] : ''}}"> 
                <p class="px-2 inline">-</p>
                <input type="date" name="dateend" id="dateend" value="{{isset($_GET['dateend']) ? $_GET['dateend'] : ''}}">

            </div>
            {{-- <button class="py-2 px-4 text-white uppercase tracking-wide bg-yellow-600 hover:bg-amber-600 duration-300 transition all"> --}}
            <div>
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
                   <a href="{{url('/home')}}" class="
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
        
        <div class="py-2 grid griw-rows-4 sm:grid-cols-4 gap-2">
            <div id="newlead" class=" h-[250px] shadow-md shadow-black "></div>
            <div id="newsignup" class="  h-[250px] shadow-md shadow-black"></div>
            <div id="leadscoring" name="container3" class="  h-[250px] shadow-md shadow-black "></div>
            
            <div id="leadsource" class=" h-[250px] shadow-md shadow-black"></div>
            
            <div class="px-4 py-2 bg-white shadow-md shadow-black overflow-auto h-[300px]">
                <p class="text-center text-sm whitespace-nowrap">Top <strong>Online</strong> Performace - LC</p>
                <table class="p-4 table-auto text-left text-sm w-full h-full  bg-white  ">
                    <thead class="border-b border-black ">
                      <tr class="">
                        <th class="px-4 py-2 text-center text-blue-600 sticky">LC</th>
                        <th class="px-4 py-2 text-center text-blue-600 sticky">Total</th>
                      </tr>
                    </thead>
                    <tbody class="">
                       
                        @foreach ($toplc as $item)
                            @if($item)
                            <tr class="border-b-[1px]">
                                <td class="px-4">{{$item->representative}}</td>
                                <td class="px-4 text-center">{{$item->totalsales}}</td>
                            </tr>
                            @else
                            <tr class="border-b-[1px]">
                                <td class="px-4">No Record{{$item}}</td>
                            </tr>
                            @endif
                        @endforeach 
                      
                    </tbody>
                  </table>
            </div>
            <div class="px-4 py-2 bg-white shadow-md shadow-black overflow-auto h-[300px]">
                <p class="text-center text-sm whitespace-nowrap">Top <strong>Inhouse</strong> Performace - LC</p>
                <table class="p-4 table-auto text-left text-sm w-full h-full  bg-white  ">
                    <thead class="border-b border-black ">
                      <tr class="">
                        <th class="px-4 py-2 text-center text-blue-600 sticky">LC</th>
                        <th class="px-4 py-2 text-center text-blue-600 sticky">Total</th>
                      </tr>
                    </thead>
                    <tbody class="">
                  
                        @foreach ($tiplc as $item)
                            @if($item)  
                                <tr class="border-b-[1px]">
                                <td class="px-4">{{$item->representative}}</td>
                                <td class="px-4 text-center">{{$item->totalsales}}</td>
                                </tr>
                            @else
                                <tr class="border-b-2">
                                    <td class="px-4 text-center" colspan="2">{{!$item->representative && !$item->totalsales ? 'No Record' : ''}}</td>
                                </tr>
                            @endif
                         
                        @endforeach   
                    </tbody>
                  </table>
            </div>
            {{-- <div id="tpolc" class="  h-[300px] shadow-md shadow-black"></div>
            <div id="tpilc" class="  h-[300px] shadow-md shadow-black"></div> --}}
            <div class="px-4 py-2 bg-white shadow-md shadow-black overflow-auto h-[300px]">
                <p class="text-center">top inquired services</p>
                <table class="p-4 table-auto text-left text-sm w-full h-full  bg-white  ">
                    <thead class="border-b border-black ">
                      <tr class="">
                        <th class="px-4 py-2 text-center text-blue-600 sticky" colspan="2">Services</th>
                      </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($tis as $item)
                            <tr class="border-b-[1px]">
                            <td class="px-4">{{$item->servicename}}</td>
                            <td class="px-4">{{$item->totalservices}}</td>
                            </tr>
                     
                        @endforeach   
                    </tbody>
                  </table>
            </div>
            <div class="px-4 py-2 bg-white shadow-md shadow-black overflow-auto h-[300px]">
                <p class="text-center">top sold services</p>
                <table class="p-4 table-auto text-left text-sm w-full h-full  bg-white  ">
                    <thead class="border-b border-black ">
                      
                      <tr class="">
                    
                        <th class="px-4 py-2 text-center text-blue-600 sticky" colspan="2">Services</th>
                 
                      </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($ss as $item)
                            <tr class="border-b-[1px]">
                            <td class="px-4">{{$item->servicename}}</td>
                            <td class="px-4">{{$item->totalservices}}</td>
                            </tr>
                     
                        @endforeach   
                    </tbody>
                  </table>
            </div>
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


    var userData = <?php echo json_encode($userData);?>;
    var months = <?php echo json_encode($month)?>;
    
    var totalNewLead =  <?php echo json_encode($newlead, JSON_NUMERIC_CHECK);?>;

    var signedup = <?php echo json_encode($signup)?>;
    var toplc = <?php echo json_encode($toplc)?>;
    
    var leadscoring =  <?php echo json_encode($leadscoring, JSON_NUMERIC_CHECK)?>;

    var leadsource = <?php echo json_encode($ls, JSON_NUMERIC_CHECK)?>;
    
    Highcharts.setOptions({
    colors: ['#0047AC', '#1497D4', '#FFD301', '#FFB921', '#767d92', '#353c51']
    });
    
    //   Highcharts.setOptions({
    // colors: ['#3361AC', '#E7E6DD', '#E8C766', '#E8AF30', '#162F65', '#0F2043']
    // });
    // Highcharts.setOptions({
    // colors: ['#001315', '#00262a', '#003840', '#004b55', '#005e6a', '#00717f', '#008494', '#0096aa']
    // });
    // Highcharts.setOptions({
    // colors: ['#081b33', '#152642', '#2f4562', '#506680', '#767d92', '#353c51']
    // });
    

    function newLead(){
        
        Highcharts.chart('newlead', {
        chart: {
        type: 'column'
        },
        title: {
            text: 'New Leads'
        },
    
        xAxis: {
            categories: months
        },
        yAxis: {
            min: 0,
            title: {
                text: 'New Leads'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'New Leads',
            data: totalNewLead

        }]
        //     title: {
        //         text: 'New Leads'
        //     },
    
        //     xAxis: {
        //         categories: 
        //             // ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        //             months
                
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Number of New Leads'
        //         }
        //     },
        //     legend: {
        //         layout: 'vertical',
        //         align: 'right',
        //         verticalAlign: 'middle'
        //     },
        //     plotOptions: {
        //         series: {
        //             allowPointSelect: true
        //         }
        //     },
        //     series: [{
        //         name: 'New Leads',
        //         data: totalNewLead
        //     }],
        //     responsive: {
        //         rules: [{
        //             condition: {
        //                 maxWidth: 500
        //             },
        //             chartOptions: {
        //                 legend: {
        //                     layout: 'horizontal',
        //                     align: 'center',
        //                     verticalAlign: 'bottom'
        //                 }
        //             }
        //         }]
        //     }
        });
        
    }


    function newSignup(){
        Highcharts.chart('newsignup', {
            chart: {
        type: 'column'
        },
        title: {
            text: 'New Signed up'
        },
    
        xAxis: {
            categories: months
        },
        yAxis: {
            min: 0,
            title: {
                text: 'New Signup'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'New Signup',
            data: signedup

        }]
            // title: {
            //     text: 'New Signup'
            // },
    
            // xAxis: {
            //     categories: months
            // },
            // yAxis: {
            //     title: {
            //         text: 'Number of New Signups'
            //     }
            // },
            // legend: {
            //     layout: 'vertical',
            //     align: 'right',
            //     verticalAlign: 'middle'
            // },
            // plotOptions: {
            //     series: {
            //         allowPointSelect: true
            //     }
            // },
            // series: [{
            //     name: 'New Signup',
            //     data: signedup
            // }],
            // responsive: {
            //     rules: [{
            //         condition: {
            //             maxWidth: 500
            //         },
            //         chartOptions: {
            //             legend: {
            //                 layout: 'horizontal',
            //                 align: 'center',
            //                 verticalAlign: 'bottom'
            //             }
            //         }
            //     }]
            // }
        });
    }

    function getLeadScoring(){
        Highcharts.chart('leadscoring', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Lead Scoring'
        },  
        
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Lead Score',
            colorByPoint: true,
        
            data: leadscoring
        }]
    });
    }
    
    

    function getLeadSource(){
        Highcharts.chart('leadsource', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Lead Source'
        },  
        
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: false
            }
        },
        series: [{
            name: 'Lead Source',
            colorByPoint: true,
            data: leadsource
        }]
    });
    }
    
    
    function getTPOLC(){
        Highcharts.chart('tpolc', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top Performing Online - LC'
            },

            xAxis: {
                categories: 
                    months
                ,
                crosshair: true
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Number of Signedups'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [toplc]
        });
    }

     
    // Highcharts.chart('tpolc', {
    //     title: {
    //         text: 'Top Performing Online - LC'
    //     },
   
    //     xAxis: {
    //         categories: ['January', 'February','March','April','May','June',
    //         'July','August','September','October','November','December']
    //     },
    //     yAxis: {
    //         title: {
    //             text: 'Number of New Leads'
    //         }
    //     },
    //     legend: {
    //         layout: 'vertical',
    //         align: 'right',
    //         verticalAlign: 'middle'
    //     },
    //     plotOptions: {
    //         series: {
    //             allowPointSelect: true
    //         }
    //     },
    //     series: [{
    //         name: 'New Leads',
    //         data: userData
    //     }],
    //     responsive: {
    //         rules: [{
    //             condition: {
    //                 maxWidth: 500
    //             },
    //             chartOptions: {
    //                 legend: {
    //                     layout: 'horizontal',
    //                     align: 'center',
    //                     verticalAlign: 'bottom'
    //                 }
    //             }
    //         }]
    //     }
    // });
    function getTPILC(){
        Highcharts.chart('tpilc', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top Performing Inhouse - LC'
            },

            xAxis: {
                categories: 
                    months
                ,
                crosshair: true
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Number of Signedups '
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Oil and gas extraction',
                data: [13.93, 13.63, 13.73, 13.67, 14.37, 14.89, 14.56,
                    14.32, 14.13, 13.93, 13.21, 12.16]

            }, {
                name: 'Manufacturing industries and mining',
                data: [12.24, 12.24, 11.95, 12.02, 11.65, 11.96, 11.59,
                    11.94, 11.96, 11.59, 11.42, 11.76]

            }, {
                name: 'Road traffic',
                data: [10.00, 9.93, 9.97, 10.01, 10.23, 10.26, 10.00,
                    9.12, 9.36, 8.72, 8.38, 8.69]

            }, {
                name: 'Agriculture',
                data: [4.35, 4.32, 4.34, 4.39, 4.46, 4.52, 4.58, 4.55,
                    4.53, 4.51, 4.49, 4.57]

            }, {
                name: 'Manufacturing industries and mining',
                data: [12.24, 12.24, 11.95, 12.02, 11.65, 11.96, 11.59,
                    11.94, 11.96, 11.59, 11.42, 11.76]

            }, {
                name: 'Road traffic',
                data: [10.00, 9.93, 9.97, 10.01, 10.23, 10.26, 10.00,
                    9.12, 9.36, 8.72, 8.38, 8.69]

            }, {
                name: 'Agriculture',
                data: [4.35, 4.32, 4.34, 4.39, 4.46, 4.52, 4.58, 4.55,
                    4.53, 4.51, 4.49, 4.57]

            }, {
                name: 'Manufacturing industries and mining',
                data: [12.24, 12.24, 11.95, 12.02, 11.65, 11.96, 11.59,
                    11.94, 11.96, 11.59, 11.42, 11.76]

            }, {
                name: 'Road traffic',
                data: [10.00, 9.93, 9.97, 10.01, 10.23, 10.26, 10.00,
                    9.12, 9.36, 8.72, 8.38, 8.69]

            }, {
                name: 'Agriculture',
                data: [4.35, 4.32, 4.34, 4.39, 4.46, 4.52, 4.58, 4.55,
                    4.53, 4.51, 4.49, 4.57]

            }, {
                name: 'Manufacturing industries and mining',
                data: [12.24, 12.24, 11.95, 12.02, 11.65, 11.96, 11.59,
                    11.94, 11.96, 11.59, 11.42, 11.76]

            }, {
                name: 'Road traffic',
                data: [10.00, 9.93, 9.97, 10.01, 10.23, 10.26, 10.00,
                    9.12, 9.36, 8.72, 8.38, 8.69]

            }, {
                name: 'Agriculture',
                data: [4.35, 4.32, 4.34, 4.39, 4.46, 4.52, 4.58, 4.55,
                    4.53, 4.51, 4.49, 4.57]

            }]
        });
    }
    
    newLead();
    newSignup();
    getLeadScoring();
    getLeadSource();
    getTPOLC();
    getTPILC();

    // Highcharts.chart('container8', {
    //     title: {
    //         text: 'Top Sold Services'
    //     },
   
    //     xAxis: {
    //         categories: ['January', 'February','March','April','May','June',
    //         'July','August','September','October','November','December']
    //     },
    //     yAxis: {
    //         title: {
    //             text: 'Number of New Leads'
    //         }
    //     },
    //     legend: {
    //         layout: 'vertical',
    //         align: 'right',
    //         verticalAlign: 'middle'
    //     },
    //     plotOptions: {
    //         series: {
    //             allowPointSelect: true
    //         }
    //     },
    //     series: [{
    //         name: 'New Leads',
    //         data: userData
    //     }],
    //     responsive: {
    //         rules: [{
    //             condition: {
    //                 maxWidth: 500
    //             },
    //             chartOptions: {
    //                 legend: {
    //                     layout: 'horizontal',
    //                     align: 'center',
    //                     verticalAlign: 'bottom'
    //                 }
    //             }
    //         }]
    //     }
    // });
</script>