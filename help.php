<!DOCTYPE html>
<html lang="en">
<head>
    
    
  <title>Bootstrap Case</title>
    <?php include 'header.php' ?>
</head>
<body>
    
    <?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>

<div class="container">
  <h2>Frequently Asked Questions</h2>
  <p>Navigate to your respective tab to know about the usage of the website and frequently asked questions about the section.</p>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Registered User</a></li>
    <li><a data-toggle="tab" href="#menu1">Administrator</a></li>
    <li><a data-toggle="tab" href="#menu2">Unregistered User</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br>
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                Questions</a>
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>Before asking the question, make sure that the question has not been asked previously by the other user.</b></p>
                  <p><b>1.</b> How can i ask questions ?</p>
                  <p><b>Ans.</b> Any registered users can ask questions using the 'Ask Question' tab in the navigation bar. </p>
                  <p><b>2.</b> Can i embed any codes or images in question ?</p>
                  <p><b>Ans.</b> Yes you can embed any type of code and images in question using the editor that is provided. </p>
                  <p><b>3.</b> Can i edit my question once it is posted ?</p>
                  <p><b>Ans.</b> At this point, no you cannot edit your question, once it is posted. </p>
                  <p><b>4.</b> Why cant i see my question that i previously asked ?</p>
                  <p><b>Ans.</b> Probably administrator has deleted your question. </p>
                  <p><b>5.</b> How can i mark the best answer for the question that i asked ?</p>
                  <p><b>Ans.</b> You can use the checkmarks provided beside the answers to mark them. Note that you can only mark one answer. Marked answers are always see first and then remaining answers are seen according to their value as highest value first. </p>
                  <p><b>5.</b> Why can't i mark or see any more answers ?</p>
                  <p><b>Ans.</b> Probably your question has been freezed by the administrator. </p>
                  <p><b>6.</b> Why can i see only five questions on my home page ?</p>
                  <p><b>Ans.</b> You can only see top 5 questions in you home page, for all questions navigate to all questions page on the navigation bar.</p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                Answers</a>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>Answers should not be copy pasted from other websites. Minimum length of answers is 30 characters</b></p>
                  <p><b>1.</b> How can i answer the questions ?</p>
                  <p><b>Ans.</b> Any registered users can answer questions by clicking on them. </p>
                  <p><b>2.</b> Can i embed any codes or images in answers ?</p>
                  <p><b>Ans.</b> Yes you can embed any type of code and images in answers using the editor that is provided. </p>
                  <p><b>3.</b> Can i edit my answer once it is posted ?</p>
                  <p><b>Ans.</b> At this point, no you cannot edit your answer, once it is posted. </p>
                  <p><b>3.</b> Why can't i answer the question ?</p>
                  <p><b>Ans.</b> Either you are not a registered user or the question has been freezed by the administrator. </p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                Score</a>
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How is my score calculated ?</p>
                  <p><b>Ans.</b> Your score is sum of all the values of the questions asked by you. Value of a question is 'sum of upvotes for a question - sum of downvotes for a question' </p>
                  <p><b>2.</b> What happens to my score when a question asked by me is deleted ?</p>
                  <p><b>Ans.</b> Your score will decrease if that question have positive value and will increase if that question have negative value </p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                Votes</a>
              </h4>
            </div>
            <div id="collapse10" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i vote for a question/answer ?</p>
                  <p><b>Ans.</b> You can vote using the arrow marks provided beside questions/answers. </p>
                  <p><b>2.</b> Why cant i vote for a question/answer ?</p>
                  <p><b>Ans.</b> You cant upvote/downvote twice for question/answer and also you should be a registered user for voting them. </p>
                  <p><b>3.</b> What it the value for a question/answer that i see beside them ?</p>
                  <p><b>Ans.</b> It is the sum of total upvotes - sum of total downvotes </p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                Users</a>
              </h4>
            </div>
            <div id="collapse11" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i see other users profile ?</p>
                  <p><b>Ans.</b> You can see other users profile just by typing the name on the search box provided on navigation bar or just by clicking on the username that you see near the answers or questions </p>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <br>
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                Freeze Questions</a>
              </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i freeze the question ?</p>
                  <p><b>Ans.</b> All the administrators can freeze a question by going to admin page using navigation bar. Navigate to a question in questions tab and there you can see freeze button, You can unfreeze the same question again in the same way.  </p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                Delete Questions</a>
              </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i delete the question ?</p>
                  <p><b>Ans.</b> All the administrators can freeze a question by going to admin page using navigation bar. Navigate to a question in questions tab and there you can see delete button. Once you delete the question, it's gone!! </p>
                </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                User Information</a>
              </h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i get the users information ?</p>
                  <p><b>Ans.</b> All the administrators can get users information by going to admin page using navigation bar. Navigate to a user in users tab and there you can see their information in the profile page. </p>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <br>
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                Information</a>
              </h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse">
              <div class="panel-body">
                  <p><b>1.</b> How can i ask/answer questions ?</p>
                  <p><b>Ans.</b> You need to register before asking/answering/voting question. Click on signup button on the navigation bar and provide the necessary details </p>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

</body>
</html>

