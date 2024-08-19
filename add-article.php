<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'includes/head.php'?>
<link rel="stylesheet"  href="public/css/add-article.css">
    <title>page-article</title>
</head>
<body>
<div class="container">
       <?php require_once 'includes/header.php' ?>
       <div class="content">
        <div class="block p-20 form-container">
            <h1>Ecrire un article</h1>
            <form action="/add-article.php" method="$_POST">
                <div class="form-control">
                    <label for="title">Titre</label>
                    <input type="text"  name="title" id="title">
                    <p></p>
                </div>
                <div class="form-control">
                    <label for="image">Image</label>
                    <input type="text"  name="image" id="image">
                    <p></p>
                </div>
                <div class="form-control">
                    <label for="categorie">Categorie</label>
                    <input type="text"  name="categorie" id="categorie">
                    <select name="categorie" id="categorie">
                        <option value="technology">technology</option>
                        <option value="nature">nature</option>
                        <option value="politic">politic</option>
                    </select>
                    <p></p>
                </div>
                <div class="form-control">
                    <label for="content">Content</label>
                    <textarea name="content" id="content"></textarea>
                    <p></p>
                </div>
                <div class="form-action">
                    <a  href="/blog-one/" class="btn btn-secondary" type="button">Annuler</a>
                    <button class="btn btn-primary" type="button">Sauvegarder</button>
                </div>

            </form>
        </div>
                   
        </div>

        <?php require_once 'includes/footer.php'  ?>
   </div>
    
</body>
</html>