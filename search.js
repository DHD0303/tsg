function  sear() {
    var ousername = document.getElementById('username'),
        opassword = document.getElementById('password'),
        ohistory = document.getElementById('history');
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            ohistory.innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","tsg.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send('username='+ousername.value+'&password='+opassword.value);

}