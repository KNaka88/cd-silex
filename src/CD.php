<?php
class CD
{
    private $artist;
    private $title;
    private $image;

    function __construct($artist, $title)
    {
        $this->artist = $artist;
        $this->title = $title;
        $this->image = '';
    }


    function getImage()
    {
        return $this->image;
    }

    function setImage($new_image)
    {
        $this->image = $new_image;
    }


    function getArtist()
    {
        return $this->artist;
    }

    function setArtist($newArtist)
    {
        $this->artist = $newArtist;
    }

    function getTitle()
    {
        return $this->title;
    }

    function setTitle($newTitle)
    {
        $this->title = $newTitle;
    }

    function save()
    {
        array_push($_SESSION['cd'], $this);
    }

    static function getAll()
    {
        return $_SESSION['cd'];
    }

    static function delete(){
        $_SESSION['cd'] = array();
    }


    function uploadImage(){
       if(isset($_FILES['image'])){
          $errors= array();
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_tmp = $_FILES['image']['tmp_name'];
          $file_type = $_FILES['image']['type'];
          $exploded = explode('.',$_FILES['image']['name']);
          $last_element = end($exploded);
          $file_ext=strtolower($last_element);

          $expensions= array("jpeg","jpg","png", "gif");

          if(in_array($file_ext,$expensions)=== false){
             $errors[]="please upload only JPEG or PNG, GIF file.";
          }

          if($file_size > 2097152) {
             $errors[]='File size must be less than 2 MB';
          }

          if(empty($errors)==true) {
             move_uploaded_file($file_tmp,"images/".$file_name);
             echo "Success";
             $img = '<img id="'.$file_name.'" src="'."images/".$file_name.'">';
             echo $img;
             $this->image = $img;
          }else{
             print_r($errors);
          }
       }
   }

}
