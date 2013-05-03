<?php include_once'templates/header.php'; ?>

<div id="content_header"></div>
<div id="site_content">
    <div id="tabs">
        <div id="tabs-1" >
            <div padding="20px;"><p>
                <ul>
                    <li>Lucrări unde  <?php
foreach ($serviciu->result() as $rows) {
    echo $rows->name;
}
?> este titular: <?php echo $nr_rezultate; ?>
                    </li>
                    <li>
                        Lucrări în desfășurare
                    </li>
                    <li>
                        Lucrări distribuite 
                    </li>
                </ul>


                </p>
            </div>
        </div>
    </div> 
<?php include_once'templates/footer.php'; ?>