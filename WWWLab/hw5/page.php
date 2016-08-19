<div id="content">
                 <div class="table-title">
<h3>您近期更新/被留言的文章</h3>
</div>
            <table class="table-fill" width="750" cellpadding="10" cellspacing="0" >
            <thead><tr class="title">
                <th class="text-left" width="95">發表日期</th>
                <th class="text-left" width="50">作者</th>
                <th class="text-left">標題</th>
                <th class="text-left" width="50">回覆</th>
                <th class="text-left" width="160">最後更新/回覆</th>
                </tr></thead>
              <?php
                //$sql_query = "SELECT * FROM `article `WHERE `author_id` = ".$row_result["author_id"];//." ORDER BY `article`.`create_time` DESC "
$sql_query = "SELECT * FROM `article` WHERE `author_id` = ".$row['id']." ORDER BY `article`.`last_update` DESC limit 5";
                $result=mysql_query($sql_query);
				while($row_result=mysql_fetch_array($result)){
					echo "<tr>";
					echo "<td class='text-left'>".$row_result["create_time"]."</td>";
                    $sql1 = "SELECT * FROM `user` WHERE `id` = ".$row_result["author_id"];
                    $result1 = mysql_query($sql1);
                    $row1 = mysql_fetch_assoc($result1);
                    echo "<td class='text-left'>".$row1['Name']."</td>";
					echo "<td class='text-left'><a href='index.php?page=2&id=".$row_result["id"]."'>".$row_result["title"]."</a></td>";
                    $sql2 = "SELECT * FROM `response` WHERE `article_id` = ".$row_result['id'];
                    $result2 = mysql_query($sql2);
                    $num_rows = mysql_num_rows($result2);
				    echo "<td class='text-left'>".$num_rows."</td>";
                    echo "<td class='text-left'>".$row_result["last_update"]."</td>";
					echo "</tr>";
				}
			?> 
                     </table> 
                
              <div class="table-title">
<h3>所有文章列表</h3>
</div>
            <table class="table-fill" width="750" cellpadding="10" cellspacing="0" >
                <thead>
            <tr class="title">
                <th class="text-left" width="95">發表日期</th>
                <th class="text-left" width="50">作者</th>
                <th class="text-left">標題</th>
                <th class="text-left" width="50">回覆</th>
                <th class="text-left" width="160">最後更新/回覆</th>
                    </tr></thead>
              <?php
                $sql_query = "SELECT * FROM `article` ORDER BY `article`.`last_update` DESC";
                $result=mysql_query($sql_query);
                
				while($row_result=mysql_fetch_assoc($result)){
					echo "<tr>";
					echo "<td class='text-left'>".$row_result["create_time"]."</td>";
                    $sql1 = "SELECT * FROM `user` WHERE `id` = ".$row_result["author_id"];
                    $result1 = mysql_query($sql1);
                    $row1 = mysql_fetch_assoc($result1);
                    echo "<td class='text-left'>".$row1['Name']."</td>";
					echo "<td class='text-left'><a href='index.php?page=2&id=".$row_result["id"]."'>".$row_result["title"]."</a></td>";
				     $sql2 = "SELECT * FROM `response` WHERE `article_id` = ".$row_result['id'];
                    $result2 = mysql_query($sql2);
                    $num_rows = mysql_num_rows($result2);
				    echo "<td class='text-left'>".$num_rows."</td>";
                    echo "<td class='text-left'>".$row_result["last_update"]."</td>";
					echo "</tr>";
				}
			?>
                
                    </table>
                
            </div>