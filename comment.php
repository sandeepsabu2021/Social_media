<?php
include "connection.php";
$pid = $_GET['pid'];

$psel = mysqli_query($conn, "select * from posts where id = $pid");
$p = mysqli_fetch_assoc($psel);
$csel = mysqli_query($conn, "s elect * from comments where post_id = $pid");
$user_id = $p['user_id'];
$usersel = mysqli_query($conn, "select * from users where id = $user_id");
$user = mysqli_fetch_assoc($usersel);


?>
<div class="container">
    <div class="card">
    <h5 class="ml-3 mt-1" style="color: blue;"><img class="border mr-2" src="<?php echo $user['picture']; ?>" width="30px" height="30px"><?php echo $user['username']; ?> - <?php echo $user['name']; ?></h5>
        <div class="card-body" style="background-color: #e3f2fd">
            <h5 class="card-title"><?php echo $p['title'] ?></h5>
            <p class="card-text"><?php echo $p['description'] ?></p>
            <p class="card-text"><small class="text-muted"><?php echo $p['post_time'] ?></small></p>
        </div>
        <img class="mx-auto border my-2" src="<?php echo $p['post_path']; ?>" alt="Image not available" width="300px" height="250px">
    </div>
    <h6 class="my-2 mx-1">Comments</h6>
    <?php
    if (mysqli_num_rows($csel) > 0) {
        while ($c = mysqli_fetch_assoc($csel)) {
            $uid = $c['user_id'];
            $usel = mysqli_query($conn, "select * from users where id = $uid");
            $u = mysqli_fetch_assoc($usel);
    ?>
            <div class="p-1 my-2" style="background-color: #e3f2fd">
                <h5 class="mt-2 text-primary">
                    <img class="border mr-2" src="<?php echo $u['picture']; ?>" width="30px" height="30px">
                    <?php echo $u['username']; ?> - <?php echo $u['name']; ?>
                </h5>
                <p class=""><?php echo $c['comment']; ?></p>
                <p><small class="text-muted"><?php echo $c['comment_time'] ?></small></p>
            </div>

        <?php
        }
    } else {
        ?>
        <p class="font-italic p-1" style="background-color: #e3f2fd">No comments found</p>
    <?php
    }
    ?>

</div>
<?php mysqli_close($conn) ?>