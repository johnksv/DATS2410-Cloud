<head>
</head>
<body style=margin:0>
  <div id="overlay" style="
    display: flex;
    flex-direction: column;
    position: absolute;
    justify-content: center;
    top: 40%;
    left: 45%;
    z-index: 9999;
    color: white;
    margin: 0 auto;
    transform: translate(-50%, -50%);
    border-left-width: 20px;
    padding: 20px;
    background-color: rgba(0,0,0,0.8);
">
	<h1>Group 08</h1>
	<p>Private IP: <?php echo $_SERVER['SERVER_ADDR'] ?></p>
	<p>Public IP: 128.39.121.59.8008</p>
  </div>
<canvas id="q" width="100%" height="1080">
<script>var q=document.getElementById('q'),s=window.screen,w=q.width=s.width,h=q.height=s.height,p=Array(256).join(1).split(''),c=q.getContext("2d"),m=Math;setInterval(function(){c.fillStyle="rgba(0,0,0,0.05)";c.fillRect(0,0,w,h);c.fillStyle="rgba(0,255,0,1)";p=p.map(function(v,i){r=m.random();c.fillText(String.fromCharCode(m.floor(2720+r*33)),i*10,v);v+=10; return v>768+r*1e4?0:v})},33)</script>

</canvas>

</body>

