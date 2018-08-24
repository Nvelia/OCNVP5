if (!sessionStorage.post){
    var postFormOpened = false;
} else{
    var postFormOpened = sessionStorage.post;
}

var loginOpened = false;
var memberBlockOpened = false;
var slideIndex = 1;
var commentFormOpened = false;
var avatarBlockOpened = false;

var reportedText = false;

$('#login').on("click", function(){
    var form = $('#formLogin');
    if(loginOpened == false){
        form.css({
            "display": "block"
        });
        loginOpened = true;
    }
    else{
        form.css({
            "display": "none"
        });
        loginOpened = false;
    }
})

$('#memberLink').on("click", function(){
    var memberBlock = $('#memberBlock');
    if(memberBlockOpened == false){
        memberBlock.css({
            "display": "block"
        });
        memberBlockOpened = true;
    }
    else{
        memberBlock.css({
            "display": "none"
        });
        memberBlockOpened = false;
    }
})

$('.displayAvatarForm').on("click", function(){
    var avatarForm = $('#changeAvatar');
    if(avatarBlockOpened == false){
        avatarForm.css({
            "display": "block"
        });
        avatarBlockOpened = true;
    }
    else{
        avatarForm.css({
            "display": "none"
        });
        avatarBlockOpened = false;
    }
})

function showPostForm(){
    var postForm = $('#postForm');
    if(postFormOpened == false){
        postForm.css({
            "display": "none"
        });
    }
    else{
        postForm.css({
            "display": "block"
        });
    }
}

$('#addPost').on("click", function(){
    if(postFormOpened == false){
        postFormOpened = true;
        sessionStorage.setItem("post", true);
    }
    else{
        postFormOpened = false;
        sessionStorage.setItem("post", false);
    }
    showPostForm();
});

$('#addComment').on("click", function(){
    var commentForm = $('#commentForm');
    if(commentFormOpened == false){
        commentForm.css({
            "display": "block"
        });
        commentFormOpened = true;
    }
    else{
        commentForm.css({
            "display": "none"
        });
        commentFormOpened = false;
    }
});

function displayReportedText(){
    if(reportedText === false){
        reportedText = true;
        this.nextElementSibling.style.display = "block";
        this.style.display = "none";
    }
    else if(reportedText === true){
        reportedText = false;
        this.nextElementSibling.style.display = "none";
    }
}

function displayReported(){
    if(reportedText === true){
        reportedText = false;
        this.parentElement.style.display = "none";
        $('.hiddenReportLink').css('display', 'inline')
    }
}

$('.hiddenReportLink').on('click', displayReportedText);
$('.hiddenReportCross').on('click', displayReported);

$('.deleteCom').on('click', function(){
    var c = confirm('Voulez vous supprimer ce commentaire?');
    if(c == false){
        return false;
    }
});

$('.reportCom').on('click', function(){
    var c = confirm('Voulez vous signaler ce commentaire?');
    if(c == false){
        return false;
    }
});

$('.report').on('click', function(){
    var c = confirm('Voulez vous signaler ce chapitre?');
    if(c == false){
        return false;
    }
});

$('.delete').on('click', function(){
    var c = confirm('Voulez vous supprimer ce chapitre?');
    if(c == false){
        return false;
    }
});

showPostForm();