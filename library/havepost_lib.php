<?php
/**
 * This file contains functions for obtaining information about a post
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
  /**
  *Returns a boolean value to indicate whehter a have is completed or not 
  *@param integer $have_id Postid given
  *@return boolean
  */   
function isComplete($have_id)
{
 
    $q=mysql_query("SELECT have_id from haveTransactionTable where have_id=$have_id");
    if(mysql_num_rows($q))
    {
        return true;
    }
    else
    return false;
}


?>