function  sear() {
    var ousername = document.getElementById('username'),
        opassword = document.getElementById('password'),
        ofromdate = document.getElementById('fromdate'),
        otodate = document.getElementById('todate'),
        ohistory = document.getElementById('history');
    var xmlhttp;
    console.log(ohistory);
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
        if (xmlhttp.status==200)
        {
            ohistory.innerHTML=xmlhttp.responseText;
        } else {
            console.log(xmlhttp.readyState);
            console.log(xmlhttp.status);
        }
    }
    xmlhttp.open("POST","tsgs.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send('username='+ousername.value+'&password='+opassword.value+'&fromdate='+ofromdate.value+'&todate='+otodate.value);

}