<?php
 const ERROR_REQUIRED = 'veuillez renseigner ce champ';
 const ERROR_TITLE_TOO_SHORT = 'le titre est trop court';
 const ERROR_CONTENT_TOO_SHORT = 'L\article est trop court';
 const ERROR_IMAGE_URL = 'L\image doit etre un url valide';
 $filename = __DIR__ . 'data/articles.json';
 $errors = [
    'title' => '',
    'image' => '',
    'categorie' => '',
    'content' => '',
 ];
 $articles = [];

  $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $id = $_GET['id'] ??'';

 if($_SERVER['REQUEST_METHOD'] === 'POST') { 
    if(file_exists($filename)){
        $articles = json_decode(file_get_contents($filename), true) ?? [];
    }
    $_POST = filter_input_array(INPUT_POST, [
       'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
       'image' => FILTER_SANITIZE_URL,
       'categorie' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
       'content' => [
           'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
           'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
       ]
       ]);
        $title = $_POST['title'] ?? '';
        $image =  $_POST['image'] ?? '';
        $categorie = $_POST['categorie'] ?? '';
        $content = $_POST['content'] ?? '';


       if(!$title) {
          $errors['title'] = ERROR_REQUIRED;
       } elseif(mb_strlen($title)<5){
        $errors['title'] = ERROR_TITLE_TOO_SHORT;
       }

       if(!$image) {
        $errors['image'] = ERROR_REQUIRED;
     } elseif(!filter_var($image,FILTER_VALIDATE_URL)){
      $errors['image'] = ERROR_TITLE_TOO_SHORT;
     }

     if(!$categorie) {
        $errors['categorie'] = ERROR_REQUIRED;
    }

    if(!$content) {
        $errors['content'] = ERROR_REQUIRED;
     } elseif(mb_strlen($content)<50){
      $errors['content'] = ERROR_TITLE_TOO_SHORT;
     }


     
     if(empty(array_filter($errors,fn($e) => $e !== ''))){
        $articles = [...$articles,[
            'title' => $title,
            'image' => $image,
            'categorie' => $categorie,
            'content' => $content,
            'id' => time()
        ]];
        file_put_contents($filename, json_encode($articles));
        header('Location:/');
     }
     

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'includes/head.php'?>
<link rel="stylesheet"  href="public/css/form-article.css">
    <title>page-article</title>
</head>
<body>
<div class="container">
       <?php require_once 'includes/header.php' ?>
       <div class="content">
        <div class="block p-20 form-container">
            <h1>Ecrire un article</h1>
            <form action="/form-article.php" method="$_POST">
                <div class="form-control">
                    <label for="title">Titre</label>
                    <input type="text"  name="title" id="title" value=<?=$title ?? '' ?>>
                    <?php if($errors['title']): ?>
                    <p class="text-danger"><?= $errors['title'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-control">
                    <label for="image">Image</label>
                    <input type="text"  name="image" id="image" value=<?=$image ?? '' ?>>
                    <?php if($errors['image']): ?>
                    <p class="text-danger"><?= $errors['image'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-control">
                    <label for="categorie">Categorie</label>
                    <input type="text"  name="categorie" id="categorie">
                    <select name="categorie" id="categorie">
                        <option value="technology">technology</option>
                        <option value="nature">nature</option>
                        <option value="politic">politic</option>
                    </select>
                    <?php if($errors['categorie']): ?>
                    <p class="text-danger"><?= $errors['categorie'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-control">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" value=<?=$content ?? '' ?>></textarea>
                    <?php if($errors['content']): ?>
                    <p class="text-danger"><?= $errors['content'] ?></p>
                    <?php endif; ?>
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