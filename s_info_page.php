<!-- 게시글 상세 내역 -->

<?php
  session_start();
  ?>

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

   function chk_reward(){

    var sel = document.getElementById("reward");
    var s_value= sel.value;

  window.open("check_reward.php?s_value="+s_value,"리워드확인","left=200, top:200, width:20, height:10, scrollbars=no,resizeble=yes");
 }

  </script>
</head>

<body>
  <div id="header"></div>
      <!-- <font color="BLACK" SIZE="6"><p align="center">SHOW-Mori</p></font> -->
      <!-- <p align="center"><IMG src="line.jpg" width=1000 height=5></IMG></p> -->
  <div id="content">
    <?
    include './dbconn.php';
    $sinfonum = $_GET['snum'];
    $sInfo = "SELECT S_TITLE,S_POSTER,S_SYNOP,S_GOALSUM,S_DEADLINE,S_PRM from post_t WHERE S_PRM='".$sinfonum."';";
    $s_info = mysqli_query($conn,$sInfo);
    $nDate = date('Y-m-d');



    while($row = mysqli_fetch_array($s_info)){

      $sprm = $row['S_PRM'];
      $title = $row['S_TITLE'];
      $poster = $row['S_POSTER'];
      $leftDate = intval((strtotime($row['S_DEADLINE'])-strtotime($nDate)) / 86400);
      $deadLine = $row['S_DEADLINE'];
      $goalSum = $row['S_GOALSUM'];
      $synop = $row['S_SYNOP'];
      $leftSum = ($row['S_GOALSUM']-$row2['sum']);

      $mInfo = "SELECT sum(D_MONEY) as sum FROM d_info_t WHERE S_PRM='".$sinfonum."';";
      $s_info2 = mysqli_query($conn,$mInfo);
      $row2 = mysqli_fetch_array($s_info2);

        $donatedSum = $row2['sum'];
        $percentage = round($row2['sum']/$row['S_GOALSUM'],2);
      }


?>
    <div id='postbody'>
        <div class='title'>
          <? echo $title ?>
        </div>
        <div class='img_post'>
          <?php echo"
          <img src='./data/IMG/".$poster."' width=400;/>
          "?>
        </div>
        <div class='posttext'>
          <p>모인금액 <span>   &nbsp; <?=$donatedSum?>    &nbsp; </span>원</p>
          <p>남은시간 <span>    &nbsp; <?=$leftDate?>    &nbsp; </span>일</p>
          <p>달성률        <span>    &nbsp; <?=$percentage?>    &nbsp; </span>%</p>
          <p class='rectangle'>
            <span>펀딩 진행중</span><br>
            <br> <?=$deadLine?> 까지 목표금액인 <?=$goalSum?> 원이 모여야 펀딩이 완성됩니다.<br>
            후원 금액과 리워드는 하단을 참조해 주세요.<br>
          </p>
          <br>
          <form method="POST" action="donationpage.php" >
          <input type="hidden" name="sprm" value='<?echo ($sprm);?>'/>
          <select name='reward' id="reward" class='select_reward'>
            <option value='reward1' selected>￦ 20,000
            <option value='reward2'>￦ 30,000
            <option value='reward3'>￦ 40,000
            <option value='reward4'>￦ 50,000
            </select>
          <input type='submit' value='후원하기' class='submit_button'>
          <input type="button" value="리워드확인" name="btnReward"  onClick="chk_reward()"class="submit_button">
          </form>
        </div>


      </div>
    <div class='img_synop'>
      <?php echo"
        <img src='./data/IMG/".$synop."' width=600; />
        "?>
    </div>
<?
  mysqli_close($conn);
  ?>

  </div>
</body>

</html>