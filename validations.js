function htmlEntities(str) {
                return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            }
    
function validate_summernote(answer) {
    
                if(answer.length < 30) {
                    document.getElementById("answer_errors").innerHTML = "Answer Content cannot be less than 30 characters"
                    return false
                }
        
                count = 0;
            
                var names = answer.split("")
                var uniqueNames = [];
                $.each(names, function(i, el){
                    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                });
                
                for(i = 0; i < uniqueNames.length; i++){
                    if(uniqueNames[i] != "<" && uniqueNames[i] != "p" && uniqueNames[i] != ">" && uniqueNames[i] != "b" && uniqueNames[i] != "r" && uniqueNames[i] != "/" && uniqueNames[i] != "&" && uniqueNames[i] != "n" && uniqueNames[i] != "s" && uniqueNames[i] != ";" && uniqueNames[i] != " " && uniqueNames[i] != null) {
                        return true
                    } 
                }
        document.getElementById("answer_errors").innerHTML = "Answer field cannot be empty"
        return false
}
    
function validate_question() {

        question_title = document.forms["question_post"]["question_title"].value
        
                    document.getElementById("question_errors").innerHTML = "Question Title field cannot be empty"
        
            
                if(question_title.length < 10) {
                    document.getElementById("question_errors").innerHTML = "Question Title cannot be less than 10 characters"
                    return false
                }
        
                x = question_title.trim()
                if (x == null || x == "" || x == " ") {
                    console.log("len is ",question_title.length)
                    return false;
                }
        
        
        
        question_content = $('#summernote').summernote('code')
        
        if(question_content.length < 30) {
                    document.getElementById("question_errors").innerHTML = "Question Content cannot be less than 30 characters"
                    return false
                }
        
        var names = question_content.split("")
                var uniqueNames = [];
                $.each(names, function(i, el){
                    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                });
                
                for(i = 0; i < uniqueNames.length; i++){
                    if(uniqueNames[i] != "<" && uniqueNames[i] != "p" && uniqueNames[i] != ">" && uniqueNames[i] != "b" && uniqueNames[i] != "r" && uniqueNames[i] != "/" && uniqueNames[i] != "&" && uniqueNames[i] != "n" && uniqueNames[i] != "s" && uniqueNames[i] != ";" && uniqueNames[i] != " " && uniqueNames[i] != null) {
                        return true
                    } 
                }
        document.getElementById("question_errors").innerHTML = "Question description field cannot be empty"
        return false
}