<pre>
   <?php

   //print_r($_SERVER);
   ?>
</pre>

<header>
   <a href="/" class="logo">Blog-one</a>
   <ul class="header-menu">
      <li class="<?= $_SERVER['REQUEST_URI'] === '/form-article.php' ? 'active': '' ?> ">
         <a href="/form-article.php">Ecrire un article</a>
      </li>
   </ul>
</header>