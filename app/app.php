<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__.'/../vendor/autoload.php';
  require_once __DIR__.'/../src/CD.php';


  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
  ));
  $app['debug'] = true;

  session_start();

  if(empty($_SESSION['cd'])){
      $_SESSION['cd'] = array();
  }


  $app->get('/', function() use ($app){

      return $app['twig']->render('form.html.twig');
  });

  $app->post('/', function() use ($app){

    $new_cd = new CD($_POST['artist'], $_POST['title']);
    var_dump($new_cd);
      return $app['twig']->render('form.html.twig');
  });





        return $app;

?>
