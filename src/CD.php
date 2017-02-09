<?php
class CD
{
    private $artist;
    private $title;

    function __construct($artist, $title)
    {
        $this->artist = $artist;
        $this->title = $title;
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

}
