<html>
<head>
<style>
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function fun1()
{
x=$("#email").val()
y=$("#password").val()
$.post("loginAction.php",{email:x,password:y},function(data){
data=data.split(" ").join("")
//alert(data);
//arr=data.split("&")
//var z = arr[1];
//alert(z);
//if(arr[0] == 1)
//alert(z);
if(data == 1)
{
alert("login-success");
window.location="welcome.php";
//window.location="welcome.php";
}
else
{
alert("login-failed");
window.location="login.php";
}
});
}
</script>
</head>
<body >
<h1>Employee login page</h1><hr>
<div>
Email Id:<input type="text" placeholder="enter email id" id="email"><br>
Password:<input type="text" placeholder="enter password" id="password"><br>
<input type="submit" value="submit" onclick="fun1()"><br>
</div>
<div id="div1"></div>
</body>
</html>
