$("#chatbot-textbox").keypress(function(event){
    if ( event.which == 13){
        $("#chatbot-btn").click();
        event.preventDefault();
    }
});

$("#chatbot-btn").click(function() {

    if ($("#chatbot-textbox").val() != "") {

        question = $("#chatbot-textbox").val();

        addQuestionToChat(question);

        $.ajax({
            type: 'POST',
            url: $("#botman-ask-route").data("route"),
            dataType: "json",
            data: {'message': question},

            success: function (data) {
                addResponseToChat(data['messages'][0]['text']);
                $(".chat-div .panel-body").animate({scrollTop: $(document).height()}, 1000);
                $("#chatbot-textbox").select()

            },
            error: function () {
                alert('error');
            }
        });


    }
});

function addQuestionToChat(question)
{
    $("#chat-conversation").append('<li class="right clearfix"> <span class="chat-img pull-right"> <img src="http://placehold.it/40/FF3900/fff&text=v" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="pull-right primary-font">Vous</strong></div>'
    +'<p>'+ question +'</p></div> </li>');
}

function addResponseToChat(response)
{
    $("#chat-conversation").append('<li class="left clearfix"><span class="chat-img pull-left">  <img src="http://placehold.it/40/086CA2/fff&text=b" alt="User Avatar" class="img-circle" /> </span> <div class="chat-body clearfix"> <div class="header"><strong class="primary-font">Bastien</strong></div>'+
        '<p>'+ response+'</p></div></li>');
}

$('document').ready(function()
{

    addResponseToChat($("#initial-message").data("msg"));
    $("#chat-div .panel-collapse").collapse('show')
    var timeoutId = setTimeout(function(){
        $("#chat-div .panel-collapse").collapse('hide')
    }, 6000);
    $('#chatbot-textbox').focus(function(){
        clearTimeout(timeoutId);
    });
});

