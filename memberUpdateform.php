<?php
  session_start();
  include './dbconn.php';

  $id=$_REQUEST['id'];
  $password=$_REQUEST['pass'];
  $name=$_REQUEST['name'];
  $phone=$_REQUEST['phone'];

  //새로 입력된 값으로 회원 정보 변경
  $sql = "update user_t set pw='".$password."', u_name='".$name."', u_phone='".$phone."' WHERE id='".$_SESSION['userid']."'";


  if($conn->query($sql)){
    echo'<html>
        <head>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
        //페이지가 로드되면 실행한다.
        $(document).ready( function() {
            $("#header").load("header.php");
        });
        </script>
        <style>
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
        p{
            position: relative;
            width:600px;
            height:100px;
            top: 30%;
            background-color: #EAEAEA;
            margin: 0 auto;
            text-align: center;
        }
        p span{
            font-family:"Nanum Brush Script";
            font-size:30px;
            padding: 0 10;
            position: absolute;
            top: 40%;
            left:30%;
        }
        #getShowInfo_btn{
            position:relative;
            top:110%;
            margin:0 auto;
            background-color: #F96B6B;
            border-radius: 12px;
            font-size:18px;
            color:white;
            border: 10px;
            height: 35px;
        }
        </style>
        </head>
        <body>
        <div id="header"></div>
        <p >
            <span >회원정보 수정을 완료했습니다.</span>
            <button class="getShowInfo_btn"><a href="./main_page.html"> 홈으로 </a></button>
        </p>
        </body>';
  }else{ //예외처리
    echo 'fail to insert sql';
  }
  mysqli_close($conn);

  ?>

  </html>