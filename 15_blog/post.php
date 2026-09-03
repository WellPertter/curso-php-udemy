<?php 
    include_once("templates/header.php");

    if(isset($_GET["id"])){

        $postId = $_GET["id"];

        foreach ($posts as $post){
            if($post["id"] == $postId){
                $currenPost = $post;
            }
        }
  
    }
?>
    <main id="post-container">
        <div class="content-container">
            <h1><?=$currenPost["title"]?></h1>
            <p id="post-description"><?=$currenPost["description"]?></p>
            <div class="img-container">
                <img src="<?= $BASE_URL ?>/img/<?= $currenPost["img"] ?>" alt="<?=$currenPost["title"]?>" >
            </div>
            <p class="post-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident esse vel voluptatum deleniti odit sequi, non blanditiis cupiditate magni doloremque dolor quae ducimus. Est rem eligendi pariatur, numquam repudiandae vero.</p>
            <p class="post-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident esse vel voluptatum deleniti odit sequi, non blanditiis cupiditate magni doloremque dolor quae ducimus. Est rem eligendi pariatur, numquam repudiandae vero.</p>
        </div>
        <aside id="nav-container">
            <h3 id="tags-title">Tags</h3>
            <ul id="tag-list">
                <?php foreach ($currenPost["tags"] as $tag): ?> 
                    <li><a href="#"><?=$tag?></a>     </li>   
                <?php endforeach; ?>
            </ul>
            <h3 id="categories-title">Categorias</h3>
            <ul id="categories-list">
                <?php foreach ($categories as $categorie): ?> 
                    <li><a href="#"><?=$categorie?></a></li>   
                <?php endforeach; ?>
            </ul>
        </aside>

    </main>

<?php include_once("templates/footer.php");  ?>