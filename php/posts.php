<?php
require_once("DatabaseAccess.php");


function getPostsFromDb(){
	 return getDbAccess()->executeQuery("SELECT * FROM Posts;");
}

function getCommentsFromDb($postId){
    return getDbAccess()->executeQuery("SELECT * FROM Comments WHERE postID = $postId");
}

function generatePostsHtml(){
    $html = "";

    $posts = getPostsFromDb();

    foreach($posts as $post){ 
        $id = $post[0];
        $username = $post[1];
        $imageUrl = $post[2];
        $description = $post[3];
        $liked = $post[4];
        $likes = $post[5];
        $bookmarked = $post[6];

        $heartClass = $liked == '1' ? "fa-heart" : "fa-heart-o";
        $bookmarkClass = $bookmarked == '1' ? "fa-bookmark" : "fa-bookmark-o";
     
        $html .= "<article class='post' data-post-id='$id'>
                    <img src='$imageUrl'/>
                    <i class='fa $heartClass heart-icon clickable-icon'></i> 
                    <span class='likes'>$likes</span>
                    <i class='fa $bookmarkClass bookmark-icon clickable-icon'></i>
                    <br></br>
                    <p><b>@carevicnikolina</b></p>
                    <p>$description</p>
                    <p><b>COMMENTS:</b></p>
                    <form>
                    @carevicnikolina:
                    <i class='fa fa-plus add-comment clickable-icon'></i>
                    </form>";
        
        $comments = getCommentsFromDb($id);
            foreach($comments as $comment)
            {
                $html .= "<p>$comment[1]:<br>$comment[2]</p>";
            }

        $html .= "</article>";    
    }

    return $html;
}

function togglePostLike($id, $liked) {
    getDbAccess()->executeQuery("UPDATE Posts SET Liked='$liked' WHERE ID='$id'");
    if($liked == 1)
    {
        getDbAccess()->executeQuery("UPDATE Posts SET Likes=Likes+1 WHERE ID='$id'");
    }
    else
    {
        getDbAccess()->executeQuery("UPDATE Posts SET Likes=Likes-1 WHERE ID='$id'");
    }

}

function togglePostBookmark($id, $bookmarked) {
    getDbAccess()->executeQuery("UPDATE Posts SET Bookmarked='$bookmarked' WHERE ID='$id'");
    if($bookmarked == 1)
    {
        getDbAccess()->executeQuery("UPDATE Posts SET Bookmarks=Bookmarks+1 WHERE ID='$id'");
    }
    else
    {
        getDbAccess()->executeQuery("UPDATE Posts SET Bookmarks=Bookmarks-1 WHERE ID='$id'");
    }

}

function addComment($username, $text, $postId){
    getDbAccess()->executeInsertQuery("INSERT INTO `Comments` (`username`, `Description`, `postID`) VALUES ('$username', '$text', '$postId')");
}

function addPost($username, $imageUrl, $description){
    getDbAccess()->executeInsertQuery("INSERT INTO `Posts` (`Username`, `ImageUrl`, `Description`) VALUES ('$username', '$imageUrl', '$description')");
}