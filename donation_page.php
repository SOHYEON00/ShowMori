
<html>
<head>
<!-- print header -->
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <link rel="stylesheet" href="./donation_page.css"/>
  <script type="text/javascript">

  //페이지가 로드되면 실행한다.
  $(document).ready( function() {

    $("#header").load("header.php");
  });

  function chkDonation(){

  	var date = form_do.bookDate;
  	var sDate = form_do.in_sDate;
  	var lDate = form_do.in_lDate;
  	var title = form_do.chk_title;
  	var money = form_do.sel_money;

  	var dateS = sDate.value;
    var dateL = lDate.value;
    var dateD = date.value; //0000-00-00형태

    if(!(dateD)){
    	alert("예약날짜를 선택해주세요.");
    	document.form_do.bookDate.focus();
    	return;
    }

    if((dateD)<(dateS) || (dateD)>(dateL)){
    	alert("예약날짜는 아래의 예약가능날짜 이외에 선택이 불가합니다..");
    	document.form_do.bookDate.focus();
    	return;
    }


  
    	
    	window.location.href='/confirm_don.php?date='+date.value+'&title='+title.value+'&money='+money.value;
    

  }

 
  </script>
</head>
<body>
<div id="header"></div>
	<?
	session_start();

	include './dbconn.php';

	if(!$_SESSION['userid']) {
		echo'
			<style>
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
     #contents{
            position: relative;
            width:600px;
            height:100px;
            top: 30%;
            background-color: #EAEAEA;
            margin: 0 auto;
            text-align: center;
        }
        #contents span{
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
        #contents a:visited{ color:white; }
        }
        </style>

			<div id="header"></div>
        	<p id="contents">
            <span >로그인이 필요한 기능입니다.</span>
            <button id="getShowInfo_btn"><a href="./loginpage.php"> 로그인 하러 가기</a></button>  
        </p>
		';
		return;
	}

	$get_value = $_POST['reward'];
	$money=0;
	$sPrm = 17;

	//string으로 받은 form_value값 int로 바꾸는 switch문
	switch ( $get_value ) {
		  case 'reward1':
		    $money=20000;

		    break;
		  case 'reward2':
		   $money=30000;
		    break;
		  case 'reward3':
		    $money=40000;
		    break;
		  case 'reward4':
		   $money=50000;
		    break;
	}

	$q_getSinfo = "SELECT S_TITLE,START_DAY,LAST_DAY FROM POST_T WHERE S_PRM='".$sPrm."';";
	$r_getSinfo = mysqli_query($conn,$q_getSinfo);
	$row_getSinfo = mysqli_fetch_array($r_getSinfo);
	

	$title = $row_getSinfo['S_TITLE']; 
	$sDate = $row_getSinfo['START_DAY'];
	$lDate = $row_getSinfo['LAST_DAY'];



	echo '
		<style>
			form{
				position:relative;
				top:20%;
			}
		</style>
		<form name="form_do" method="GET">
	    <div id="showInfo">
	   
	      <p class="title">SUPPORT informatioin</p>
	      <hr style="border-top: 1px solid #D9D9D9;" />
	        <table>
	          <tr>
	            <td class="row1">공연타이틀</td>
	            <td name="chk_title">"'.$title.'"</td>
	         </tr>';

	
	echo '  
	     <tr>
	        <td class="row1">후원금액</td>
	        <td name="sel_money">"'.$money.'"</td>
          </tr>
	     <tr>
	        <td class="row1">예상 리워드</td>
	        <td>';

	    $q_reward = "SELECT D_REWARD FROM REWARD_T WHERE D_MONEY<='".$money."';";
		$r_reward = mysqli_query($conn,$q_reward);
	     while($row_reward=mysqli_fetch_array($r_reward)){
				echo"'".$row_reward['D_REWARD']."' ";
		}
	  
	    echo'
	       	</td>
	     </tr>
	     <tr>
	        <td class="row1">공연 관람날짜</td>
	        <td><input type="date" id="bookDate" name="bookDate"></td>
	       	<td><input type="hidden" name="in_sDate" value="'.$sDate.'"></td>
	        <td><input type="hidden" name="in_lDate" value="'.$lDate.'"></td>
	        ';
		
		echo "
			<tr>
			<td>본 공연은 아래의 날짜 중에서 관람 가능합니다.</td></tr>";

		$q_date = "SELECT DAY FROM S_DATE_T WHERE S_PRM='".$sPrm."';";
		$r_date = mysqli_query($conn,$q_date);	
		while($row_date=mysqli_fetch_array($r_date)){
			echo"<tr><td>'".$row_date['DAY']."'</td></tr> ";
		}

	     echo '</tr>
			</table>
			</div>
	  	 	<div id="supportInfo">
			    	<p class="title">안내 문구</p>
			    	<p class="c_confirm"> -티켓은 1장 예약됩니다.</p>
			    	<p class="c_confirm"> -공연 관련 안내사항은 공연측에 문의바랍니다.</p>
			     </div>
		     
		    
			    </div>
			     <input type="button" onClick="location.href=(main_page.html)" id="post_btn" value="취소" />
			    <input type="submit" id="post_btn" value="확인" onClick="chkDonation()"/>
			  </form>';

  mysqli_close($conn);
	?>

	
	
</body>
</html>