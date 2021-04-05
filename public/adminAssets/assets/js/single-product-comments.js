
$(document).ready(function (){
    getComments()

})

function getComments() {
    $.ajax({
        url:'/api/comments/'+id,
        method:'get',

        dataType: 'json',
        success: function (data){
            console.log(data)
            printComments(data.product,data.product.comments,data.comments,data.users,data.only_for_checking_if_user_liked_a_comment)
            //printProduct(data.product, data.comments, data.commentDetails)
        },
        error: function (error,xhr,status){
            printErrors(error.responseJSON.errors.text,form)
        }
    });
}
var repliedUser=''

function printComments(product,comments,liked_comments,users,only_for_check) {
    let x=``
    var totalComments = 0
    let i = 0;

    console.log(comments)
    for (const comment of comments) {
        if(comment.pivot.parent_id == null && comment.pivot.user_replied_id == null){
            x+=`
<div class="single-comment-item">
    <div class="sc-author">
        <img src="${adminFolder+"/assets/img/profile_image.png"}" alt="${comment.name}">
    </div>
    <div class="sc-text">
        <span>${comment.pivot.date}</span>
        <h5>${comment.name}</h5>
        <p>${comment.pivot.text}</p>
        <span class="text-success font-weight-bold">Number of Likes: ${liked_comments[i].liked_comments.length}</span>

        <form action="${publicFolder+'/admin/comment/'+comment.pivot.id}" method="post">
                ${methodDelete}
                ${csrf}
                <button type="submit" class="comment-btn reply btn btn-danger float-right" data-idcomment="${comment.pivot.id}"
               data-iduser="${comment.id}" data-form="${i}" data-loggedin=""><i class="fa fa-close"></i></button>
        </form>

    </div>
</div>
`
            let j = 0;
            for (const c of comments) {
                if(comment.pivot.id == c.pivot.parent_id)
                {
                    x+=`${printSubComments(comment,c,users,liked_comments[j].liked_comments.length,j,only_for_check)}`
                }
                j++
            }

        }


        i++

        totalComments++
    }

    function printSubComments(comment,subComment,users,likes,j,only_for_check) {




        let x = ``
        findRepliedUser(subComment)
        console.log(repliedUser)
        x+=`<div class="single-comment-item reply-comment">
        <div class="sc-author">
            <img src="${adminFolder+"/assets/img/profile_image.png"}" alt="${subComment.name}">
        </div>
        <div class="sc-text">
            <span>${subComment.pivot.date}</span>
            <h5>${subComment.name}</h5>

            <p><span>@ ${repliedUser}</span> ${subComment.pivot.text}</p>
            <span class="text-success font-weight-bold">Number of Likes: ${likes}</span>
            <form action="${publicFolder+'/admin/comment/'+subComment.pivot.id}" method="post">
            ${methodDelete}
            ${csrf}
            <button type="submit" class="comment-btn reply btn btn-danger float-right" data-idcomment="${subComment.pivot.parent_id}"
               data-iduser="${subComment.id}" data-form="${j}" data-loggedin=""><i class="fa fa-close"></i></button>
            </form>

        </div>
    </div>`

        j++


        return x

    }
    function findRepliedUser(subComment) {

        $.ajax({
            url:'/getUser/'+subComment.pivot.user_replied_id,
            method:'get',
            async: false,
            dataType: 'json',
            success: function (data){

                repliedUser = data.name;
                console.log(repliedUser)
                console.log(data.name)
                //printProduct(data.product, data.comments, data.commentDetails)
            },
            error: function (error,xhr,status){
                printErrors(error.responseJSON.errors.text,form)
            }
        });
        console.log(subComment)
        /*let repliedUser = ''

        for (const u of users) {
            if(u.id == subComment.pivot.user_replied_id)
            {
                repliedUser = u.name
            }
        }

        return repliedUser*/
    }



    $('#comments').html(x)
    $('#comments').prepend(`<h4>${totalComments} Comments</h4>`)
    $('#numOfComments').html(` ${totalComments}`)
    $('.replyForm').hide();
}
