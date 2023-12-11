<?php
error_reporting(0);
session_start();

require_once "../inc/config.php";
require_once "../inc/dbhelper.php";

class AdminHelper
{
    function checkLogin()
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `admins` WHERE `username` ='".$username."' and `password`='".$password."'";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    function getDoctors()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT a.*, b.organ_name FROM `users` as a LEFT JOIN `organs` as b ON a.doctor_speciality= b.id ORDER BY id DESC";
        $result=$db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Hospital Name</th>
                    <th>Hospital Phone</th>
                    <th>Hospital Address</th>
                    <th>Doctor Name</th>
                    <th>Doctor Phone</th>
                    <th>Doctor Qualification</th>
                    <th>Doctor Speciality</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['hospital_name'];?></td>
                        <td><?php echo $row['hospital_phone'];?></td>
                        <td><?php echo $row['hospital_address'];?></td>
                        <td><?php echo $row['doctor_name'];?></td>
                        <td><?php echo $row['doctor_phone'];?></td>
                        <td><?php echo $row['doctor_qualification'];?></td>
                        <td><?php echo $row['organ_name'];?></td>
                        <td class="text-center">
                            <?php if($row['status']) { ?>
                            <a class="btn btn-xs btn-primary" href="doctors.php?id=<?php echo $row['id'];?>&status=0&task=change_doctor_status"><i class="fa fa-check"></i></a>
                            <?php } else { ?>
                            <a class="btn btn-xs btn-danger" href="doctors.php?id=<?php echo $row['id'];?>&status=1&task=change_doctor_status"><i class="fa fa-circle"></i></a>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary" href="doctors.php?id=<?php echo $row['id'];?>&task=delete_doctor"><i class="fa fa-times-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function change_doctor_status()
    {
        $id     = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        
        $db=new Database();
        $db->open();
        
        $sql="UPDATE `users` SET `status` = ".$status." WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='doctors.php';</script>";
    }
    
    function delete_doctor()
    {
        $id     = $_REQUEST['id'];
        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `users` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='doctors.php';</script>";
    }
    
    function getPatients()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT * FROM `patients` ORDER BY id DESC";
        $result=$db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Hospital Connect No</th>
                    <th>Patient Name</th>
                    <th>Patient Aadhar No.</th>
                    <th>Mobile No.</th>
                    <th>Address</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['health_card_no'];?></td>
                        <td><?php echo $row['patient_name'];?></td>
                        <td><?php echo $row['aadhar_no'];?></td>
                        <td><?php echo $row['mobile_no'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary" href="patients.php?id=<?php echo $row['id'];?>&task=delete_patient"><i class="fa fa-times-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function delete_patient()
    {
        $id     = $_REQUEST['id'];
        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `patients` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        $sql="DELETE FROM `patient_history` WHERE `patient_id` = ".$id;
        $result=$db->query($sql);
        
        $sql="DELETE FROM `patient_prescriptions` WHERE `patient_id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='patients.php';</script>";
    }
    
    function getDisease($id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `diseases` WHERE `id` ='".$id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        return $row;  
    }
    
    public function addDisease()
    {
        $db=new Database();
        $db->open();
        
        $id             = $_POST['id'];
        $disease_name   = $_POST['disease_name'];
        $cause          = $_POST['cause'];
        
        if($id)
        {
            $sql = "UPDATE `diseases` SET `disease_name` = '".$disease_name."', `cause` = '".$cause."' WHERE `id` = ".$id;
            $result = $db->query($sql);
            
            if($result)
            {
                return "Disease updated successfully.";
            }
            else
            {
                return "Disease not updated successfully.";
            }
        }
        else
        {
            $sql = "INSERT INTO `diseases` (`id`, `disease_name`, `cause`) 
                    VALUES (NULL, '".$disease_name."', '".$cause."')";
            $result = $db->query($sql);
            $id     = $db->lastinsered();
            
            if($id)
            {
                return "Disease saved successfully.";
            }
            else
            {
                return "Disease not saved successfully.";
            }   
        }    
    }
    
    function getDiseases()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT * FROM `diseases` ORDER BY id DESC";
        $result=$db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Disease Name</th>
                    <th>Cause</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['disease_name'];?></td>
                        <td><?php echo $row['cause'];?></td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary" href="add_disease.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-xs btn-primary" href="link_disease_symptoms.php?id=<?php echo $row['id'];?>"><i class="fa fa-plus"></i> Link Symptoms</a>
                            <a class="btn btn-xs btn-primary" href="diseases.php?id=<?php echo $row['id'];?>&task=delete_disease"><i class="fa fa-times-circle"></i> Remove</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function delete_disease()
    {
        $id     = $_REQUEST['id'];
        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `diseases` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='diseases.php';</script>";
    }
    
    function linkSymptoms()
    {
        $db=new Database();
        $db->open();
        
        $id         = $_POST['id'];
        $disease_id = $_POST['disease_id'];
        $organ_id   = $_POST['organ_id'];
        $symptom_id = $_POST['symptom_id'];
        
        $sql = "INSERT INTO `link_symptoms` (`id`, `organ_id`, `disease_id`, `symptom_id`) 
                VALUES (NULL, '".$organ_id."', '".$disease_id."', '".$symptom_id."')";
        $result = $db->query($sql);
        $id     = $db->lastinsered();
        
        if($id)
        {
            return "Symptom linked successfully.";
        }
        else
        {
            return "Symptom not linked successfully.";
        }  
    }
    
    
    function getDiseaseSymptoms($disease_id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT a.*, b.organ_name, c.symptom_name FROM `link_symptoms` as a 
                  LEFT JOIN `organs` as b ON a.organ_id = b.id 
                  LEFT JOIN `symptoms` as c ON a.symptom_id = c.id
                  WHERE a.`disease_id` ='".$disease_id."'";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered">
            <tr>
                <th width="10%">#</th>
                <th>Organ Name</th>
                <th>Symptom Name</th>
                <th class="text-center" width="12%">Actions</th>
            </tr>
            <?php
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['organ_name'];?></td>
                    <td><?php echo $row['symptom_name'];?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="link_disease_symptoms.php?id=<?php echo $disease_id;?>&task=delete_link&delete_id=<?php echo $row['id']; ?>"><i class="fa fa-times-circle"></i> Remove</a>
                    </td>
                </tr>
                <?php
            } 
            ?>
        </table>
        <?php
    }
    
    function delete_link($id, $disease_id)
    {        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `link_symptoms` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='link_disease_symptoms.php?id=".$disease_id."';</script>";
    }
    
    function getSymptom($id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `symptoms` WHERE `id` ='".$id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        return $row;  
    }
    
    public function addSymptom()
    {
        $db=new Database();
        $db->open();
        
        $id             = $_POST['id'];
        $symptom_name   = $_POST['symptom_name'];
        
        if($id)
        {
            $sql = "UPDATE `symptoms` SET `symptom_name` = '".$symptom_name."' WHERE `id` = ".$id;
            $result = $db->query($sql);
            
            if($result)
            {
                return "Symptom updated successfully.";
            }
            else
            {
                return "Symptom not updated successfully.";
            }
        }
        else
        {
            $sql = "INSERT INTO `symptoms` (`id`, `symptom_name`) 
                    VALUES (NULL, '".$symptom_name."')";
            $result = $db->query($sql);
            $id     = $db->lastinsered();
            
            if($id)
            {
                return "Symptom saved successfully.";
            }
            else
            {
                return "Symptom not saved successfully.";
            }   
        }    
    }
    
    function getSymptoms()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT * FROM `symptoms` ORDER BY id DESC";
        $result=$db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Symptom Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['symptom_name'];?></td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary" href="add_symptom.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-xs btn-primary" href="symptoms.php?id=<?php echo $row['id'];?>&task=delete_symptom"><i class="fa fa-times-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function delete_symptom()
    {
        $id     = $_REQUEST['id'];
        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `symptoms` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='symptoms.php';</script>";
    }
    
    function getOrgan($id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `organs` WHERE `id` ='".$id."'";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        return $row;  
    }
    
    public function addOrgan()
    {
        $db=new Database();
        $db->open();
        
        $id             = $_POST['id'];
        $organ_name   = $_POST['organ_name'];
        
        if($id)
        {
            $sql = "UPDATE `organs` SET `organ_name` = '".$organ_name."' WHERE `id` = ".$id;
            $result = $db->query($sql);
            
            if($result)
            {
                return "Organ updated successfully.";
            }
            else
            {
                return "Organ not updated successfully.";
            }
        }
        else
        {
            $sql = "INSERT INTO `organs` (`id`, `organ_name`) 
                    VALUES (NULL, '".$organ_name."')";
            $result = $db->query($sql);
            $id     = $db->lastinsered();
            
            if($id)
            {
                return "Organ saved successfully.";
            }
            else
            {
                return "Organ not saved successfully.";
            }   
        }    
    }
    
    function getOrgans()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT * FROM `organs` ORDER BY id DESC";
        $result=$db->query($sql);
        
        if($result)
        {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Organ Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php
                while($row = $db->fetcharray($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['organ_name'];?></td>
                        <td class="text-center">
                            <a class="btn btn-xs btn-primary" href="add_organ.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-xs btn-primary" href="organs.php?id=<?php echo $row['id'];?>&task=delete_organ"><i class="fa fa-times-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    
    function delete_organ()
    {
        $id     = $_REQUEST['id'];
        
        $db=new Database();
        $db->open();
        
        $sql="DELETE FROM `organs` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        echo "<script>window.location='organs.php';</script>";
    }
    
}
?>