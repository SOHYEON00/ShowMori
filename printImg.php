<!-- 메인페이지 게시글 출력 처리 -->

<?
session_start();
include './dbconn.php';



   $qInfo = "SELECT S_TITLE,S_POSTER,S_GOALSUM,S_DEADLINE,S_PRM from post_t;";
   $rPoster = mysqli_query($conn,$qInfo);
   $nDate = date('Y-m-d');
   $cnt=1;

   while($row=mysqli_fetch_array($rPoster)){
      $title = $row['S_TITLE'];
      $show_p = $row['S_PRM'];

      //GET SUM(D_MONEY) BY DONATION
      $qSumMoney = "SELECT S_PRM, sum(d_money) as sum from d_info_t WHERE S_PRM='".$show_p."';";
      $rSumMoney = mysqli_query($conn,$qSumMoney);


      $row2 = mysqli_fetch_array($rSumMoney);


      $leftSum = ($row['S_GOALSUM']-$row2['sum']);//goalsum - donated sum
      $leftDate = intval((strtotime($row['S_DEADLINE'])-strtotime($nDate)) / 86400);
      //deadline - today

      $percentage =round($row2['sum']/$row['S_GOALSUM'],2);

      if($leftDate<=0){
         $qDet = "DELETE FROM D_INFO_T WHERE S_PRM='".$show_p."';";
         $qDet .= "DELETE FROM s_date_t WHERE S_PRM='".$show_p."';";
         $qDet .= "DELETE FROM post_t WHERE S_PRM='".$show_p."';";
         $rDet = mysqli_multi_query($conn,$qDet);
      }


      if($cnt%4==1){
         echo"
            <tr>
            <form method='POST' action='./s_info_page.php'>
               <td>
                  <a href='./s_info_page.php?snum=".$row['S_PRM']."'><img src='./data/IMG/".$row['S_POSTER']."'></a>
                  <a href='./s_info_page.php'><p id='s_title' name='title'>$title</p></a>

                  <p class='t_content'>$leftSum 남음
                     &nbsp;&nbsp;
                     $percentage %</a>
                  </p>
                  <p class='t_content'>마감
                     &nbsp;&nbsp;&nbsp;&nbsp;
                      <a name='print_leftDate'>D-$leftDate day</a>
                   </p>
               </td>
            </form>
            ";
            $cnt++;
      }
       else if($cnt%4==0){
         echo"
            <form method='POST' action='./s_info_page.php'>
               <td>
                  <a href='./s_info_page.php?snum=".$row['S_PRM']."'><img src='./data/IMG/".$row['S_POSTER']."'></a>
                  <a href='./s_info_page.php'><p id='s_title' name='print_title'>$title</p></a>
                  <p class='t_content'>$leftSum 남음
                     &nbsp;&nbsp;
                     $percentage %</a>
                  </p>
                  <p class='t_content'>마감
                     &nbsp;&nbsp;&nbsp;&nbsp;
                      <a name='print_leftDate'>D-$leftDate day</a>
                   </p>
                </td>
             </form>
            </tr>";
            $cnt++;
      }
      else{
         echo"
            <form method='POST' action='s_info_page.php'>
               <td>
                  <a href='./s_info_page.php?snum=".$row['S_PRM']."'><img src='./data/IMG/".$row['S_POSTER']."'></a>
                  <a href='./s_info_page.php'><p id='s_title' name='print_title'>$title</p></a>
                  <p class='t_content'>$leftSum 남음
                     &nbsp;&nbsp;
                     $percentage %</a>
                  </p>
                  <p class='t_content'>마감
                     &nbsp;&nbsp;&nbsp;&nbsp;
                      <a name='print_leftDate'>D-$leftDate day</a>
                   </p>
                </td>
             </form>

            ";
            $cnt++;
         }
   }//print info of show -tuples from DB
mysqli_close($conn);
?>