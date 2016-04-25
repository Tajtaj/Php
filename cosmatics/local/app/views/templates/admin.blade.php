<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cosmatics Administrator System</title>

    <!-- Bootstrap -->
    {{ HTML::script('assets/js/jquery.js'); }}
    {{ HTML::script('assets/js/bootstrap-datepicker.js'); }}

    {{ HTML::script('assets/packages/bootstrap/js/bootstrap.min.js'); }}
    {{ HTML::script('assets/js/showRecords.js'); }}
    {{ HTML::style('assets/packages/bootstrap/css/bootstrap.min.css'); }}
    {{ HTML::style('assets/css/main.css'); }}
    {{ HTML::style('assets/css/showRecordsAdmin.css'); }}
    {{ HTML::style('assets/css/datepicker.css'); }}

    <![endif]-->
</head>
<body>


    <div class="container">
        <!--Header Section Of Admin-->
       <div class="row">
            <div class="header">
                Cosmatics Administrator System
            </div>
        </div>

        <div class="row">
           <div class="content">
               @if (Auth::admin()->check())

                       <div class="breadcrumbs">

                           @foreach ($breadcrumbs as $breadcrumb)
                               @if($breadcrumb['type']=='active')
                                   <span class="inactive">{{ HTML::linkRoute($breadcrumb["url"],$breadcrumb["value"]) }}</span>

                               @else
                                   <span class="active">{{$breadcrumb["value"]}}</span>
                               @endif

                           @endforeach
                               <span class="inactive">{{ HTML::linkRoute("admin_logout","Logout" ,array(),array("class"=>"admin-logout"))}}</span>
                       </div>

               @endif
               @yield('content')
           </div>
        </div>
           <div class="row">
               <div class="footer">
                   This is the footer section
               </div>
           </div>
        </div>

    </div>



</body>
</html>