//heart icon

let heartIcons = document.querySelectorAll(".post .heart-icon");
for(let i = 0; i < heartIcons.length; i++){
    let heartIcon = heartIcons[i];
    heartIcon.addEventListener("click", handleHeartIconClick);
}

async function handleHeartIconClick(e){
    let heartIcon = e.currentTarget; 

    const post = heartIcon.closest('.post');
	const postId = post.getAttribute('data-post-id');

	const isCurrentlyLiked = heartIcon.classList.contains('fa-heart');
	try {
		const serverResponse = await fetch(
			`API.php?action=togglePostLike&id=${postId}&liked=${isCurrentlyLiked ? 0 : 1}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success) {
			throw new Error(`Error liking post: ${responseData.reason}`);
		}

		if (!isCurrentlyLiked) {
			heartIcon.classList.remove('fa-heart-o');
			heartIcon.classList.add('fa-heart');
		} else {
			heartIcon.classList.remove('fa-heart');
			heartIcon.classList.add('fa-heart-o');
		}
	} catch (error) {
		throw new Error(error.message || error);
	}

}

//bookmark icon

let bookmarkIcons = document.querySelectorAll(".post .bookmark-icon");
for(let i = 0; i < bookmarkIcons.length; i++){
    let bookmarkIcon = bookmarkIcons[i];
    bookmarkIcon.addEventListener("click", handleBookmarkIconClick);
}

async function handleBookmarkIconClick(e){
    let bookmarkIcon = e.currentTarget; 

    const post = bookmarkIcon.closest('.post');
	const postId = post.getAttribute('data-post-id');

	const isCurrentlyBookmarked = bookmarkIcon.classList.contains('fa-bookmark');
	try {
		const serverResponse = await fetch(
			`API.php?action=togglePostBookmark&id=${postId}&bookmarked=${isCurrentlyBookmarked ? 0 : 1}`
		);
		const responseData = await serverResponse.json();

		if (!responseData.success) {
			throw new Error(`Error bookmarking post: ${responseData.reason}`);
		}

		if (!isCurrentlyBookmarked) {
			bookmarkIcon.classList.remove('fa-bookmark-o');
			bookmarkIcon.classList.add('fa-bookmark');
		} else {
			bookmarkIcon.classList.remove('fa-bookmark');
			bookmarkIcon.classList.add('fa-bookmark-o');
		}
	} catch (error) {
		throw new Error(error.message || error);
	}

}

//add new post

const addPostButton = document.querySelector("#button")

addPostButton.addEventListener("click", HandleAddPost);


async function HandleAddPost(e)
{
    let newPost = document.querySelector('.post').cloneNode(true);
    console.log(newPost)

    let path = prompt("Image path: ")
    let description = prompt("Description: ")

	if((path != null) && (description != null))
	if((username != null) && (imageurl != null) && (description != null))
    try {
        const serverResponse = await fetch(`API.php?action=addPost&ImageUrl=${path}&Description=${description}`);
        const responseData = await serverResponse.json();
        window.location.reload();

        if(!responseData.success){
            throw new Error(`Error while commenting post: ${responseData.reason}`)
        }
    }catch(error) {
        throw new Error(error.message || error)
    }

   /* newPost.children[7].innerText= description;
    newPost.children[0].src= path;
    for (let i=9; i<newPost.length; i++)
        {
            newPost.children[i].remove();
        }

    document.querySelector('.post').parentElement.appendChild(newPost);

    newPost.querySelector('.heart-icon').addEventListener("click", handleHeartIconClick);
    newPost.querySelector('.bookmark-icon').addEventListener("click", handleBookmarkIconClick);
    newPost.querySelector('.add-comment').addEventListener("click", handleAddCommentClick);*/
}

//add new comment

let addCommentIcons = document.querySelectorAll(".posts-container .post .add-comment");
for(let i = 0; i < addCommentIcons.length; i++){
    let addCommentIcon = addCommentIcons[i];
    addCommentIcon.addEventListener("click", handleAddCommentClick);
}

function handleAddCommentClick(e){
    let addCommentIcon = e.currentTarget;
    let text = prompt("Comment:");

    if(text){
        let newComment = document.createElement("p");
        newComment.textContent = "@carevicnikolina" + " " + text;

        let post = addCommentIcon.parentElement;
        post.appendChild(newComment);
    }
}
