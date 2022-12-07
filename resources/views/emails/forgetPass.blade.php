<html>
    <head>
        <title>Forget Password</title>
    </head>
    <body>
    <a href="{{url('/forget-password/'.$data['email'].'/'.$data['token'])}}">Click Here</a>
    <p>{{url('/forget-password/'.$data['email'].'/'.$data['token'])}}</p>
    </body>
</html>
