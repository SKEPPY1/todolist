<?php
require('../login/cookie.php');
require('../functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../css/style.css">
    <title>todo List</title>
</head>
<body>
    <header>
        <div>
            <h1>TodoList</h1>
            <p><?php echo h($user['name']) ?>さん</p><br>
        </div>
    </header>
    <!-- 追加部分 -->
    <form class="form" action="./add.php" method="POST">
            <input class="todo-input" name="title" type="text" required="true">
            <button class="todo-button" type="submit">
                <i class="fas fa-plus"></i>
            </button>
    </form>

    <?php
        $user_info_id = $user['id'];
        $todos = $db->query("SELECT * FROM todos WHERE user_info_id ='" . $user_info_id . "' ORDER BY id DESC");
        // $todos = $db->query("SELECT * FROM todos WHERE user_info_id =" . $user_info_id);
        //   $todos = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
       ?>
    <div class="todo-container">
        <ul class="todo-list">
            <?php if($todos->rowCount() <= 0){ ?>
                    <p class="no-todo">今日は何をしようかな？</p>
            <?php } ?>

            <!-- リスト部分 -->

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <form action="./remove.php" method="POST">
                <div class="todo">
                        <button type="button" class="complate-btn">
                            <i class="far fa-circle"></i>
                        </button>
                        <li class="todo-item"><?php echo h($todo['title']) ?></li>
                        <button type="submit" class="trash-btn" name="id" value="<?php  echo h($todo['id']) ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <br>
                </div>
                </form>
            <?php } ?>

       </div>
       </ul>
    </div>
</body>
</html>