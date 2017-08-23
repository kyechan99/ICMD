<!-- https://github.com/kyechan99/ICMD -->
<!-- 사용전에 읽어 주시길 바랍니다 -->
<!-- <script language="JavaScript">의 myname 부분을 본인의 성함으로 바꾸주세요 -->
<!-- 그외 스크립트는 추가해도 되지만 삭제는 삼가주시길 바랍니다. -->
<!-- 파일 instruction 에는 txt 파일만 허용되며 대문자로 작성해 주세요 -->
<!-- txt 파일은 UTF-8 형태로 저장해 주시길 바랍니다. (안그러면 한글이 깨져요..) -->
<!-- 각종 버그나 오류를 찾으시거나 개선법을 알고계실시 위 github 로 Request 해주시면 갑사합니다. -->
<!-- OtherLink.txt 에는 등록된 사용자들의 링크가 담겨져 있습니다. 특별한 경우가 아니라면 남겨 주시고 웹서버에도 같이 올려주세요. (관련 명령어가 포함되어있음) -->
<!-- OtherLink.txt 에 본인 링크를 추가해 주시고 Request 요청해 주시면 Apply 해드립니다. -->
<!-- 끝까지 읽어주셔 감사드립니다. ( 이메일 : kyechan99@naver.com ) -->

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
      // 아래의 Ye-Chan-Kang 만 본인의 성함으로 변경해 주시면 됩니다.
      var myname = "Ye-Chan-Kang";

      var text = "<p>Developer Introduce [ Version 1.0.1 ]</p>";
      text = text + "<p>Full Script Source : https://github.com/kyechan99/ICMD</p>";
      text = text + "<p>If U Found Error, Plz Pull-request or Issue</p>";
      text = text + "<p>Access IP : 127.0.0.1 ..</p>";
      text = text + "<p>Found User : " + myname + " ... </p>";
      text = text + "<p>Success Connecting..!</p>";

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

    <!-- 내용 입력 받기 -->
    <script>
      var cmd = "";       // 지금 입력 하고 있는 명령어
      var str = new String("");
      var beforeDoc = document.getElementById('texts').innerHTML;

      function on_key_down() {
      	var keycode = event.keyCode;

        if ( keycode == 8 ) {                // 백스페이스
          cmd.slice (0, -1);
        } else if ( keycode == 116           // F5
      	) event.returnValue = false;         // 브라우저 기능 키 무효화

        if ( keycode == 13 ) {               // 엔터
          onEnter();
        } else if ( keycode == 190 ) {       // '.'
          cmd = cmd + ".";
          document.getElementById('texts').innerHTML += "<span>" +  "." + "</span>";
        } else if ( keycode == 191 ) {       // '/''
          cmd = cmd + "/";
          document.getElementById('texts').innerHTML += "<span>" +  "/" + "</span>";
        } else {
          cmd = cmd + String.fromCharCode( keycode );
          document.getElementById('texts').innerHTML += "<span>" +  String.fromCharCode( keycode ) + "</span>" ;
        }
      }

      // 엔터키를 눌렀을 때
      function onEnter() {
        // 첫 글자가 '/' 일시 명령어를 입력한 것이므로 확인
        if (cmd.substring(0,1) == "/") {
          if (cmd == "/HELP") {
            document.getElementById('texts').innerHTML += "<br><span> > Here are Instructions that you can use..</span>";
            document.getElementById('texts').innerHTML += "<br><span> >> ANOTHER : Found Another Developer URL </span>";
            document.getElementById('texts').innerHTML += "<br><span> >> TELEPORT : Teleport To Another Developer URL By Random </span>";
            document.getElementById('texts').innerHTML += "<? foreach ($files as $f) { echo "<br> >> "; echo $f; }?>" + "<br>";
          } else if (cmd == "/ANOTHER") {
            document.getElementById('texts').innerHTML += "<br><span> > Found Anoter Developer...</span>";
            foundAnotherURL("../OtherLink.txt");
            document.getElementById('texts').innerHTML += "<br>";
          } else if (cmd == "/TELEPORT") {
            document.getElementById('texts').innerHTML += "<br><span> > Teleporting...</span>";
            goAnotherURL("../OtherLink.txt");
            document.getElementById('texts').innerHTML += "<br>";
          } else {
            var forLen = Number(<? echo count($files); ?>);
            var cmdIns = <?php echo json_encode($files)?>;
            var bCheck = false;

            for (var i = 0; i < forLen; i++) {
              if (cmdIns[i] == cmd.substring(1)) {
                readTxtFile("../instruction/" + cmdIns[i] + ".txt");
                bCheck = true;
                break;
              }
            }

            // 틀린 명령어를 쳤을 때
            if (bCheck == false) {
              document.getElementById('texts').innerHTML += "<br> > Wrong Instructions.." + "<br>";
            }
          }
        }
        cmd = "";
        document.getElementById('texts').innerHTML += "<br><span>C:\\Users\\" + myname + " > </span>";
      }

      // 텍스트 파일 읽고 출력
      function readTxtFile(file) {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
          if(rawFile.readyState === 4) {
            if(rawFile.status === 200 || rawFile.status == 0) {
              var allText = rawFile.responseText;

              document.getElementById('texts').innerHTML += "<br><span>" + allText + "</span><br>";
            }
          }
        };
        rawFile.send(null);
      }

      // 다른 URL 로 랜덤으로 이동
      function goAnotherURL(file) {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
          if(rawFile.readyState === 4) {
            if(rawFile.status === 200 || rawFile.status == 0) {
              var allText = rawFile.responseText;
              var lines = allText.split("\n");
              setTimeout("location.href='" + lines[Math.floor(Math.random() * lines.length)] +"'",3000);
            }
          }
        };
        rawFile.send(null);
      }

      // 등록된 다른 URL 읽고 출력
      function foundAnotherURL(file) {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
          if(rawFile.readyState === 4) {
            if(rawFile.status === 200 || rawFile.status == 0) {
              var allText = rawFile.responseText;
              var lines = allText.split("\n");
              for (var i = 0; i < lines.length; i++) {
                document.getElementById('texts').innerHTML += "<br><span>" + lines[i] + "</span>";
              }
            }
          }
        };
        rawFile.send(null);
      }
    </script>
    <?php ?>
    <script src="../js/"></script>
  </body>
</html>
