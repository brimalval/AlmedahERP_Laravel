function makeImportant(item){
	// far is inimportant, fas isn't
	if(item.classList.contains('far')){
		item.classList.remove('far');
		item.classList.add('fas');

		// make this message important

	}
	else{
		item.classList.add('far');
		item.classList.remove('fas');
		item.style.color = "black";

		// remove this message from important
	}
}

// function to archive the message
function archiveMsg(){

}

// function to delete the message
function deleteMsg(){
	
}
