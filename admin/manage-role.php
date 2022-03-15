<?php
    require 'functions/dbconn.php';

    
    //All header tag to be included
    include('include/header.php');
     //sidebar tag to be included
     include('include/sidebar.php');
     $sql="SELECT * FROM tblusers";
     $stmt=$connection->prepare($sql);
     $stmt->execute();
     $users=$stmt->fetchAll();

     $deletebtn=isset($_POST['delete_btn'])? $_POST['delete_btn']: '';

     if($deletebtn){
        $id=isset($_POST['delete_id'])? $_POST['delete_id']: '';

        $sql="DELETE FROM tblusers WHERE id=:id LIMIT 1";
        $st=$connection->prepare($sql);
       if( $st->execute(['id'=>$id])){
          // header('Location: admin/manage-role.php');
       }else{
           ?>
        <div class="alert alert-danger">An error occured</div>
           <?php
       }

     }

     ?>

<div class="container mt-5">
<div>
        <div class="table-responsive">
                <table class="table m-0 table-colored-bordered table-bordered-primary" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach($users as $user){
                        ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td style="display: inline-flex;">
                           
                                <form action="edit-role.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $user['id'] ?>">
                                    <button type="submit" name="btn_edit" class="btn" style="color: blue;"><i class="far fa-edit"></i></button>
                                </form>
                           

                                <form action="manage-role.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $user["id"]; ?>">
                                    <button type="submit" name="delete_btn" value="button" class="btn" onclick="return confirm('Are you sure you want to delete this record?');" style="margin-left: 10px;color: red;"><i class="fas fa-trash-alt"></i></button>
                                </form>
                        </td>
                    </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
        </div>     
</div>
</div>



<?php
  //footer tag to be included
  include('include/footer.php');
  //javascripts files to be included
  include('include/scripts.php');
  ?>