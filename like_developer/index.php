<!-- https://github.com/kyechan99/ICMD -->
<?php
  $dir = "../instruction";
  $handle  = opendir($dir);
  $files = array();

  while (false !== ($filename = readdir($handle))) {
      if($filename == "." || $filename == ".."){
          continue;
      }

      if(is_file($dir . "/" . $filename)){
          $divFileName = explode('.', $filename);
          $files[] = $divFileName[0] ;
      }
  }

  closedir($handle);
  sort($files);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ICMD</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>
  </head>

  <style>
    body {
      background-color: #000000;
    }
    p {
      font-size: 15px;
      color: #5dff00;
    }
    span {
      font-size: 15px;
      color: #5dff00;
    }
  </style>

  <body onkeydown='on_key_down()'>
    <table>
  	   <tr>
  	      <td><span id="texts">&nbsp;</span></td>
  	   </tr>
    </table>

    <!-- 첫 타이틀, 기본으로 보여줄 부분입니다. 수정하지 말아 주세요 -->
    <script language="JavaScript">
      var myname = "Ye-Chan-Kang";

      var text = "<p>Developer Introduce [ Version 0.0.1 ]</p>";
      text = text + "<p>Look Full Script Source : https://github.com/kyechan99/ICMD</p>";
      text = text + "<p>If U Found Error, Plz pull request for our</p>";
      text = text + "<p>Access IP : 127.0.0.1 ..</p>";
      text = text + "<p>Found User : " + myname + " ... </p>";
      text = text + "<p>Success Connecting..!</p>";

      // 아래의 Ye-Chan-Kang 을 본인의 성함으로 변경해 주시면 됩니다.
      text = text + "<span>C:\\Users\\" + myname + " > </span>";

      var cnt = 0;
      var speed = 2;
      var timer1 = null;

      function gogogo(){
      	document.getElementById('texts').innerHTML = text.substring(0, cnt);
      	cnt++;
      	timer1 = setTimeout('gogogo()', speed);

      	if(text.length < cnt){
      		clearTimeout(timer1);
      		cnt = 0;
          callCMD();
      	}
      }
      gogogo();
    </script>

    <?php
      /*
      // 하위 파일명을 출력한다.
      foreach ($files as $f) {
          echo "<span>";
          echo $f;
          echo "</span> ";
      }*/
    ?>

    <!-- 내용 입력 받기 -->
    <script>
      var cmd = "";   // 지금 입력 하고 있는 명령어
      var str = new String("");
      var beforeDoc = document.getElementById('texts').innerHTML;

      function on_key_down() {
      	var keycode = event.keyCode;

        if ( keycode == 8 ) {     // 백스페이스
          cmd.slice (0, -1);
        } else if ( keycode == 116            // F5
      	) event.returnValue = false;   // 브라우저 기능 키 무효화

        if ( keycode == 13 ) {         // 엔터
          onEnter();
        } else if ( keycode == 190 ) {       // '.'
          cmd = cmd + ".";
          document.getElementById('texts').innerHTML += "<span>" +  "." + "</span>";
        } else if ( keycode == 191 ) {       // '/
          cmd = cmd + "/";
          document.getElementById('texts').innerHTML += "<span>" +  "/" + "</span>";
        } else {
          cmd = cmd + String.fromCharCode( keycode );
          document.getElementById('texts').innerHTML += "<span>" +  String.fromCharCode( keycode ) + "</span>" ;
        }
      }

      function onEnter() {
        if (cmd == "/HELP") {
          document.getElementById('texts').innerHTML += "<br><span> > Here are Instructions that you can use..</span>";
          document.getElementById('texts').innerHTML += "<? foreach ($files as $f) { echo "<br> >> "; echo $f; }?>" + "<br>";
        }
        cmd = "";
        document.getElementById('texts').innerHTML += "<br><span>C:\\Users\\" + myname + " > </span>";
      }


    </script>
    <?php ?>
    <script src="../js/"></script>
  </body>
</html>
