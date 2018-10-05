
<?php 
session_start(); 
include("dbconnect.php");

 //$u_name=$_POST['email'];
 //$u_pass=$_POST['pass'];
 //echo $u_name;
 $u_name = (isset($_POST['email']) ? $_POST['email'] : '');
  $u_pass = (isset($_POST['pass']) ? $_POST['pass'] : '');
//echo "hai show";

 $sql="select * from login where uname='$u_name'";
 //echo $sql;
 $result=mysqli_query($con,$sql);
 $rowcount=mysqli_num_rows($result);
 if($rowcount!=0)
{
	//echo "found";
	while($row=mysqli_fetch_array($result))
	{
		$dbu_name=$row['uname'];
		$dbu_pass=$row['u_pass'];
		$dbu_type=$row['type'];
        $dbu_role=$row['roles'];
		
		
		if($dbu_name==$u_name && $dbu_pass==$u_pass)
		{
			$_SESSION['uname']=$dbu_name;
            $_SESSION['u_pass']=$dbu_pass;
 			$_SESSION['name'] = $row['name'];
			
			if($dbu_type==0)	
			{
				$_SESSION['type']="Admin";
                    echo "ok";
                          header("location:../resort/admin-home.php");
			}
			else if($dbu_type==1)
			{
			$_SESSION['type']="Employee";

                          header("location:../resort/employee-home.php");
						  }
			else if($dbu_type==2)
			{
				$_SESSION['type']="User";

			header("location:../resort/user-home.php");
			}
			}
 else
              {
			   header("location:../resort/login.php?error=wrong password");
	           echo "wrong";
              }
   }
   }

else
{
	echo "not found";	
}
?>
