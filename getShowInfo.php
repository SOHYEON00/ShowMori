<!-- 포스트 업로드 처리 -->
<?
        include './dbconn.php';
        session_start();

        $userid=$_SESSION['userid'];

        $title = $_GET['title'];
        $fileSynop = $_GET['fileSynop'];
        $filePoster = $_GET['filePoster'];
        $startDate = $_GET['startDate'];
        $lastDate = $_GET['lastDate'];
        $deadLine = $_GET['deadLine'];
        $goalSum = $_GET['goalSum']; //url통해 넘어온 값 변수에 저장
     

        //같은 타이틀을 가진 공연이 있는지 체크
        $q_chkT = "SELECT s_title from post_t ;";
        $r_chkT = mysqli_query($conn, $q_chkT);

        while($row_chkT=mysqli_fetch_array($r_chkT)){
            if($title==$row_chkT['s_title']){ 

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
                #contents a:visited{ color:white; }
                </style>
                </head>
                <body>
                <div id="header"></div>
                 <p id="contents">
                    <span >같은 이름을 가진 공연이 존재합니다.</span>
                    <button id="getShowInfo_btn"><a href="./writepostpage.html"> 다른 공연 게시하기</a></button>   
                </p>    
                </body>
                </html>';
        
                return;
            }
        }

        //insert data into POST_T from wrtiepostpage.html        
        $q_inPost = "INSERT INTO POST_T(id, S_POSTER,S_SYNOP,S_TITLE,S_DEADLINE,START_DAY,LAST_DAY,S_GOALSUM ) VALUES('".$userid."','".$filePoster."','".$fileSynop."','".$title."','".$deadLine."','".$startDate."','".$lastDate."','".$goalSum."'); ";
            $r_insert = mysqli_query($conn,$q_inPost);

        //새로 넣은 글의 정보 select
        $q_selS_prm = "SELECT S_PRM,START_DAY,LAST_DAY FROM POST_T WHERE S_TITLE='".$title."'";
        $r_selS_prm = mysqli_query($conn,$q_selS_prm);
        $row=mysqli_fetch_array($r_selS_prm);

        //CALCULATE DATE (lastDate-startDate)
        $sdate = str_replace("-", "", $row['START_DAY']);
        $ldate = str_replace("-","",$row['LAST_DAY']);
        
        //START_DAY에서 LAST_DAY사이의 날짜 YYYY-MM-DD 형식으로 만들어 테이블에 입력
        for($i=$sdate;$i<=$ldate;$i++){
            $year= substr($i,0,4);
            $month = substr($i,4,2);
            $day = substr($i,6,2);

            if(checkdate($month,$day,$year)){
                $caldate= $year."-".$month."-".$day;
            }
                
            $q_inDate = "INSERT INTO S_DATE_T(S_PRM,DAY) VALUES('".$row['S_PRM']."','".$caldate."')";
            $r_inDate = mysqli_query($conn,$q_inDate);
        }
        

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
            <span >포스트 등록을 성공했습니다!</span>
            <input type="button" onClick=location.href("s_info_page.html") value="내가 올린 글 보러 가기" id="getShowInfo_btn"></button>  
        </p>    
        </body>
        </html>';
     mysqli_close($conn);
?>