<?//start nulls?>
<script type="text/javascript">
function setzero()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("cont1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","user_ajax/bull.php",true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
function setzero2()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("cont2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","user_ajax/bull.php",true);
xmlhttp.send();
}
</script>

<?//end nulls?>
<?//start deleting medicine?>
<script type="text/javascript">
function delmed(str)
{
if (str=="")
  {
  document.getElementById("delmed").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("delmed").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","user_ajax/home/delmed.php?q="+str,true);
xmlhttp.send();
}
</script>
<?//end deleting medicine?>
<?//start passed condition?>
<script type="text/javascript">
function passcond(str)
{
if (str=="")
  {
  document.getElementById("stopcond").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("stopcond").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","user_ajax/home/passed_cond.php?m="+str,true);
xmlhttp.send();
}
</script>
<?//end passed condition?>
<?//start home button?>

<script type="text/javascript">
function home10()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("cont1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","user_ajax/home/home1.php",true);
xmlhttp.send();
}
</script>
<?//end home button?>
<script type="text/javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#te").click(function () {
          $('#hid_test input').attr('checked', this.checked);
    });
     // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $("#hid_test input").click(function(){
         if($("#hid_test input").length == $("#hid_test input:checked").length) {
            $("#te").attr("checked", "checked");
        } else {
            $("#te").removeAttr("checked");}});
});
$(function(){  
    $("#pr").click(function () {
          $('#hid_proc input').attr('checked', this.checked);
    });
     $("#hid_proc input").click(function(){
         if($("#hid_proc input").length == $("#hid_proc input:checked").length) {
            $("#pr").attr("checked", "checked");
        } else {
            $("#pr").removeAttr("checked");}});
});
$(function(){  
    $("#me").click(function () {
          $('#hid_med input').attr('checked', this.checked);
    });
     $("#hid_med input").click(function(){
         if($("#hid_med input").length == $("#hid_med input:checked").length) {
            $("#me").attr("checked", "checked");
        } else {
            $("#me").removeAttr("checked");}});
});
$(function(){  
    $("#va").click(function () {
          $('#hid_vac input').attr('checked', this.checked);
    });
     $("#hid_vac input").click(function(){
         if($("#hid_vac input").length == $("#hid_vac input:checked").length) {
            $("#va").attr("checked", "checked");
        } else {
            $("#va").removeAttr("checked");}});
});
$(function(){  
    $("#co").click(function () {
          $('#hid_cond input').attr('checked', this.checked);
    });
     $("#hid_cond input").click(function(){
         if($("#hid_cond input").length == $("#hid_cond input:checked").length) {
            $("#co").attr("checked", "checked");
        } else {
            $("#co").removeAttr("checked");}});
});
$(function(){  
    $("#al").click(function () {
          $('#hid_all input').attr('checked', this.checked);
    });
     $("#hid_all input").click(function(){
         if($("#hid_all input").length == $("#hid_all input:checked").length) {
            $("#al").attr("checked", "checked");
        } else {
            $("#al").removeAttr("checked");}});
});
$(function(){  
    $("#p_all").click(function () {
          $('input').attr('checked', this.checked);
    });
     
});
</script>

