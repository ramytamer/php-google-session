<?php

/**
* Main Application Class
*/
class App
{


	/**
	 * Database object variable
	 * @var mysqli object
	 */
	protected $db;
	

	/**
	 * Initialize the db variable to be used later in methods
	 */
	function __construct() {
		$this->db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	}

	/**
	 * Check if user is logged in or not
	 * @return boolean
	 */
	public function isLoggedin() {
		return isset($_SESSION['user']) && !empty($_SESSION['user']);
	}


	/**
	 * Create a new user & insert it into database
	 * @param  string $name     
	 * @param  string $email    
	 * @param  string $password 
	 * @return int    new user id
	 */
	public function createUser($name,$email,$password) {
		$sql = $this->db->prepare("INSERT INTO `users` (`name`,`email`,`password`,`joined_at`) VALUES (?,?,?,NOW()) ");
		$sql->bind_param('sss',ucwords($name),$email,sha1($password));
		$sql->execute();

		return $this->db->insert_id;
	}

	/**
	 * Check if user inputs is valid
	 * @param  string $fullName             
	 * @param  string $email                
	 * @param  string $password             
	 * @param  string $passwordConfirmation 
	 * @return array  array of errors
	 */
	public function validateUserInputs($fullName,$email,$password,$passwordConfirmation) {
		$errors = [];

		if(strlen($fullName) < 4) array_push($errors, 'Full name must be more than 4 letters.');

		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) array_push($errors, 'Email is not valid.');

		if(strlen($password) < 6) array_push($errors, 'Password must be more than 6 characters.');

		if($password !== $passwordConfirmation) array_push($errors, 'Passwords don\'t match.');

		if($this->getUserByEmail($email)) array_push($errors, 'This email already registred.');

		return $errors;
	}


	/**
	 * Get user info by email
	 * @param  string $email 
	 * @return object user
	 */
	public function getUserByEmail($email) {
		$email = $this->db->real_escape_string($email);

		$sql = $this->db->query("SELECT * FROM `users` WHERE `email`= '{$email}' ");

		return $sql->fetch_object();
	}

	/**
	 * Get user info by id
	 * @param  int 		$id 
	 * @return object   user
	 */
	public function getUserById($id) {

		$sql = $this->db->query("SELECT * FROM `users` WHERE `id`='{$id}' ");

		return $sql->fetch_object();
	}

	/**
	 * Log the user in
	 * @param  string $email    
	 * @param  string $password 
	 * @return object user
	 */
	public function login($email,$password) {
		$email 		= $this->db->real_escape_string($email);
		$password 	= sha1($this->db->real_escape_string($password));

		$sql = $this->db->query("SELECT * FROM `users` WHERE `email`= '{$email}' AND `password` = '$password' ");

		return $sql->fetch_object();
	}

	/**
	 * Get all users from the database
	 * @param  integer $except the id of the user that we don't want to get
	 * @return array   users objects
	 */
	public function getAllUsers($except = 0) {
		$users = [];

		$sql = $this->db->query("SELECT * FROM `users` WHERE `id` <> '{$except}' ");

		while($user = $sql->fetch_object()) array_push($users, $user);

		return $users;

	}

	/**
	 * Get all posts in the database
	 * @return array posts objects
	 */
	public function getAllPosts() {
		$posts = [];


		$sql = "
			SELECT `posts`.*,`users`.`name` as `owner` FROM `posts`
			INNER JOIN `users` ON
			`posts`.`user_id`=`users`.`id`
			ORDER BY `created_at` DESC
		";
		$sql = $this->db->query($sql);

		while($post = $sql->fetch_object()) array_push($posts, $post);

		return $posts;
	}

	/**
	 * Get post by it's id
	 * @param  int 		$id
	 * @return object 	post
	 */
	public function getPostById($id) {
		$id = $this->db->real_escape_string($id);

		$sql = "
			SELECT `posts`.*, `users`.`name` as owner FROM `posts`
			INNER JOIN `users` ON
			`users`.`id`=`posts`.`user_id`
			WHERE `posts`.`id`='{$id}'
		";

		$sql = $this->db->query($sql);


		return $sql->fetch_object();
	}


	/**
	 * Get all posts written by some user (user id)
	 * @param  integer $id 
	 * @return array   posts objects
	 */
	public function getPostsById($id) {
		$posts = [];

		$id = $this->db->real_escape_string($id);

		$sql = "SELECT * FROM `posts` WHERE `user_id`='{$id}' ";
		$sql = $this->db->query($sql);

		while($post = $sql->fetch_object()) array_push($posts, $post);

		return $posts;
	}


	/**
	 * Create a new post & insert into database
	 * @param  string $title       
	 * @param  string $description 
	 * @param  integer $user        
	 * @return integer  the id of last post
	 */
	public function createPost($title,$description,$user) {
		$sql = "
			INSERT INTO `posts`
			(`title`,`description`,`user_id`,`created_at`)
			VALUES(?,?,?,NOW())
		";

		$sql = $this->db->prepare($sql);
		$sql->bind_param('ssi',ucwords($title),$description,$user);
		$sql->execute();

		return $this->db->insert_id;
	}


	public function deletePostById($id) {
		$sql = "DELETE FROM `posts` WHERE `id` = ?";
		$sql = $this->db->prepare($sql);
		$sql->bind_param('i',$id);
		return $sql->execute();
	}

	public function updatePostById($id,$title,$description) {
		$sql = "UPDATE `posts` SET `title` = ? , `description`= ? WHERE `id`= ? ";

		$sql = $this->db->prepare($sql);
		$sql->bind_param('ssi',$title,$description,$id);

		return $sql->execute();
	}
}

?>