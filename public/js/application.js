function addNewComment(id)
{
	if(id == null || id == "")
		return;
	$.ajax({
        type: "POST", url: URL+"article/addComment/", data: {commenter: $("#new_comment_commenter").val(), comment: $("#new_comment_comment").val(), new_id : id},
        global: false,
        success: function (r) {
            $("#comments").prepend(r);
            var number = parseInt($("#comments_number").html());
            $("#comments_number").html(number+1)
        },
        error: function (req, textStatus, errorThrown) {
            if (textStatus == 'parsererror')
                $(location).attr('href', URL);
            else {
                var err = JSON.parse(req.responseText);
               ShowError(err.Message);
            }
        }
    });
}
