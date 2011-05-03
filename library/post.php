<?php
/**
 * This file contains post class definition
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
/**
* Class to hold need post information.
* @package user
*/
class post{
	/**
	* contains post id for the current post instance.
	* @access private
	* @var integer
	*/
	private $postId;
	/**
	* contains deadline for need to be completed for the current post instance.
	* @access private
	* @var date
	*/
	private $deadline;
	/**
	* contains post date of the current post instance.
	* @access private
	* @var date
	*/
	private $_date;
	/**
	* contains post time of the current post instance.
	* @access private
	* @var time
	*/
	private $_time;
	/**
	* contains user id who posted the current post
	* @access private
	* @var integer
	*/
	private $uid;
	/**
	* contains points alloteed for the current need post.
	* @access private
	* @var integer
	*/
	private $point;
	/**
	* contains title of the current post.
	* @access private
	* @var string
	*/
	private $title;
	/**
	* contains contents for the current post.
	* @access private
	* @var string
	*/
	private $content;
	/**
	* constructor to create an instance of a need post.	
 	* @param integer $postId post id from DB
	* @param integer $categId category ID of current post
	* @param date $deadline deadline of current need
	* @param date $dat date of posting
	* @param time $tim time of posting
	* @param integer $userId id of user who posted the need
	* @param integer $point points allotted to this need
	* @param string $titl Title of the need
	* @param string $cont content of the post
	*/	
	function post( $postId=0, $categId=0,$deadline=null,$dat=null,$tim=null,$userId=0,$point=null,$titl=null,$cont=null)
	{
		//$this->$categId=$categId;
		$this->postId=$postId;
		$this->uid=$userId;
		$this->title = $titl;
		$this->content = $cont;
		$this->_date=$dat;
		$this->_time=$tim;
		$this->deadline=$deadline;
		$this->point=$point;
	}
	/**
	* Function to get the post Id
	* @return integer
	*/
	function getPostId()
	{
	    return $this->postId;
	}
	
	/**
	* Function to get the categ Id
	* @return integer
	*/
	function getCategId()
	{
	    return 0;
	}
	/**
	* Function to get the user Id
	* @return integer
	*/
	function getUid()
	{
	    return $this->uid ;
	}
	/**
	* Function to get the post title
	* @return string
	*/
	function getTitle()
	{
	    return $this->title;
	}
	/**
	* Function to get the post content
	* @return string
	*/
	function getContent()
	{
	    return $this->content;
	}
	
	/**
	* Function to get the date of post
	* @return date
	*/
	function getDate()
	{
	    return $this->_date;
	}
	/**
	* Function to get the time of post
	* @return time
	*/
	function getTime()
	{
	    return $this->_time;
	}
	/**
	* Function to get the need deadline
	* @return date
	*/
	function getDeadline(){
		return $this->deadline;
	}
	/**
	* Function to get the points allocation for current needs
	* @return integer
	*/
	function getPoint(){
		return $this->point;
	}
}

?>