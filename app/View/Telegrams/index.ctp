
<h1>Messages</h1>

<?php foreach($updates as $update){
    echo $update['Update']['message']."<br>";
 } ?>
 
 
<h1>Channel Posts</h1>


<?php foreach($updates as $update){
    echo $update['Update']['channel_post']."<br>";
 } ?>
 
 