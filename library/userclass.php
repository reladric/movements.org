<?php
/**
 * This file contains users class definition
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
/**
*Class to hold the user informations
*@package user
*/
class users{
	/**
	*the comment id for the current comment
	*@access private
	*@var integer
	*/
	private $uid;
		/**
	*the comment id for the current comment
	*@access private
	*@var integer
	*/
	private $points;

	/**
	*the post id for which the comment is posted
	*@access public
	*@var integer
	*/
	public $fname;

	/**
	*the id of the user who posts the comment
	*@access private
	*@var integer
	*/
	private $lname;

	/**
	*the content of the comment the user posts
	*@access private
	*@var string
	*/
	private $dte;
		/**
	*the content of the comment the user posts
	*@access private
	*@var string
	*/
	private $month;
		/**
	*the content of the comment the user posts
	*@access private
	*@var string
	*/
	private $year;

	/**
	*the date at which the comment was posted
	*@access private
	*@var date
	*/	
	private $dispdob;

	/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $addr1;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $addr2;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $city;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $state;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $country;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $zip;
	/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $phone;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $sec_em;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $nick;	
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $twitter;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $fb;
		/**
	*the time at which the comment was posted
	*@access private
	*@var time
	*/
	private $ln;
	/**
	*constructor to create an instance of a user
	*@param integer $u id of the current user
	*@param integer $pt current users points
	*@param string $f First name
	*@param string $l Last Name
	*@param date $d Date Of Birth
	*@param integer $dd display setting for date f birth
	*@param string $a1 Adderss1
	*@param string $a2 Address2
	*@param string $c City
	*@param string $s State
	*@param string $co Country
	*@param integer $z ZipCode
	*@param integer $p Phone Number
	*@param string $se Secondary Email
	*@param string $nn Nickname
	*@param string $tw twitter Id
	*@param string $fbk facebook Id
	*@param string $lnd linkedIn Id
	*/
	function users($u,$pt,$f,$l,$dt,$mt,$yr,$dd,$a1,$a2,$c,$s,$co,$z,$p,$se,$nn,$tw,$fbk,$lnd)
	{
		$this->uid=$u;
		$this->points=$pt;
		$this->fname=$f;
		$this->lname=$l;
		$this->dte=$dt;
		$this->month=$mt;
		$this->year=$yr;
		$this->dispdob=$dd;
		$this->addr1=$a1;
		$this->addr2=$a2;
		$this->city=$c;
		$this->state=$s;
		$this->country=$co;
		$this->zip=$z;
		$this->phone=$p;
		$this->sec_em=$se;
		$this->nick=$nn;
		$this->twitter=$tw;
		$this->fb=$fbk;
		$this->ln=$lnd;
	}

	/**
	*function to return the comment id
	*@return integer
	*/
	function getdob($id=0)
	{
		if($id==1){
			if($this->dispdob==0)
				return "";
			else if($this->dispdob==1)
				return $this->dte." ".$this->month;
			else if($this->dispdob==2)
				return $this->dte." ".$this->month." ".$this->year;
		}
		else if($id==0){
			return $this->dte." ".$this->month." ".$this->year;
		}
	}
		/**
	*function to return the comment id
	*@return integer
	*/
	function getdte(){
	return $this->dte;
	}
			/**
	*function to return the comment id
	*@return integer
	*/
	function getmonth(){
	return $this->month;
	}
			/**
	*function to return the comment id
	*@return integer
	*/
	function getyear(){
	return $this->year;
	}
			/**
	*function to return the comment id
	*@return integer
	*/
	function getPoints(){
	return $this->points;
	}
		/**
	*function to return the comment id
	*@return integer
	*/
	function getdispdob(){
	return $this->dispdob;
	}
	/**
	*function to return the post id
	*@return integer
	*/
	function getfname()
	{
    	return $this->fname;
	}
		/**
	*function to return the post id
	*@return integer
	*/
	function getlname()
	{
    	return $this->lname;
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
	function getaddress()
	{
	    return $this->addr1."<br/>".$this->addr2."<br/>".$this->city."<br/>".$this->state."<br/>".$this->country."<br/>".$this.zip;
	}
	/**
	*function to return the contents of the comment
	*@return string
	*/
	function getaddr1()
	{
	    return $this->addr1;
	}
		/**
	*function to return the contents of the comment
	*@return string
	*/
	function getaddr2()
	{
	    return $this->addr2;
	}
		/**
	*function to return the contents of the comment
	*@return string
	*/
	function getcity()
	{
	    return $this->city;
	}
		/**
	*function to return the contents of the comment
	*@return string
	*/
	function getstate()
	{
	    return $this->state;
	}
		/**
	*function to return the contents of the comment
	*@return string
	*/
	function getcountry()
	{
	    return $this->country;
	}
		/**
	*function to return the contents of the comment
	*@return string
	*/
	function getzip()
	{
	    return $this->zip;
	}
	/**
	*function to get date of posting the comment
	*@return date
	*/
	function getPhone()
	{
	    return $this->phone;
	}

	/**
	*function to get time of posting the comment
	*@return time
	*/
	function getsemail()
	{
	    return $this->sec_em;
	}
		/**
	*function to get time of posting the comment
	*@return time
	*/
	function getLN()
	{
	    return $this->ln;
	}
		/**
	*function to get time of posting the comment
	*@return time
	*/
	function nickname()
	{
	    return $this->nick;
	}
		/**
	*function to get time of posting the comment
	*@return time
	*/
	function getTW()
	{
	    return $this->twitter;
	}
		/**
	*function to get time of posting the comment
	*@return time
	*/
	function getFB()
	{
	    return $this->fb;
	}
// Returning Postid and uid as String
// Rest are by default Strings

	/**
	*function to convert user id to string and return it
	*@return string
	*/
	function getUid_String()
	{
		return (String)$this->uid;    
	}
	function updateprofile($f,$l,$dt,$mt,$yr,$dd,$a1,$a2,$c,$s,$co,$z,$p,$se,$nn,$tw,$fbk,$lnd){
		$this->fname=$f;
		$this->lname=$l;
		$this->dte=$d;
		$this->month=$mt;
		$this->year=$yr;
		$this->dispdob=$dd;
		$this->addr1=$a1;
		$this->addr2=$a2;
		$this->city=$c;
		$this->state=$s;
		$this->country=$co;
		$this->zip=$z;
		$this->phone=$p;
		$this->sec_em=$se;
		$this->nick=$nn;
		$this->twitter=$tw;
		$this->fb=$fbk;
		$this->ln=$lnd;
		$sql="update user set firstname='".$f."',lastname='".$l."',date='".$dt."',month='".$mt."',year='".$yr."',disp_dob='".$dd."',addr1='".$a1."',addr2='".$a2."',city='".$c."',state='".$s."',country='".$co."',zip='".$z."',phone='".$p."',sec_email='".$se."',nickname='".$nn."',twitter='".$tw."',fb='".$fbk."',linkedin='".$lnd."',iscomplete='1' where uid=".$this->getUid();
		$update=mysql_query($sql);
		return $update;
	}
}

?>