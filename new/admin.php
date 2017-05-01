<html>
    <head>
    <title>ADMIN - File A COMPLAINT</title>
    <link href="style1.css" type="text/css" rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Vinit Shahdeo" />
    <script>
	window.history.forward(-1);
	</script>
    </head>
    <body>
        
    <?php
        session_start();
        if(isset($_SESSION['id']))
        {
	       echo "<header><p align='left'>CodeChef VIT Chapter<span><a href='logout.php'>Logout</a></span></p></header>";
        }
else
{
	header("location:index.html");
}
?>
    
<?php
$host="localhost";
$uname="root";
$pass="";
$db="codechef";
$link=@mysql_connect($host,$uname,$pass) or
die("<script>alert('Server Error')</script>");
@mysql_select_db($db) or 
die("<script>alert('Database error');</script>");
?>
<!--find-->
<?php
if(isset($_POST['find']))
{ 
  $uid=$_POST['team_id'];
  $qry="select * from registrations where team_id=$uid";
  $rs=mysql_query($qry) or die(mysql_error()); 
  $row=mysql_fetch_array($rs);
}
if(isset($_POST['update_details']))
{ $uid=$_POST['uid'];
  $uname=$_POST['uname'];
  $upass=$_POST['upass'];
  $ufname=$_POST['ufname'];
  $uemail=$_POST['uemail'];
  $umobile=$_POST['umobile'];
  $uaddress=$_POST['uaddress'];


  $qry="update usermaster set UserName='$uname', Password='$upass', FullName='$ufname', 
  Email='$uemail', Mobile= $umobile, Address='$uaddress' where UserId=$uid";
  mysql_query($qry) or die(mysql_error());
  if(mysql_affected_rows()>0)
  {
    echo "<script><alert>Records Updated</alert></script>";
  }
}
?>
 
  <center><h1>Online Complaint System</h1>
   <hr>
       <!--session creation-->
      
   <form method="post" enctype="multipart/form-data">
    <div align="left">
     

      <table align="center">
            <tr><th colspan="3"><center>COMPLAINT DETAILS</center></th></tr>
        
          
           
        <tr><td colspan="3">
             <center>
             <input  type="submit" name="starty_game"  value="VIEW COMPLAINT"/>
             <input  type="submit" name="updatey_details"  value="UPDATE DETAILS"/>
             <input  type="submit" name="view_yregistered"  value="VIEW STATUS"/>
             <input  type="submit" name="view_yplaying"  value="CHANGE STATUS"/>
            <input  type="submit" name="money_ycollection"  value="APPROVE COMPLAINT"/>
             </center>
           </td>
        </tr>
      </table>
     
   </div>
   </form>
  </center>
 </body>
</html>
<!--display-->
<?php
if(isset($_POST['view_registered']))
{
  echo "<center><table>";
  $qry="select * from registrations";
  $rs=mysql_query($qry)
  or die(mysql_error());
  $count=mysql_num_fields($rs);
  echo "<table border='3'><tr><th rowspan='2'>TEAM ID</th><th rowspan='2'>TEAM NAME</th><th colspan='2'><center>GAMER 1</center></th><th colspan='2'><center>GAMER 2</center></th>
  <th colspan='2'><center>CODER</center></th></tr>";
  echo "<tr>";
  echo "<th><center>Name</center></th><th><center>Reg No</center></th>";
  echo "<th><center>Name</center></th><th><center>Reg No</center></th>";
  echo "<th><center>Name</center></th><th><center>Reg No</center></th>";
  echo "</tr>";
  while($row=mysql_fetch_array($rs))
  {
    echo "<tr>";
    
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
     echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
      
       echo "<td>$row[7]</td>";
    echo "<td>$row[8]</td>";
      echo "<td>$row[11]</td>";
    echo "<td>$row[12]</td>";
      
      
    echo "</tr>";
  }
  echo "</table></center>";
}
?>
<!--MONEY-->
<?php
if(isset($_POST['money_collection']))
{
    echo "<center><table>";
  $qry="select * from registrations";
  $rs=mysql_query($qry)
  or die(mysql_error());
  $count=mysql_num_fields($rs);
  echo "<table border='3'><tr><th>TEAM ID</th><th>TEAM NAME</th><th><center>MEMBER NAME</center></th><th><center>PHONE NUMBER 2</center></th>
  </tr>";
  while($row=mysql_fetch_array($rs))
  {
    echo "<tr>";
    
    
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[15]</td>";
    echo "<td>$row[16]</td>";
    
    echo "</tr>";
  }
  echo "</table></center>";
}
?>
<!---INSERT-->
<?php
if(isset($_POST['insert']))
{
  $uid=$_POST['uid'];
  $uname=$_POST['uname'];
  $upass=$_POST['upass'];
  $ufname=$_POST['ufname'];
  $uemail=$_POST['uemail'];
  $umobile=$_POST['umobile'];
  $uaddress=$_POST['uaddress'];

  $filename=$_FILES['fil']['name'];
  $filetname=$_FILES['fil']['tmp_name'];
  $filesize=$_FILES['fil']['size'];
  $filetype=$_FILES['fil']['type'];
  $filerror=$_FILES['fil']['error'];

  $imagepath=fopen($filename,"r");
  $bfil=fread($imagepath,$filesize);
  $image=addslashes($bfil);

  $qry="insert into usermaster 
  values($uid,'$uname','$upass','$ufname','$uemail',$umobile,'$image', '$uaddress')";
  mysql_query($qry) or die(mysql_error());
  if(mysql_affected_rows()>0)
  {
    echo "<script><alert>Records inserted</alert></script>";
  }
}
?>
<!---Delete-->
<?php
if(isset($_POST['delete']))
{
  $uid=$_POST['uid'];
  $qry="delete from usermaster where UserId=$uid";
  mysql_query($qry) or die(mysql_error());
}
?>