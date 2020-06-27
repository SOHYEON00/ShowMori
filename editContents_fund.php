<!-- 펀딩(게시글)정보 수정을 위한 값 입력 폼 -->
<?
session_start();
include './dbconn.php';
?>
<html>
<head>
<!-- print header -->
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <link rel="stylesheet" href="./writepostpage.css"/>
  <script type="text/javascript">

  //페이지가 로드되면 실행한다.
  $(document).ready( function() {

    $("#header").load("header.php");
  });
  

  function chkForm(){
      
      var fileSynop = post_form.fileSynop;
      var filePoster = post_form.filePoster;
      var startDate = post_form.startDate;
      var lastDate = post_form.lastDate;
      var deadLine = post_form.deadLine;
      var goalSum = post_form.goalSum;
      var v_sprm = post_form.name_sprm;

      var dateS = new Date(startDate.value);
      var dateL = new Date(lastDate.value);
      var dateD = new Date(deadLine.value);

      
        if(goalSum.value<50000){
          alert("목표금액은 최소 50,000입니다.");
          document.post_form.goalSum.focus();
          return;
        }
        if((+dateS)>=(+dateL)){
          alert("공연 시작날짜가 공연 마감날짜와 같거나 늦습니다.");
          document.post_form.startDate.focus();
          return;
        }
        if((+dateD)>=(+dateS)){
          alert("후원 마감날짜는 공연 시작날짜보다 늦을 수 없습니다.");
          document.post_form.deadline.focus();
          return;
        }
        
        window.location.href='/editCon_fund_final.php?fileSynop='+fileSynop.files[0].name+'&filePoster='+filePoster.files[0].name+'&startDate='+startDate.value+'&lastDate='+lastDate.value+'&deadLine='+deadLine.value+'&goalSum='+goalSum.value+'&sprm='+v_sprm.value;
      return;
    
  } //재입력 값 확인 후 url통한 값 넘기기
  </script>
</head>

<?
  
  $sprm = $_GET['sprm'];

  //정보수정을 위한 글 제목 찾는 쿼리문
  $q_getT = "SELECT S_TITLE FROM POST_T WHERE S_PRM='".$sprm."';";
  $r_getT = mysqli_query($conn,$q_getT);
  $row_getT = mysqli_fetch_array($r_getT);


//게시글정보 재입력 폼
echo'
<div id="header"></div> 
  
  <h3>포스트 수정하기</h3>
  <div id="post">

<form name="post_form" method="GET" >
    <div id="showInfo">
    
   
      <p class="title">SHOW informatioin</p>
      <hr style="border-top: 1px solid #D9D9D9;" />
        <table>
          <tr>
            <td class="row1">타이틀</td>
            <td ><labe>"'.$row_getT['S_TITLE'].'"</label></td>   
          </tr>
          <tr>
            <td class="row1">시놉시스</td>
            <td><input type="file" name="fileSynop"  ></td>
          </tr>
          <tr>
            <td class="row1">공연 포스터</td>
            <td><input type="file" name="filePoster" ></td>
          </tr>
          <tr>
            <td class="row1">공연 시작날짜</td>
            <td><input type="date" name="startDate"></td>
          </tr>
          <tr>
            <td class="row1">공연 마감날짜</td>
            <td> <input type="date" name="lastDate"></td>
          </tr>
        </table>
    </div>


    <div id="supportInfo">

      <p class="title">SUPPORT Information</p>
      <hr style="border-top: 1px solid #D9D9D9;" />
      <table>
          <tr>
            <td class="row1">후원 마감날짜</td>
            <td><input type="date" name="deadLine" ></td>
          </tr>
          <tr>
            <td class="row1">목표금액</td>
            <td><input type="number" name="goalSum" ></td>
          </tr>
     
          </table>

     </div>
      <div id="extra">
        <p class="title"> extra <hr style="border-top: 1px solid #D9D9D9;"> <input type="text"> </p>
      </div>
    
    </div>
    <input type="hidden" name="name_sprm" value="'.$sprm.'"/>
    <input type="button" id="post_btn" value="POST" onClick="chkForm()"/>
  </form>

</body>
</html>';

mysqli_close($conn);
?>