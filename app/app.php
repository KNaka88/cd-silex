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

      return $app['twig']->render('form.html.twig', array('cds'=> $_SESSION['cd']));
  });

  $app->post('/', function() use ($app){

    $new_cd = new CD($_POST['artist'], $_POST['title']);
    $new_cd->save();
      return $app['twig']->render('form.html.twig', array('cds'=> $_SESSION['cd']));

  });


  $app->post('/search-result', function() use ($app){
      $search_input = '/.*' .$_POST['search']. '.*/i';
      var_dump($search_input);
      $tempArray = array();
    //   $return = preg_match('/'.$search_input.'/i',"Ben Folds");
    //   echo "preg match result is: ";
    //   var_dump($return);

      foreach($_SESSION['cd'] as $cd){
        if ( (preg_match($search_input, $cd->getArtist())) == 1) {
          array_push($tempArray,$cd);
        }
      }
      echo "Inside of Temp Array";
      var_dump($tempArray);

      return "String";
  });






        return $app;

?>
