<?php
include 'templates/admin_header.php';
foreach($query as $item){
    $id_user = $item->id_user;
    $nume = $item->nume;
    $id_serv = $item->id_serviciu;
    $id_rol = $item->id_rol;
    $id_status_user = $item->id_status_user;
}
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p>Editare utilizator <?php echo $nume;?></p>                
                <form action="<?php echo base_url();?>admin/edit_users" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>" />
                    Serviciu:
                    <select name="serviciu">
                        <?php foreach($servicii->result() as $serviciu){
                            echo '<option value="'.$serviciu->id.'"';
                            if($serviciu->id==$id_serv){
                                echo 'selected="selected"';
                            }
                            echo '>'.$serviciu->name.'</option>';
                        }?>
                    </select></br>
                    Grup:
                    <select name="role">
                        <?php foreach($roles->result() as $role){
                            echo '<option value="'.$role->id.'"';
                            if($role->id==$id_rol){
                                echo 'selected="selected"';
                            }
                            echo '>'.$role->name.'</option>';
                        }?>
                    </select></br>
                    Status:
                    <select name="status">
                        <?php foreach($status_users->result() as $status_user){
                            echo '<option value="'.$status_user->id.'"';
                            if($status_user->id==$id_status_user){
                                echo 'selected="selected"';
                            }
                            echo '>'.$status_user->status.'</option>';
                        }?>
                    </select></br>
                    <input type="submit" value="Update" />
                </form>
            </div>
        </div>
    </div> 
    <?php
    include 'templates/footer.php';
    ?>
