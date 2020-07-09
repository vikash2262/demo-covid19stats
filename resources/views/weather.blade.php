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
                font-family: "archia", sans-serif;
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

            .searchform{margin:0 auto;width: 75%;}
            .submit{margin-top: 21px}
            #country,#fromdate,#todate{width: 230px;}

            .table td.deceasedcase:hover{
                background-color:rgba(108, 117, 125, 0.125);
            }
            .table td.recoveredcase:hover{
                background-color:rgba(40, 167, 69, 0.125);
            }
            .table td.activecase:hover{
                background-color:rgba(0, 123, 255, 0.125);
            }
            .table td.confirmedcase:hover{
                background-color:rgba(255, 7, 58, 0.125);
            }
        </style>
    </head>
    <body>
            <div class='container'>
                <div class="row mt-4 mb-5">
                    <div class="col-12">
                        <h1 class="text-center mt-4 mb-5">Covid-19 Statistics</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="/search" class="form-inline searchform mb-4" method="POST">
                            @method('POST')
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger col-12">
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-4 form-group">
                                <label for="country">Select Country:</label>
                                <select id='country' name='country' class="form-control" id="country">
                                    @foreach ($get_countries_list as $c_list)
                                        
                                        @if (old('country') == $c_list->Slug)
                                        <option value="{{$c_list->Slug}}" selected>{{$c_list->Country}}</option>
                                        @else
                                        <option value="{{$c_list->Slug}}">{{$c_list->Country}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-4 form-group">
                                <label for="fromdate">Select From Date:</label>
                                <input value="{{old('fromdate')}}" id='fromdate'  name="fromdate" type="date" class="form-control">
                              </div>
                              <div class="col-4 form-group">
                                <label for="todate">Select To Date:</label>
                                <input value="{{old('todate')}}" id='todate' name="todate" type="date" class="form-control">
                              </div>
                              <div class="col-12 text-center">
                                <button type="submit" class="submit btn btn-secondary">Get Stats</button>
                              </div>
                        </form>
                        
                    </div>
                </div>
                @if (count($get_covid_data) > 0)
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Confirmed</th>
                                <th scope="col">Active</th>
                                <th scope="col">Recovered</th>
                                <th scope="col">Deceased</th>
                            
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_covid_data as $key => $value)
                                
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>
                                        {{(new DateTime($value->Date))->format('jS F Y')}}
                                    </td>
                                    <td class='confirmedcase'>{{$value->Confirmed}}</td>
                                    <td class='activecase'>{{$value->Active}}</td>
                                    <td class='recoveredcase'>{{$value->Recovered}}</td>
                                    <td class='deceasedcase'>{{$value->Deaths}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
                <span>*Data Source- https://covid19api.com/</span>
                @endif
            </div>
    </body>
</html>
