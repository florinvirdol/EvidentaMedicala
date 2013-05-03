<?php
include 'templates/admin_header.php';
?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p>Management Utilizatori:</p>                
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>Nume</th>
                        <th>Adresa de email</th>
                        <th>Seriviciu</th>
                        <th>Tip lucrator</th>
                        <th>Status</th>
                        <th>Optiuni</th>
                        </tr>
                    </thead>
                <?php 
                foreach($query as $item){
                echo '<tr><td>'.$item->nume.'</td><td>'.$item->email.'</td>
                    <td>'.$item->nume_serviciu.'</td><td>'.$item->rol.'</td><td style="color:'.$item->status_color.'">'.$item->status_user.'</td>
                        <td>
                        <a href="'.  base_url().'admin/edit_users/'.$item->id_user.'">editare</a>
                        </td></tr>';    
                }
                ?></table>
            </div>
        </div>
    </div> 
    <?php
    include 'templates/footer.php';
    ?>
