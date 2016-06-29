<?php
require_once 'Controller.php';

class LoremIpsumController extends Controller {
  public function generateText() {
    $paragraphs = $_GET['p'];
    $long = $_GET['l'];

    if(is_numeric($paragraphs)) {
      $paragraphs = (int) $paragraphs;
    }
    else {
      $paragraphs = 4;
    }

    $entityBody = file_get_contents("http://loripsum.net/generate.php?p=$paragraphs&l=$long");
    echo $entityBody;
  }
}