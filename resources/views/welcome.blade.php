<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
       <script src="js/app.js" defer></script>
       <link href="css/app.css" rel="stylesheet">

       <style>
          
          html,body{
              background-image:url({{ asset('image/symphony.png') }})
          }
          .flex-center{ 
              margin-top:100px;  
          }
          .container{
              max-width:350px;
          }
          .container form input[type="submit"]{

              padding:5px;
          }

       </style>
    </head>
    <body>

      <div class="flex-center"> 
        <div class='container'>
         <div class="row">
           {!! Form::open(['route' => 'register' , 'method'=>'GET']) !!}

              <div class='form-group'>
                {!! Form::label('code', 'Student Code') !!}
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                {!! Form::label('certificate', 'Certificate Type') !!}
                {!! Form::select('certificate', 
                                       [
                                        1 => ' Graduated ceretificate', 
                                        2 => 'arm service ceretificate',
                                        3 => 'arm service ceretificate',
                                        4 => ' Graduated ceretificate', 
                                        5 => 'arm service ceretificate',
                                        6 => 'arm service ceretificate'
                                        
                                        ], null, ['placeholder' => 'Certificate','class' => 'form-control' ]) !!}
                </div>
               <div class='form-group'>
                {!! Form::submit('Get Ceretificate', ['class' => 'btn btn-lg btn-success form-control']) !!}
               </div>

           {!! Form::close() !!}
           </div>
         </div>
        </div>
    </body>

</html>
