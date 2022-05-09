let editor;

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");
    editor.session.setMode("ace/mode/php");
}

function changeLanguage() {

    let language = $("#languages").val();

    if(language == 'c' || language == 'cpp')editor.session.setMode("ace/mode/c_cpp");
    else if(language == 'php')editor.session.setMode("ace/mode/php");
    else if(language == 'python')editor.session.setMode("ace/mode/python");
    else if(language == 'node')editor.session.setMode("ace/mode/javascript");
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function executeCode() {
   
    // $.ajax({

    //     url: "{{route('codeRun')}}",

    //     method: "POST",

        // data: {
        //     language: $("#languages").val(),
        //     code: editor.getSession().getValue()
        // },

    //     success: function(response) {
    //         $(".output").text(response)
    //     }
    // })
    $.ajax({
        type:'POST',
        url:'/codeRun',
        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue()
        },
        success:function(response){
            $(".output").html(response)
        }
     });
    
}