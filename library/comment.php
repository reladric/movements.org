<?php
/**
 * This file contains comments class definition
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
/**
/**
 * Class that holds replies or comments to a need
 * @package includes
 */
class comment{
	/**
	*the comment id for the current comment
	*@access private
	*@var integer
	*/
	private $comment_id;
	/**
	*the post id for which the comment is posted
	*@access private
	*@var integer
	*/
	public $post_id;
	/**
	*the id of the user who posts the comment
	*@access private
	*@var integer
	*/
	private $uid;
	/**
	*the content of the comment the user posts
	*@access private
	*@var string
	*/
	private $content;
	/**
	*the date on which the comment was posted
	*@access private
	*@var date
	*/	
	private $_date;
	/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $_time;
	
	/**
	*constructor to create an instance of the comment
	*@param integer $commentid the id of the current comment
	*@param integer $postid the id of the post for with the comment is posted
	*@param integer $userid id of the user who posted the comment
	*@param string $cont content of the comment
	*@param date $dat date of posting the comment
	*@param time $tim time of posting the comment
	*/
	function comment($commentid=0, $postid=0, $userid=0,$cont=null,$dat=null,$tim=null)
	{
		$this->comment_id=$commentid;
		$this->post_id=$postid;
		$this->uid=$userid;
		$this->content = $cont;
		$this->_date=$dat;
		$this->_time=$tim;
	}

	/**
	*function to return the comment id
	*@return integer
	*/
	function getComment_id()
	{
    	return $this->comment_id;
	}

	/**
	*function to return the post id
	*@return integer
	*/
	function getPost_id()
	{
    	return $this->post_id;
	}

	/**
	*function to return the user id
	*@return integer
	*/
	function getUid()
	{
    	return $this->uid ;
	}

	/**
	*function to return the contents of the comment
	*@return string
	*/
	function getContent()
	{
	    return $this->content;
	}

	/**
	*function to get date of posting the comment
	*@return date
	*/
	function getDate()
	{
	    return $this->_date;
	}

	/**
	*function to get time of posting the comment
	*@return time
	*/
	function getTime()
	{
	    return $this->_time;
	}

}

?>