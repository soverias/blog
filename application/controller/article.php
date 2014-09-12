<?php

/**
 * Class Article
 *
 */
class Article extends Controller
{
    /**
     * PAGE: index
     * What are you doing here? go to home page
     */
    public function index()
    {
    		header( 'Location: '.URL);
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function id($id)
    {
    	if(!isset($id))
    		header( 'Location: http://www.yoursite.com/new_page.html' ) ;
        $news_model = $this->loadModel('NewsModel');
        $news = $news_model->getNew($id);
        $comments = $news_model->getComments($id);
        require 'application/views/_templates/header.php';
        require 'application/views/article/index.php';
        require 'application/views/_templates/footer.php';
    }

    /**
     * PAGE: exampletwo
     * This method handles what happens when you move to http://yourproject/home/exampletwo
     * The camelCase writing is just for better readability. The method name is case insensitive.
     */
    public function addComment()
    {
    	//validations
        if(!isset($_POST['commenter']))
        	throw new Exception("Nombre no establecido");
        if(!isset($_POST['comment']))
        	throw new Exception("Comentario no establecido");
        if(strlen($_POST['commenter']) < 3)
        	throw new Exception("El nombre debe contener almenos 3 carácteres");
        if(strlen($_POST['commenter']) > 10)
        	throw new Exception("El nombre debe contener como máximo 10 carácteres");
        if(strlen($_POST['comment']) < 2)
        	throw new Exception("El nombre debe contener almenos 2 carácteres");
        if(strlen($_POST['comment']) > 500)
        	throw new Exception("El nombre debe contener como máximo 500 carácteres");
        
        //lets save comment
        $news_model = $this->loadModel('NewsModel');
        $news = $news_model->addComment($_POST['new_id'], $_POST['comment'], $_POST['commenter']);
        echo $_POST['commenter'];
        echo "<p>".nl2br($_POST['comment'])."</p>";
        $vari = crypt("prueba");
        if($vari == crypt("prueba", $vari))
        	echo "verificadoooo!!<br/>";
        else 
        	echo "nofevieri";
        
    }
}
