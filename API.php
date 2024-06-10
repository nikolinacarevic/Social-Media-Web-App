
<?php
require_once("php/posts.php");

//API.php?action=togglePostLike
// function that we call from our JS code that processes the request and calls actions that execute queries
function processRequest(){
  $success = false;
  $reason = '';

  $action = getRequestParameter("action");

    // action that was called
    switch ($action) {
      case 'togglePostLike': 
        proccessTogglePostLike($success, $reason);
        break;
      case 'togglePostBookmark': 
        proccessTogglePostBookmark($success, $reason);
        break;
      case 'proccessAddComment':
        proccessAddComment($success, $reason);
        break;
      case 'processAddPost':
        processAddPost($success, $reason);
        break;
      default:
      echo(json_encode(array(
         "success" => false,
         "reason" => "Unknown action: $action"
      )));
      break;
    }

    echo(json_encode(array(
      "success" => $success,
      "reason" => $reason
    )));
}

// getRequestParameter("action") -> "deletePost"
function getRequestParameter($key) {
   // $_REQUEST[$key] -> a map of keys and values from the request
   return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
}

//API.php?action=toggleCardLike&id=1&liked=1
function proccessTogglePostLike(&$success, &$reason){
  $id = getRequestParameter("id");
  $liked = getRequestParameter("liked");

  if(is_numeric($id) && is_numeric($liked)){
    togglePostLike($id, $liked);
    $success = true;
  }
  else {
    $success = false;
    $reason = "Needs id:number, liked:number";
  }
}

function proccessTogglePostBookmark(&$success, &$reason){
  $id = getRequestParameter("id");
  $bookmarked = getRequestParameter("bookmarked");

  if(is_numeric($id) && is_numeric($bookmarked)){
    togglePostBookmark($id, $bookmarked);
    $success = true;
  }
  else {
    $success = false;
    $reason = "Needs id:number, bookmarked:number";
  }
}

function proccessAddComment(&$success, &$reason){
  $username = getRequestParameter("username");
  $text = getRequestParameter("description");
  $postId = getRequestParameter("postID");
  
  if(is_numeric($postId)){
    addComment($username, $text, $postId);
    $success = true;
  }
  else {
    $success = false;
    $reason = "Needs id:number";
  }
}

function processAddPost(&$success, &$reason){
  $imageUrl = getRequestParameter("ImageUrl");
  $description = getRequestParameter("Description");
  $username = getRequestParameter("Username");

  if($imageUrl != "" && $description != "" && $username != "" && $imageUrl != null && $description != null && $username != null){
    addPost($username, $imageUrl, $description);
    $success = true;
  }
  else {
    $success = false;
    $reason = "Needs imageurl, description and username:strings";
  }
}

processRequest();