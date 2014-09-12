<?php

class NewsModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get last 10 news
     */
    public function getLastNews()
    {
        $sql = "SELECT id, title, creationDate, short_content, (Select count(id) From Comments Where Comments.new_id = News.id) as comments_count FROM News ORDER BY creationDate DESC LIMIT 0,10";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    /**
     * Get 10 news from specified page
     */
    public function getPagedNews($page)
    {
    	$page = ($page-1)*10;
    	$sql = "SELECT id, title, creationDate, short_content, (Select count(id) From Comments Where Comments.new_id = News.id) as comments_count FROM News ORDER BY creationDate DESC LIMIT ".$page.",10";
    	$query = $this->db->prepare($sql);
    	$query->execute();
    
    	// fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
    	// libs/controller.php! If you prefer to get an associative array as the result, then do
    	// $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
    	// $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
    	return $query->fetchAll();
    }
    /**
     * Get New
     */
    public function getNew($id)
    {
    	$sql = "SELECT id, title, creationDate, content, (Select count(id) From Comments Where Comments.new_id = News.id) as comments_count FROM News WHERE id = ".$id;
    	$query = $this->db->prepare($sql);
    	$query->execute();
    
    	// fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
    	// libs/controller.php! If you prefer to get an associative array as the result, then do
    	// $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
    	// $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
    	return $query->fetchAll();
    }
    /**
     * Get New
     */
    public function getComments($id)
    {
    	$sql = "Select id, commenter, comment From Comments Where new_id = ".$id." ORDER BY id DESC";
    	$query = $this->db->prepare($sql);
    	$query->execute();
    
    	// fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
    	// libs/controller.php! If you prefer to get an associative array as the result, then do
    	// $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
    	// $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
    	return $query->fetchAll();
    }
    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addComment($new_id, $comment, $commenter)
    {
    	//validations
    	if(!isset($commenter))
    		throw new Exception("Nombre no establecido");
    	if(!isset($comment))
    		throw new Exception("Comentario no establecido");
    	if(strlen($commenter) < 3)
    		throw new Exception("El nombre debe contener almenos 3 carácteres");
    	if(strlen($commenter) > 10)
    		throw new Exception("El nombre debe contener como máximo 10 carácteres");
    	if(strlen($comment) < 2)
    		throw new Exception("El nombre debe contener almenos 2 carácteres");
    	if(strlen($comment) > 500)
    		throw new Exception("El nombre debe contener como máximo 500 carácteres");
    	
        // clean the input from javascript code for example
        $new_id = strip_tags($new_id);
        $comment = strip_tags($comment);
        $commenter = strip_tags($commenter);

        $sql = "INSERT INTO Comments(commenter, comment, new_id) VALUES (:commenter, :comment, :new_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':commenter' => $commenter, ':comment' => $comment, ':new_id' => $new_id));
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':song_id' => $song_id));
    }
}
