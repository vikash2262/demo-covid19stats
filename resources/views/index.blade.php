<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="css/app.css">
        <script src="js/app.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                //font-family: "archia", sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .table td.deceasedcase:hover{
                background-color:rgba(108, 117, 125, 0.125);
                border-radius:2px;
            }
            .table td.recoveredcase:hover{
                background-color:rgba(40, 167, 69, 0.125);
                border-radius:2px;
            }
            .table td.activecase:hover{
                background-color:rgba(0, 123, 255, 0.125);
                border-radius:2px;
            }
            .table td.confirmedcase:hover{
                background-color:rgba(255, 7, 58, 0.125);
                border-radius:2px;
            }
            .container .col-6{margin:0 auto;}
            .bg-labels{background-color:#f6f6f7}
            .totalcases li{float: left;padding: 0px 20px 0px 20px;}
            .totalcases{list-style: none}
            .totalcases span{font-size: 21px;}

            .totalconfirmedcase{color:#ee1441}
            .totalactivecase{color:#0276f2}
            .totalrecoveredcase{color:#1aa53a}
            .totaldeceasedcase{color:#494a4b}
            .updatedate{padding: 0!important;font-size: 10px;}
            
        </style>
    </head>
    <body>
            <div class='container'>
                <div class="row mt-4 mb-5">
                    <div class="col-6">
                        <h1 class="text-center mt-4 mb-5">Covid-19 India Statistics</h1>
                        <ul class= 'totalcases'>
                            <li><div >Confirmed <br><span class='totalconfirmedcase'>{{$get_covid_data[0]->confirmed}}</span></div></li>
                            <li><div>Active <br><span class='totalactivecase'>{{$get_covid_data[0]->active}}</span></div></li>
                            <li><div>Recovered <br><span class='totalrecoveredcase'>{{$get_covid_data[0]->recovered}}</span></div></li>
                            <li><div>Deceased <br><span class='totaldeceasedcase'>{{$get_covid_data[0]->deaths}}</span></div></li>
                        </ul>
                    </div>

                </div>
                @if (count($get_covid_data) > 0)
                <div class="row">
                    <div class="col-6">
                        <table class="table table-borderless">
                            <thead>
                              <tr>
                                <th class='bg-labels'>State/ UT</th>
                                <th class='bg-labels'>Confirmed</th>
                                <th class='bg-labels'>Active</th>
                                <th class='bg-labels'>Recovered</th>
                                <th class='bg-labels'>Deceased</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_covid_data as $key => $value)
                                @if($key == 0)
                                    @continue
                                @endif
                                <tr>
                                    <td class='bg-labels'>
                                        {{$value->state}}
                                    </td>
                                <td class='confirmedcase' id='cc_{{++$key}}'>{{$value->confirmed}}</td>
                                <td class='activecase' id='ac_{{$key}}'>{{$value->active}}</td>
                                <td class='recoveredcase' id='rc_{{$key}}'>{{$value->recovered}}</td>
                                <td class='deceasedcase' id='dc_{{$key}}'>{{$value->deaths}}</td>
                                </tr>
                                <tr>
                                    <td class='bg-labels'></td>
                                    <td class='updatedate text-right' id='dt_{{$key}}' colspan="5" onmouseover="highlightcases(id,'true')" onmouseout="highlightcases(id,'false')">As on- {{$value->lastupdatedtime}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                          <span>*Data Source- https://api.covid19india.org/</span>
                    </div>
                </div>
                
                @endif
            </div>
    </body>
</html>
<script>
function highlightcases(id,ifhover){
    let uqid = id.split('_');
    cc = document.getElementById('cc_'+uqid[1]);
    ac = document.getElementById('ac_'+uqid[1]);
    rc = document.getElementById('rc_'+uqid[1]);
    dc = document.getElementById('dc_'+uqid[1]);
    console.log(cc)
    if(ifhover == 'true'){
        cc.style.backgroundColor = 'rgba(255, 7, 58, 0.125)';
        ac.style.backgroundColor = 'rgba(0, 123, 255, 0.125)';
        rc.style.backgroundColor = 'rgba(40, 167, 69, 0.125)';
        dc.style.backgroundColor = 'rgba(108, 117, 125, 0.125)';
    }else{
        cc.style.backgroundColor = '#ffffff';
        ac.style.backgroundColor = '#ffffff';
        rc.style.backgroundColor = '#ffffff';
        dc.style.backgroundColor = '#ffffff';
    }

}
</script>
