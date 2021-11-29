<?php
include "connection.php";

if (isset($_POST['btnComm'])) {
    $post_id = $_POST['id'];
    $comment = $_POST['comment'];
    
    if(!empty($post_id) && !empty($comment)){
        mysqli_query($conn,"insert into comments (comment, post_id, user_id) values ('$comment','$post_id','$id')");
    }
} 



?>
<!DOCTYPE html>
<html>

<head>
    <?php include "head.php"; ?>
    <title>Posts</title>
</head>

<body>
    <div class="container my-2">
        <h3>Posts</h3>
        <?php
        $sel = mysqli_query($conn, 'select * from posts');
        if (mysqli_num_rows($sel) > 0) {
            while ($arr = mysqli_fetch_assoc($sel)) {
                $uid = $arr['user_id'];
                $user = mysqli_query($conn, "select * from users where id = $uid");
                $u = mysqli_fetch_assoc($user);
        ?>
                <div class="card my-4">
                    <h5 class="ml-3 mt-1" style="color: blue;"><img class="border mr-2" src="<?php echo $u['picture']; ?>" width="30px" height="30px"><?php echo $u['username']; ?> - <?php echo $u['name']; ?></h5>
                    <div class="card-body" style="background-color: #e3f2fd">
                        <h6 class="card-title"><?php echo $arr['title']; ?></h6>
                        <p class="card-text"><?php echo $arr['description']; ?></p>
                        <p class="card-text"><small class="text-muted">Posted on: <?php echo $arr['post_time']; ?></small></p>
                    </div>

                    <img class="mx-auto border my-2" src="<?php echo $arr['post_path']; ?>" alt="Image not available" width="300px" height="250px">
                    <div class="container mx-auto mt-1">
                        <form method="POST">
                            <input class="bg-light form-control" type="hidden" name="id" value="<?php echo $arr['id']; ?>">
                            <div class="row px-1">
                                <input class="bg-light form-control col-sm-10" type="text" name="comment" placeholder="Add comment">
                                <input type="submit" class="btn btn-primary col-sm-2" name="btnComm" value="Comment">
                            </div>
                        </form>
                        <a class="text-center text-primary" href="?page=comment&pid=<?php echo $arr['id']; ?>">Show all comments</a>
                    </div>

                </div>
            <?php
            }
        } else {
            ?>
            <h4>No posts available</h4>
        <?php
        }

        ?>

    </div>

    <?php include "head.php"; ?>
    <?php mysqli_close($conn) ?>
</body>

</html>