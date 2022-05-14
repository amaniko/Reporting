<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</div>
</div>
</div>
<div class="alert alert-danger">
<ul>
@csrf
old password : <br><input type="password" name="old" value=" "> </br>
@if (old=={{Auth::user()->password}})
new password : <br><input type="password" name="password1" value=" "> </br>
confirm new password : <br><input type="password"  name="password2" value=" "> </br>
@if (password1==password2)
Auth::user()->password=password1
@endif
@endif
<input type="submit" value="Submit">
</form>
</body>
</html>