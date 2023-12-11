<?php
error_reporting(0);
session_start();

require_once "inc/config.php";
require_once "inc/dbhelper.php";

class HealthHelper
{
    function addUser()
    {
        $id                 = $_POST['id'];
        $hospital_name      = $_POST['hospital_name'];
        $hospital_phone     = $_POST['hospital_phone'];
        $hospital_email     = $_POST['hospital_email'];
        $hospital_city      = $_POST['hospital_city'];
        $hospital_address   = $_POST['hospital_address'];
        $doctor_name        = $_POST['doctor_name'];
        $doctor_phone       = $_POST['doctor_phone'];
        $doctor_qualification= $_POST['doctor_qualification'];
        $doctor_speciality  = $_POST['doctor_speciality'];
        
        $username           = $_POST['username'];
        $password           = $_POST['password'];
        
        $newfilename = "";
        $imagefile = $_POST['photo_file'];
        if($_FILES['photo']['type']=='image/jpeg' || $_FILES['photo']['type']=='image/gif' || $_FILES['photo']['type']=='image/png')
        {
            if($_FILES['photo']['error']>0)
            {
                echo "Error :".$_FILES['photo']['error'];
            }        
            else
            {
                $imagepath="photos/";
                
                if(!is_dir($imagepath))
                {
                    mkdir($imagepath,0777);
                }
                
                if(is_uploaded_file($_FILES['photo']['tmp_name']))
                {
                    $filename  = $_FILES['photo']['name'];
                    $extension = end(explode(".",$filename)); 
                    $newfilename = "img_".time().".".$extension;
                   
                    move_uploaded_file($_FILES['photo']['tmp_name'],$imagepath.$newfilename); 
                }
            }
        }
        else
        {
            $newfilename = $imagefile;
        }
        
        $db=new Database();
        $db->open();
        $sql = "";
        
        if($id)
        {
            $sql= "UPDATE `users` SET `hospital_name`= '".$hospital_name."', `hospital_phone`='".$hospital_phone."', `hospital_email`='".$hospital_email."', 
            `hospital_city`='".$hospital_city."',`hospital_address`='".$hospital_address."',`doctor_name`='".$doctor_name."',`doctor_phone`='".$doctor_phone."',
            `doctor_qualification`='".$doctor_qualification."',`doctor_speciality`='".$doctor_speciality."', `photo` = '".$newfilename."',`username`='".$username."', `password`='".$password."' WHERE `id`=".$id;   
        }
        else
        {
            $sql    = "SELECT * FROM `users` WHERE `username` ='".$username."'";
            $result = $db->query($sql);
            
            if($db->num_of_rows($result))
            {
                return false;
            }
        
            $sql= "INSERT INTO `users` (`id`, `hospital_name`, `hospital_phone`, `hospital_email`, `hospital_city`,`hospital_address`, 
             `doctor_name`, `doctor_phone`, `doctor_qualification`, `doctor_speciality`,`photo`,`username`, `password`) 
            VALUES (NULL, '".$hospital_name."', '".$hospital_phone."', '".$hospital_email."', '".$hospital_city."','".$hospital_address."', 
            '".$doctor_name."', '".$doctor_phone."', '".$doctor_qualification."', '".$doctor_speciality."','".$newfilename."',
            '".$username."', '".$password."');";   
        }
    
        $result = $db->query($sql);
        
        return $result;       
    }
    
    function checkLogin()
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `users` WHERE `username` ='".$username."' and `password`='".$password."' AND `status` = 1";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    function generateHealthcard()
    {
        $db=new Database();
        $db->open();
        
        $patient_name   = $_POST['patient_name'];
        $aadhar_no      = $_POST['aadhar_no'];
        $mobile_no      = $_POST['mobile_no'];
        $address        = $_POST['address'];
        $created_by     = $_SESSION['userid'];
        $created_date   = date('Y-m-d H:i:s');
        
        $sql    = "SELECT * FROM `patients` WHERE `aadhar_no` ='".$aadhar_no."'";
        $result = $db->query($sql);
        
        if($db->num_of_rows($result))
        {
            return "Health Card already exists";
        }
        else
        {
            $sql = "INSERT INTO `patients` (`id`, `patient_name`, `aadhar_no`, `mobile_no`, `address`, `created_by`, `created_date`) 
                    VALUES (NULL, '".$patient_name."', '".$aadhar_no."', '".$mobile_no."', '".$address."', '".$created_by."', '".$created_date."')";
            $result = $db->query($sql);
            $id = $db->lastinsered();
            
            if($id)
            {
                $first = $id;
                
                $str = $aadhar_no;
                $n   = 4;
                  
                $start  = strlen($str) - $n;
                $second = substr($str, $start);
                                
                $health_card_no = $first.''.$second;

                $sql2 = "UPDATE `patients` SET `health_card_no` = ".$health_card_no." WHERE `id` =".$id;
                $db->query($sql2);
                
                return "Health card generated successfully and Health card No. is ".$health_card_no;
            }
            else
            {
                return "Health card not generated.";
            }       
        }
    }
    
    public function getPatientInfo($id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `patients` WHERE `id` ='".$id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        return $row;  
    }
    
    public function addHistory()
    {
        $db=new Database();
        $db->open();
        
        $patient_id     = $_POST['patient_id'];
        $date           = $_POST['date'];
        $date           = explode("/", $date);
        $date           = $date[2].'-'.$date[1].'-'.$date[0];
        $history        = $_POST['history'];
        $created_by     = $_SESSION['userid'];
        $created_date   = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `patient_history` (`id`, `patient_id`, `date`, `history`, `created_by`, `created_date`) 
                VALUES (NULL, '".$patient_id."', '".$date."', '".$history."', '".$created_by."', '".$created_date."')";
        $result = $db->query($sql);
        $id     = $db->lastinsered();
        
        if($id)
        {
            return "History saved successfully.";
        }
        else
        {
            return "History not saved successfully.";
        }       
    }
    
    public function getPatientHistory($patient_id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT a.*, b.doctor_name, b.doctor_phone FROM `patient_history` as a LEFT JOIN `users` as b ON a.created_by = b.id WHERE a.`patient_id` ='".$patient_id."' ORDER BY a.id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">Date</th>
                <th>History</th>
                <th width="22%">Doctor Name</th>
                <th width="12%">Doctor Contact</th>
            </tr>
            <?php
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo date('d/m/Y',strtotime($row['date']));?></td>
                    <td><?php echo $row['history'];?></td>
                    <td><?php echo $row['doctor_name'];?></td>
                    <td><?php echo $row['doctor_phone'];?></td>
                </tr>
                <?php
            } 
            ?>
        </table>
        <?php
    }
    
    public function addPrescription()
    {
        $db=new Database();
        $db->open();
        
        $patient_id     = $_POST['patient_id'];
        $date           = $_POST['date'];
        $date           = explode("/", $date);
        $date           = $date[2].'-'.$date[1].'-'.$date[0];
        $medicine_name  = $_POST['medicine_name'];
        $quantity       = $_POST['quantity'];
        $schedule       = $_POST['schedule'];
        $schedule       = implode(",",$schedule);
        $created_by     = $_SESSION['userid'];
        $created_date   = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `patient_prescriptions` (`id`, `patient_id`, `date`, `medicine_name`, `quantity`, `schedule`, `created_by`, `created_date`) 
                VALUES (NULL, '".$patient_id."', '".$date."', '".$medicine_name."', '".$quantity."', '".$schedule."', '".$created_by."', '".$created_date."')";
        $result = $db->query($sql);
        $id     = $db->lastinsered();
        
        if($id)
        {
            return "Prescription saved successfully.";
        }
        else
        {
            return "Prescription not saved successfully.";
        }       
    }
    
    public function getPatientPrescriptions($patient_id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT a.*, b.doctor_name, b.doctor_phone FROM `patient_prescriptions` as a LEFT JOIN `users` as b ON a.created_by = b.id WHERE a.`patient_id` ='".$patient_id."' ORDER BY a.id DESC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">Date</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Schedule</th>
                <th width="22%">Doctor Name</th>
                <th width="12%">Doctor Contact</th>
            </tr>
            <?php
            $schedule_array = array('1'=>'Morning','2'=>'After Noon','3'=>'Night');
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo date('d/m/Y',strtotime($row['date']));?></td>
                    <td><?php echo $row['medicine_name'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <td>
                        <?php 
                        $schedule = explode(",",$row['schedule']);
                        if($schedule)
                        {
                            $i = 0;
                            foreach($schedule as $s)
                            {
                                echo $schedule_array[$s];
                                $i++;
                                if($i < count($schedule))
                                {
                                    echo " - ";
                                }
                                
                            }
                        }
                        ?>
                    </td>
                    <td><?php echo $row['doctor_name'];?></td>
                    <td><?php echo $row['doctor_phone'];?></td>
                </tr>
                <?php
            } 
            ?>
        </table>
        <?php
    }
}
?>