<html>
<!-- print header -->
<head>
  <link rel="stylesheet" type="text/css" href="./post.css">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

  <script type="text/javascript">

  //페이지가 로드되면 실행한다.
  $(document).ready( function() {

    $("#header").load("header.php");
  });

  </script>
</head>

<body>
  <div id="header"></div>
      <!-- <font color="BLACK" SIZE="6"><p align="center">SHOW-Mori</p></font> -->
      <!-- <p align="center"><IMG src="line.jpg" width=1000 height=5></IMG></p> -->

  <div id="postbody">
      <?php
            include './dbconn.php';

            $title = $_GET['title'];

   //           $qSumMoney = "SELECT S_PRM, sum(d_money) as sum from d_info_t WHERE S_PRM='".$show_p."';";
      // $rSumMoney = mysqli_query($conn,$qSumMoney);
      // $rowSumMoney = mysqli_fetch_array($rSumMoney);

      // $qInfo = "SELECT S_TITLE,S_POSTER,S_GOALSUM,S_DEADLINE,S_PRM from post_t WHERE S_PRM='".$show_p."'";
      // $rPoster = mysqli_query($conn,$qInfo);
      // $row=mysqli_fetch_array($rPoster);
      // $title = $row['S_TITLE'];



    
       echo' <div class="title">"'.$title .'"</div>
        <!-- <p style="font-family:musical;">굿닥터</p> -->

        <div class="img_post">
          <img src="./IMG/굿닥터.jpg" width=300 height=450/>
        </div>

        <div class="posttext">
          <p class="p1">모인금액       <span class="span1">

      </span>원</p>
          
          <p class="p1">남은시간       <span class="span1">42</span>일</p>
          <p class="p1">후원자        <span class="span1">10</span>명</p>
          <p class="rectangle">
            <span class="span1">펀딩 진행 중</span><br>
            <br>2020년 6월 22일까지 목표금액인 500,000원이 모여야 펀딩이 완성됩니다.<br>
            후원 금액과 리워드는 하단을 참조해 주세요.<br>
          </p>';
          ?>
          <br>
          <form method="POST" action="./donation_page.php">
            <select name="reward" class="select_reward">
              <option value="reward1" selected>￦ 20,000</option>
              <option value="reward2">￦ 30,000</option>
              <option value="reward3">￦ 40,000</option>
              <option value="reward4">￦ 50,000</option>
              </select>
            <input type="submit" value="후원하기" name="submit" class="submit_button">
          </form>
        </div>


      </div>
    <div class="img_synop">
      <img src="./data/IMG/빨래 시놉.jpg" width=600 />
    </div>

</body>

</html>
