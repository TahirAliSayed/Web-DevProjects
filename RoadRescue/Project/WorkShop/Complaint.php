<?php
include("Head.php");
include("../Assets/Connection/Connection.php");
if(isset($_POST["btnsave"]))
{
	$complaint_type=$_POST["selcomplaint_type"];
	$complaint=$_POST["txtcomplaint"];
	
			
				$insqry="insert into tbl_complaint(complainttype_id,complaint_content,complaint_date,workshop_id)values('".$complaint_type."','".$complaint."',curdate(),'".$_SESSION["wid"]."')";
				if($conn->query($insqry))
				{		
					header("Location:Complaint.php");
				}
				
			
			
		
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>complaint Details</title>
</head>

<body>
<div id="tab" align="center">
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr align="center">
      <td>complaint type</td>
      <td><label for="selcomplaint_type"></label>
        <select name="selcomplaint_type" id="selcomplaint_type">
        <option>----Select----</option>
        <?php
		$selqry="select * from tbl_complainttype";
		$re=$conn->query($selqry);
		while($row=$re->fetch_assoc())
		{
			?>
            <option value="<?php echo $row["complainttype_id"];?>"><?php echo $row["complainttype_name"];?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
    <tr align="center">
      <td>complaint</td>
      <td><label for="txtcomplaint"></label>
      <input type="text" name="txtcomplaint" id="txtcomplaint" required="required" autocomplete="off"/></td>
    </tr>
    <tr align="center">
      <td colspan="2"><div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Save" />
      </div></td>
    </tr>
  </table>
 <br /> <br /> <br /> 

 
   
</form>
</body>
<?php
include("Foot.php");
?>
</html>