<?php
session_start();
include("../assets/include/connection.php"); // Fixed path to point to the correct location

if (isset($_SESSION['admin_name'])) {
    echo "<script>
    window.location = './desktop.php';
</script>";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control Panel | Sign In</title>
  <!-- Google Fonts - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <?php include("../assets/include/head.php"); ?>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/desktop-nav.css">
<style>
  :root {
       --primary: whitesmoke;
    --light-color: #e9e9e9;
    --placeholder: 0.85;
    --btn-hover: rgba(255, 255, 255, 0.07);
    --btn-color: #f2f2f2;
    --btn-border: 0.5px solid rgba(255, 255, 255, 0.1);
     --input-border: 1.2px solid rgba(255, 255, 255, 0.15);
    --border-radius: 12px;
    --btn: rgba(255, 255, 255, 0.05);
    --shadow: 0 0 15px rgba(0, 0, 0, .25);
    --focus-shadow: 0 1.5px 10px #666;
    --element: rgba(255, 255, 255, .1);
  }
@media (prefers-color-scheme: dark) {
:root{
  --primary: #000;
  --light-color: #151515;
  --btn-color: #333;
  --shadow: 0 0 10px rgba(0, 0, 0, 0.4);
  --focus-shadow: 0 1.5px 10px #333;
  --btn-hover: rgba(0, 0, 0, .08);
  --input-border: 1.2px solid rgba(0, 0, 0, .15);
  --btn-border: 0.5px solid rgba(0, 0, 0, 0.1);
  --btn: 1px solid rgba(0, 0, 0, 0.2);
  --element: rgba(0, 0, 0, .1);
  --placeholder: 0.8;
}
.gradient-bg {
  background: 
  linear-gradient(to top, #6a1b9a, transparent 2%),
  linear-gradient(to bottom, #6a1b9a, transparent 15%),
  linear-gradient(to right, #1dcc70, #6a1b9a, #ff2d55) !important;
  background-blend-mode: overlay;
    @media (max-width: 900px) {
      background: linear-gradient(to right, #6a1b9a, transparent 4%),
      linear-gradient(to left, #6a1b9a, transparent 4%),
      linear-gradient(to left, #6a1b9a, transparent 4%),
      linear-gradient(180deg,  #1dcc70, #6a1b9a, #ff2d55) !important;
      background-blend-mode: saturation !important;
    }@media (max-width: 570px) {
      background: linear-gradient(to right, #6a1b9a, transparent 4%),
      linear-gradient(to left, #6a1b9a, transparent 4%),
      linear-gradient(to left, #6a1b9a, transparent 4%),
      linear-gradient(135deg,  #1dcc70, #6a1b9a, #ff2d55) !important;
      background-blend-mode: saturation !important;
    }
}.glass-effect, .login-container{
  background: rgba(0, 0, 0, 0.08) !important;
  box-shadow: inset 0 -3px 12px rgba(0, 0, 0, 0.2),
  -3px 7px 30px rgba(0, 0, 0, 0.08) !important;
}.glass-effect:hover, .login-container:hover{
  background: rgba(0, 0, 0, 0.12) !important;
  box-shadow: inset 0 -3px 12px rgba(0, 0, 0, 0.15),
  -3px 7px 30px rgba(0, 0, 0, 0.15) !important;
}
}
body{
  z-index: 0;
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  align-items: center;
  min-height: 100vh;
  height: auto;
  overflow-x: hidden;
  transition: background-color 0.5s ease;
}.gradient-bg{
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  background: 
    linear-gradient(to top, #9c27b0, transparent 2%),
    linear-gradient(to bottom, #9c27b0, transparent 15%),
    linear-gradient(to right, #1dcc70, #9c27b0, #ff2d55);
  background-size: 100% 100%;
  background-blend-mode: luminosity;
  animation: gradientAnimation 15s ease infinite;
  transition: background 0.5s ease;
  background-repeat: no-repeat;
  background-position: top center;
  z-index: -1;
}.container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1em;
  width: 100%;
  max-width: 1600px !important;
  padding: 1em;
  overflow-y: auto;
}.glass-effect, .login-container{
  border-radius: var(--border-radius);
  border: var(--input-border);
  background: rgba(255, 255, 255, 0.12);
  box-shadow: inset 0 -3px 12px rgba(255, 255, 255, 0.2),
  -5px 5px 32px 3px rgba(255, 255, 255, 0.06);
  transition: all 0.3s ease;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}.glass-effect:hover, .login-container:hover {
  background: rgba(255, 255, 255, 0.2);
  box-shadow: inset 0 -3px 12px rgba(255, 255, 255, 0.12),
  -3px 8px 32px rgba(31, 38, 135, 0.35);
  transform: translateY(-1px);
}.glass-effect {
  display: flex;
  padding: 0.75em 0.75em 0.4em;
  overflow-y: auto; /* Ensures scroll if content exceeds height */
  flex-direction: column;
  justify-content: center;
}.glass-effect p {
  margin-bottom: 0.25em;
  font-size: 1.25em;
  line-height: 1.15;
}.glass-effect p strong {
  color: var(--primary);
  font-weight: 600;
}.glass-effect p span {
  color: var(--light-color);
  opacity: var(--placeholder);
  font-weight: 500;
}.wrapper{
  margin-bottom: auto;
  display: flex;
  flex-direction: column;
}.icon, .eye, .fa-eye-slash{
  color: var(--light-color);
  opacity: var(--placeholder);
}.right-eye {
  position: absolute;
  right: 0.4em;
  top: 0%;
  transform: translateY(50%);
  font-size: 1.5em;
  color: var(--light-color);
  opacity: var(--placeholder);
  cursor: pointer;
  z-index: 10;
}.fa-eye-slash{
  right: 0.35em;
}.wrapper h1{
  font-size: 3em;
  text-align: center;
  color: var(--primary);
  padding-top: 0.25em !important;
  margin-bottom: 0px !important;
  font-weight: 600;
}.wrapper p{
  font-size: 1.2em;
  font-weight: 400;
  position: relative;
  top: -0.5em;
  text-align: center !important;
  color: var(--light-color);
  margin-bottom: 0px !important;
  opacity: var(--placeholder);
}.wrapper .btn{
  width: 45%;
  height: 2.2em;
  font-size: 1.4em;
  font-weight: 500;
  color: var(--btn-color);
  border: var(--btn-border);
  box-shadow: var(--shadow);
  outline: none;
  border-radius: 25px;
  margin: 0.5em auto 0.2em;
  transition: 0.3s;
}.wrapper .btn:active, .view-more-btn:active {
  transform: scale(0.98);
  color: var(--light-color);
  box-shadow: 
   0 2px 4px rgba(0, 0, 0, 0.2),
   0 3px 0 rgba(0, 0, 0, 0.1); /* Reduce shadow depth */
}.wrapper .btn:hover, .view-more-btn:hover {
  background: var(--btn-hover);
  box-shadow: var(--focus-shadow);
  border: var(--btn);
}footer{
  text-align: center;
  line-height: 1em !important;
  border-radius: var(--border-radius);
}footer p{
  font-size: 1.25em;
  color: var(--light-color);
  opacity: var(--placeholder);
  font-weight: 600;
  margin: 0.2em auto 0.5em;
  width: 90%;
}.alert-success{
  text-align: center !important;
  color: var(--light-color);
  border: var(--btn-border);
  font-weight: 500;
  border-radius: var(--border-radius);
  font-size: 1.25em;
}.bg-success{
  background-color: #1dcc70 !important;
  @media (prefers-color-scheme: dark) {
    background-color: #198754 !important;
    opacity: var(--placeholder);
    }
  }.forgot{
  color: var(--light-color);
  font-size: 1.25em;
  position: relative;
  border: none;
  outline: none;
  text-decoration: none;
  }.forgot:hover{
  text-decoration: solid;
  color: var(--light-color);
  opacity: var(--placeholder);
}.message {
  position: relative;
  color: #ff0000;
  font-weight: 600;
  font-size: 1.25em;
  bottom: 0.35em;
  margin-bottom: -0.5em;
  text-align: center;
  }.floating-elements {
    position: absolute;
    width: 100%;
    height: calc(100vh - 4.6em);
    z-index: -1;
    overflow: hidden;
  }.star {
    position: absolute;
    bottom: -100px;
    background: var(--element) !important;
    clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    animation: rise 10s infinite ease-in;
    transition: background 0.5s ease;
  }.box1 {
    position: absolute;
    bottom: -100px;
    background: var(--element) !important;
    border-radius: 12px;
    animation: rise 12s infinite ease-in;
    transition: background 0.5s ease;
    }.box2 {
      position: absolute;
      bottom: -100px;
      background: var(--element) !important;
      border-radius: 25px;
      animation: rise 14s infinite ease-in;
      transition: background 0.5s ease;
    } @keyframes gradientAnimation {
        0% {
        background-position: 0% 50%;
        }
        50% {
        background-position: 100% 50%;
        }
        100% {
        background-position: 0% 50%;
        }
      }@keyframes rise {
      0% {
        bottom: -100px;
        transform: translateX(0) rotate(0deg);
      }50% {
        transform: translateX(100px) rotate(180deg);
      }100% {
        bottom: 1080px;
        transform: translateX(-200px) rotate(360deg);
        }
        }
        @media (max-width: 900px) {
    html, .gradient-bg{
      background: linear-gradient(to right, #9c27b0, transparent 4%),
      linear-gradient(to left, #9c27b0, transparent 4%),
      linear-gradient(180deg,  #1dcc70, #9c27b0, #ff2d55) ;
       background-blend-mode: luminosity ;
       background-size: 100% 100%;
    }.container {
      width: 95%;
      margin: 0 auto;
      grid-template-columns: 1fr;
      gap: 2em;
      padding: 0.5em;
    }.glass-effect {
      width: 100%;
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.35) !important;
    }.login-container{
      width: 100%;
    }.container-fluid{
      width: auto !important;
      display: block !important;
      margin: 0em 0.25em !important;
    }.wrapper .btn{
      margin: 0.5em auto;
    }
  }
  @media (max-width: 570px) {
    html, .gradient-bg{
      background: linear-gradient(to right, #9c27b0, transparent 4%),
      linear-gradient(to left, #9c27b0, transparent 4%),
      linear-gradient(120deg,  #1dcc70, #9c27b0, #ff2d55) ;
    }
    .container {
      display: flex;
      flex-direction: column;
      height: auto;
      gap: 1.5em;
      margin: 0em !important;
      width: 100%;
      justify-self: center;
      max-height: none;
    }.container-fluid{
      margin: 0em !important;
      padding: 0em 0.5em;
    }.wrapper h1{
      margin-top: 0em !important;
      font-size: 2.65em !important;
      letter-spacing: -0.05em !important;
      line-height: 0.7em;
    }.wrapper p{
      font-weight: 500;
      font-size: 1em;
      top: -0.2em;
      padding: 0.2em .5em;
      line-height: 1em;
    }.wrapper .btn{
      width: 80%;
      margin: 0.41em auto;
    }.login-container {
      order: 1;
    }.glass-effect {
      order: 2;
      overflow-y: visible;
      max-height: 100px;
      padding: 0.75em;
      transition: max-height 0.3s ease, padding 0.3s ease;
    }.glass-effect.expanded {
      max-height: 100%;
    }.glass-effect.expanded p {
  display: block !important;
}
.glass-effect:not(.expanded) p:not(:first-child) {
  display: none !important;
}.date-time-row {
  display: flex;
  align-items: center;
  gap: 0.5em;
  width: 100%;
}
.date-time-p {
  flex: 1 1 auto;
  margin: 0;
  overflow: hidden;
  text-overflow: ellipsis;
}
.view-more-btn {
  flex-shrink: 0;
  width: 80%;
  height: 2.2em;
  font-size: 1em;
  padding: 0.3em 1em;
  display: inline-flex;
  justify-content: center;
  align-self: center;
  background: transparent;
  color: var(--btn-color);
  border: var(--btn-border);
  box-shadow: var(--shadow);
  border-radius: var(--border-radius);
  font-weight: 500;
  transition: all 0.3s ease;
  z-index: 10;
}footer p{
    font-size: 1.1em;
    margin: 0.4em auto !important;
    font-weight: 500;
    }
  }
</style>
</head>
<body class="gradient-bg">
<header class="header-container" id="header">
    <h2 class="brand">DELT ARCADE</h2>
    <a href="javascript:history.go(-1)" onClick="goBack()">
      <i class="fa-regular fa-circle-left"></i>
    </a><img src="../assets/img/sample/logo.png" alt="Logo" class="logo-img" />
  </header>  
<!-- Page loading -->
<div class="loading" id="loading">
  <div class="spinner-grow"></div>
</div>
<div class="floating-elements">
        <div class="star" style="left: 10%; width: 30px; height: 30px; animation-delay: 0s; animation-duration: 8s;"></div>
        <div class="box1" style="left: 20%; width: 25px; height: 25px; animation-delay: 1s; animation-duration: 10s;"></div>
        <div class="box2" style="left: 35%; width: 40px; height: 40px; animation-delay: 2s; animation-duration: 12s;"></div>
        <div class="star" style="left: 50%; width: 20px; height: 20px; animation-delay: 0s; animation-duration: 9s;"></div>
        <div class="box1" style="left: 65%; width: 35px; height: 35px; animation-delay: 1s; animation-duration: 11s;"></div>
        <div class="box2" style="left: 75%; width: 30px; height: 30px; animation-delay: 2s; animation-duration: 14s;"></div>
    </div>
<div class="container">
  <div class="glass-effect">
 <div class="date-time-row">
  <p class="date-time-p"><strong>Date & Time:</strong> <span id="current-time"><?php echo date('Y-m-d H:i:s'); ?></span></p>
</div>
  <p><strong>MAC Address:</strong> <span id="mac-address">Loading...</span></p>
  <p><strong>Location:</strong> <span id="location">Loading...</span></p>
  <p><strong>Info:</strong> <span id="whois-info">Loading...</span></p>
  <p><strong>Hostname:</strong> <span id="hostname">Loading...</span></p>
  <p><strong>IP Address:</strong> <span id="ip-address"><?php echo $_SERVER['REMOTE_ADDR']; ?></span></p>
  <p><strong>Device:</strong> <span id="device-info">Loading...</span></p>
  <p><strong>User Agent:</strong> <span id="user-agent">Loading...</span></p>
  <p><strong>Server:</strong> <span id="server-headers">Loading...</span></p>
  <button type="button" class="view-more-btn" id="viewMoreBtn">View More</button>
</div>
<div class="login-container d-flex flex-column">
  <div class="wrapper">
    <h1><i class="fas fa-user-shield me-1"></i>Control Panel</h1>
    <p>To access the control panel, please Sign In.</p>
    <div class="container-fluid">
 <form action="validateAdmin.php" method="post">
          <div class="inner-addon left-addon">
            <i class="fas fa-user icon"></i>
            <input type="text" class="form-control" placeholder="Username or Email" name="admin_id" required>
          </div>
        <div class="inner-addon left-addon right-addon mb-0">
            <i class="fas fa-lock icon"></i>
            <input type="password" class="form-control" placeholder="Password" name="password_admin" id="password_field" required>
              <i class="fas fa-eye right-eye" id="password_toggle_icon" onclick="togglePassword()"></i>
            <input type="hidden" name="login" value="login">
          
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn">
            <i class="fas fa-sign-in-alt me-1"></i>Sign In
          </button>
        </div>
<?php if(isset($_GET['err'])=="ture") { ?>
        <div class="message" role="alert">
          <i class="fas fa-exclamation-circle me-1"></i> Check your username or password
        </div>
      <?php } ?>
      <?php if(isset($_GET['msg1'])=="notauthorized") { ?>
        <div class="message" role="alert">
          <i class="fas fa-exclamation-circle me-1"></i> Wrong Action Performed By User
        </div>
      <?php } ?>
      <?php if(isset($_GET['logout'])=="sucess") { ?>
        <div class="alert-success bg-success" role="alert">
          <i class="fas fa-check-circle me-1"></i> You Are Logged Out Successfully
        </div>
      <?php } ?>
        <!--<a href="#" class="forgot">I forgot my password!</a>-->
      </form>
      </div>
    </div>
    <footer class="footer d-flex justify-content-center">
  <p class="footerBottom">Copyright &copy; <?php echo date('Y'); ?> DELT ARCADE. All rights reserved.</p>
</footer>
  </div>
 
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Password Toggle Script -->
<script>
  function createFloatingElements() {
  const container = document.querySelector('.floating-elements');
  for (let i = 0; i < 8; i++) {
  const types = ['star', 'box1', 'box2'];
  const type = types[Math.floor(Math.random() * types.length)];
  const element = document.createElement('div');
    element.classList.add(type);
    element.style.left = `${Math.random() * 100}%`;
                
    const size = 15 + Math.random() * 30;
    element.style.width = `${size}px`;
    element.style.height = `${size}px`;            
    element.style.animationDelay = `${Math.random() * 5}s`;
    element.style.animationDuration = `${8 + Math.random() * 12}s`;
    container.appendChild(element);
    }
  }

  
  function togglePassword() {
  const field = document.getElementById("password_field");
  const icon = document.getElementById("password_toggle_icon");
  if (field.type === "password") {
    field.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    field.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
}
 
  // Hide loading spinner when page is loaded
  window.addEventListener('load', function() {
    document.getElementById('loading').style.display = 'none';
  });
  function goBack() {
    window.history.back();
  }

// Global variable to store timezone information
let userTimezone = null;
let userCountry = null;

// Function to update the time every second based on user's location
function updateTime() {
  const now = new Date();
  
  // If we have timezone information from the API, adjust the time
  if (userTimezone) {
    // Format the date according to the user's timezone
    const options = {
      timeZone: userTimezone,
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false
    };
    
    try {
      // Try to format the date using the Intl.DateTimeFormat API
      const formatter = new Intl.DateTimeFormat('en-US', options);
      const formattedTime = formatter.format(now).replace(/\//g, '-').replace(',', '');
      let label = '';
      if (userCountry !== 'India') {
        label = ` (${userCountry})`;
      }
      document.getElementById('current-time').textContent = formattedTime + label;
    } catch (e) {
      // Fallback to default formatting if there's an error
      console.error('Error formatting date with timezone:', e);
      defaultTimeFormat(now);
    }
  } else {
    // Use default formatting if no timezone info is available
    defaultTimeFormat(now);
  }
}

document.getElementById('viewMoreBtn').addEventListener('click', function() {
  const glassEffect = document.querySelector('.glass-effect');
  glassEffect.classList.toggle('expanded');
  this.textContent = glassEffect.classList.contains('expanded') ? 'View Less' : 'View More';
  // Show/hide paragraphs as before
  const paragraphs = glassEffect.querySelectorAll('p:not(.date-time-p)');
  if (glassEffect.classList.contains('expanded')) {
    paragraphs.forEach(p => p.style.display = 'block');
  } else {
    paragraphs.forEach(p => p.style.display = 'none');
  }
});

function defaultTimeFormat(now) {
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  
  const formattedTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
  document.getElementById('current-time').textContent = formattedTime;
}

// Function to fetch user's location and additional security information based on IP address
function fetchLocation() {
  // Try with free tier first (no token required)
  fetch('https://ipinfo.io/json')
    .then(response => {
      if (!response.ok) {
        // If free tier fails, try with token
        return fetch('https://ipapi.co/json/');
      }
      return response.json();
    })
    .then(data => {
      if (data.error) {
        throw new Error('API returned an error');
      }
      
      // Format location using ipinfo.io response format
      // Check if we have all the necessary fields
      let location = 'Unknown';
      if (data.city && data.region && data.country) {
        location = `${data.city}, ${data.region}, ${data.country}`;
      } else if (data.city && data.country_name) {
        // Handle ipapi.co format
        location = `${data.city}, ${data.country_name}`;
      }
      document.getElementById('location').textContent = location;
      
      // Update IP address with the one from the API
      document.getElementById('ip-address').textContent = data.ip;
      
      // Store timezone and country information
      userTimezone = data.timezone || 'UTC';
      userCountry = data.country || data.country_code || 'Unknown';
      
      // Update hostname information
      document.getElementById('hostname').textContent = data.hostname || 'Not available';
      
      // Check for proxy
      checkProxyStatus(data.ip);
      
      // Get WHOIS information
      getWhoisInfo(data.ip);
      
      // Get server headers
      getServerHeaders();
      
      // Update time immediately with the new timezone information
      updateTime();
    })
    .catch(error => {
      console.error('Error fetching location:', error);
      document.getElementById('location').textContent = 'Location unavailable';
      document.getElementById('hostname').textContent = 'Lookup failed';
      
      // Use the IP from the server as fallback
      const serverIP = document.getElementById('ip-address').textContent;
      if (serverIP) {
        checkProxyStatus(serverIP);
        getWhoisInfo(serverIP);
      }
    });
}

// Function to check if the user is using a proxy
function checkProxyStatus(ip) {
  // Set a timeout to handle slow responses
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(() => reject(new Error('Request timed out')), 5000);
  });
  
  // Using proxycheck.io API to detect proxies
  Promise.race([
    fetch(`https://proxycheck.io/v2/${ip}?key=191ab3-o06t47-732z59-535zp9&vpn=1&risk=1`),
    timeoutPromise
  ])
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.status === 'ok' && data[ip]) {
        const proxyData = data[ip];
        if (proxyData.proxy === 'yes') {
          document.getElementById('proxy-status').textContent = `Detected (${proxyData.type})`;
          document.getElementById('proxy-status').style.color = '#ff0000';
        } else {
          document.getElementById('proxy-status').textContent = 'No proxy detected';
        }
      } else {
        document.getElementById('proxy-status').textContent = 'Check failed';
      }
    })
    .catch(error => {
      console.error('Error checking proxy status:', error);
      document.getElementById('proxy-status').textContent = 'Check failed';
    });
}

// Function to get WHOIS information
function getWhoisInfo(ip) {
  // Set a timeout to handle slow responses
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(() => reject(new Error('Request timed out')), 5000);
  });
  
  // Using RDAP API for WHOIS data
  Promise.race([
    fetch(`https://rdap.arin.net/registry/ip/${ip}`),
    timeoutPromise
  ])
    .then(response => {
      if (!response.ok) {
        // Try alternative WHOIS API if ARIN fails
        return fetch(`https://whois.ipinfo.io/${ip}/json`);
      }
      return response.json();
    })
    .then(response => {
      // Handle potential second fetch response
      if (response instanceof Response) {
        if (!response.ok) {
          throw new Error('All WHOIS lookups failed');
        }
        return response.json();
      }
      return response; // Already JSON from first API
    })
    .then(data => {
      let whoisInfo = 'Not available';
      
      // Handle ARIN RDAP format
      if (data.name) {
        whoisInfo = `${data.name}`;
        if (data.entities && data.entities.length > 0 && data.entities[0].vcardArray) {
          const vcardData = data.entities[0].vcardArray[1];
          for (let i = 0; i < vcardData.length; i++) {
            if (vcardData[i][0] === 'org') {
              whoisInfo += ` (${vcardData[i][3]})`;
              break;
            }
          }
        }
      }
      // Handle ipinfo.io WHOIS format
      else if (data.org || data.asn) {
        whoisInfo = data.org || `AS${data.asn}`;
        if (data.netname) {
          whoisInfo += ` (${data.netname})`;
        }
      }
      
      document.getElementById('whois-info').textContent = whoisInfo;
    })
    .catch(error => {
      console.error('Error fetching WHOIS info:', error);
      document.getElementById('whois-info').textContent = 'Lookup failed';
    });
}

// Function to get server headers
function getServerHeaders() {
  // Set a timeout to handle slow responses
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(() => reject(new Error('Request timed out')), 3000);
  });
  
  Promise.race([
    fetch(window.location.href, { method: 'HEAD' }),
    timeoutPromise
  ])
    .then(response => {
      let headers = '';
      if (response.headers.get('server')) {
        headers += `${response.headers.get('server')}`;
      }
      document.getElementById('server-headers').textContent = headers || 'Not available';
    })
    .catch(error => {
      console.error('Error fetching server headers:', error);
      document.getElementById('server-headers').textContent = 'Check failed';
    });
}

// Function to display user agent information
function displayUserAgent() {
  const userAgent = navigator.userAgent;
  document.getElementById('user-agent').textContent = userAgent;
}

// Function to detect and display device information
function detectDevice() {
  const userAgent = navigator.userAgent;
  let deviceInfo = '';
  let isCurrentDevice = false;
  
  // Display user agent information
  displayUserAgent();
  
  // Detect mobile devices
  if (/Android/i.test(userAgent)) {
    // Check for Samsung devices first
    if (/SAMSUNG|Samsung|SM-|GALAXY|Galaxy/i.test(userAgent)) {
      // Try to extract Samsung model information
      let samsungModel = '';
      
      // Check for Fold or Flip series
      if (/Fold/i.test(userAgent)) {
        samsungModel = 'Galaxy Fold';
      } else if (/Flip/i.test(userAgent)) {
        samsungModel = 'Galaxy Flip';
      } else {
        // Extract model from SM-XXXX pattern
        const modelMatch = userAgent.match(/SM-([A-Z0-9]+)/i);
        if (modelMatch && modelMatch[1]) {
          samsungModel = `Galaxy SM-${modelMatch[1]}`;
        } else {
          // Try to extract from other patterns
          const galaxyMatch = userAgent.match(/Galaxy\s([^\s;/]+)/i);
          if (galaxyMatch && galaxyMatch[1]) {
            samsungModel = `Galaxy ${galaxyMatch[1]}`;
          } else {
            samsungModel = 'Galaxy Device';
          }
        }
      }
      
      // Extract Android version
      const versionMatch = userAgent.match(/Android\s([\d\.]+)/);
      if (versionMatch && versionMatch[1]) {
        samsungModel += ` (Android ${versionMatch[1]})`;
      }
      
      deviceInfo = samsungModel;
    } else {
      // Handle other Android devices
      const match = userAgent.match(/Android\s([\d.]+)\s?;\s?([^;\s]+)/);
      if (match && match[2]) {
        deviceInfo = `${match[2]} (Android ${match[1]})`;
      } else {
        // Try to at least get the Android version
        const versionMatch = userAgent.match(/Android\s([\d\.]+)/);
        if (versionMatch && versionMatch[1]) {
          deviceInfo = `Android ${versionMatch[1]}`;
        } else {
          deviceInfo = 'Android Device';
        }
      }
    }
    isCurrentDevice = true;
  } else if (/iPhone|iPad|iPod/i.test(userAgent)) {
    // Detect iOS devices
    if (/iPhone/i.test(userAgent)) {
      deviceInfo = 'iPhone';
      try {
        // Use screen dimensions to make an educated guess about the model
        const screenWidth = window.screen.width * window.devicePixelRatio;
        const screenHeight = window.screen.height * window.devicePixelRatio;
        
         if (screenWidth === 640 && screenHeight === 1136) {
          deviceInfo = 'iPhone 5/5s/SE';
        } else if (screenWidth === 1080 && screenHeight === 1920) {
          deviceInfo = 'iPhone 6s Plus/6 Plus/7 Plus/8 Plus';
        } else if (screenWidth === 750 && screenHeight === 1334) {
          deviceInfo = 'iPhone 6s/6/7/8/SE2/SE3';
        } else if (screenWidth === 828 && screenHeight === 1792) {
          deviceInfo = 'iPhone XR/11';
        } else if (screenWidth === 1125 && screenHeight === 2436) {
          deviceInfo = 'iPhone X/XS/11 Pro';
        } else if (screenWidth === 1242 && screenHeight === 2688) {
          deviceInfo = 'iPhone XS Max/11 Pro Max'; 
        } else if (screenWidth === 1170 && screenHeight === 2532) {
          deviceInfo = 'iPhone 12/12 Pro/13/13 Pro/14/16e';
        } else if (screenWidth === 1080 && screenHeight === 2340) {
          deviceInfo = 'iPhone 12 mini/13 mini';
        } else if (screenWidth === 1179 && screenHeight === 2556) {
          deviceInfo = 'iPhone 14 Pro/15/15 Pro/16';
        } else if (screenWidth === 1284 && screenHeight === 2778) {
          deviceInfo = 'iPhone 12 Pro Max/13 Pro Max/14 Plus';
        } else if (screenWidth === 1290 && screenHeight === 2796) {
          deviceInfo = 'iPhone 14 Pro Max/15 Plus/15 Pro Max/16 Plus';
        } else if (screenWidth === 1320 && screenHeight === 2868) {
          deviceInfo = 'iPhone 16 Pro Max';
        }else if (screenWidth === 1206 && screenHeight === 2622) {
          deviceInfo = 'iPhone 16 Pro';
        }else {
          deviceInfo = 'iPhone (Unknown Model)';
        }
      } catch (e) {
        console.error('Error detecting iPhone model:', e);
        deviceInfo = 'iPhone';
      }
    } else if (/iPad/i.test(userAgent)) {
      deviceInfo = 'iPad';
      
      // Try to get iOS version for iPad (still show version for non-iPhone devices)
      const match = userAgent.match(/OS\s([\d_]+)/);
      if (match && match[1]) {
        const version = match[1].replace(/_/g, '.');
        deviceInfo += ` (iOS ${version})`;
      }
    } else if (/iPod/i.test(userAgent)) {
      deviceInfo = 'iPod';
      
      // Try to get iOS version for iPod (still show version for non-iPhone devices)
      const match = userAgent.match(/OS\s([\d_]+)/);
      if (match && match[1]) {
        const version = match[1].replace(/_/g, '.');
        deviceInfo += ` (iOS ${version})`;
      }
    }
    isCurrentDevice = true;
  } else {
    // Detect desktop OS
    if (/Windows/i.test(userAgent)) {
      const match = userAgent.match(/Windows\sNT\s([\d.]+)/);
      let version = '';
      if (match && match[1]) {
        switch (match[1]) {
          case '10.0': 
            // Improved Windows 11 detection
            try {
              // First attempt: Use userAgentData if available (most reliable)
              if (navigator.userAgentData && navigator.userAgentData.getHighEntropyValues) {
                navigator.userAgentData.getHighEntropyValues(['platformVersion'])
                  .then(ua => {
                    if (parseInt(ua.platformVersion) >= 13) {
                      document.getElementById('device-info').textContent = 'Windows 11' + 
                        (document.getElementById('device-info').textContent.includes('Current Device') ? 
                        ' (Current Device)' : '');
                    }
                  })
                  .catch(e => console.error('Error detecting Windows version:', e));
              }
              
              // Second attempt: Check for Windows 11 specific features
              const buildNumber = navigator.userAgent.match(/Build\/(\d+)/);
              if (buildNumber && parseInt(buildNumber[1]) >= 22000) {
                version = '11';
              } else {
                // Fallback to checking browser features that might indicate Windows 11
                const canvas = document.createElement('canvas');
                const gl = canvas.getContext('webgl2');
                if (gl) {
                  const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
                  const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
                  // Some GPUs/drivers that are more common on Windows 11
                  if (renderer && (/DirectX 12/i.test(renderer) || /ANGLE/i.test(renderer))) {
                    version = '11';
                  } else {
                    version = '10';
                  }
                } else {
                  version = '10';
                }
              }
            } catch (e) {
              console.error('Error in Windows version detection:', e);
              version = '10';
            }
            break;
          case '6.3': version = '8.1'; break;
          case '6.2': version = '8'; break;
          case '6.1': version = '7'; break;
          default: version = match[1];
        }
      }
      deviceInfo = `Windows ${version}`;
      isCurrentDevice = true;
    } else if (/Mac/i.test(userAgent)) {
      const match = userAgent.match(/Mac\sOS\sX\s([\d_.]+)/);
      if (match && match[1]) {
        const version = match[1].replace(/_/g, '.');
        deviceInfo = `Mac OS X ${version}`;
      } else {
        deviceInfo = 'Mac OS';
      }
      isCurrentDevice = true;
    } else if (/Linux/i.test(userAgent)) {
      deviceInfo = 'Linux';
      isCurrentDevice = true;
    } else {
      deviceInfo = 'Unknown OS';
    }
    
    // Add browser information
  if (/Chrome/i.test(userAgent) && !/Chromium|Edge|Edg|OPR|Opera/i.test(userAgent)) {
      deviceInfo += ' - Chrome';
    } else if (/Firefox/i.test(userAgent)) {
      deviceInfo += ' - Firefox';
    } else if (/Safari/i.test(userAgent) && !/Chrome|Chromium|Edge|Edg|OPR|Opera/i.test(userAgent)) {
      deviceInfo += ' - Safari';
    } else if (/Edge|Edg/i.test(userAgent)) {
      deviceInfo += ' - Edge';
    } else if (/Opera|OPR/i.test(userAgent)) {
      deviceInfo += ' - Opera';
    }
  }
  
  // Set device info text
  document.getElementById('device-info').textContent = deviceInfo;
}

// Function to handle MAC address display
function handleMacAddress() {
  // Due to browser security restrictions, JavaScript cannot access the actual MAC address
  // We'll use a server-side approach with a fallback message
  
  <?php
  // Server-side attempt to get MAC address on Windows
  $mac_address = 'Not Available (Browser Security Restriction)';
  
  // Try to get MAC address on Windows systems
  if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    // Get the IP address
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    
    // Execute the ARP command
    $arpCommand = "arp -a $ipAddress";
    $output = [];
    exec($arpCommand, $output);
    
    // Parse the output to find the MAC address
    foreach ($output as $line) {
      if (strpos($line, $ipAddress) !== false) {
        $macPattern = '/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/i';
        if (preg_match($macPattern, $line, $matches)) {
          $mac_address = $matches[0];
          break;
        }
      }
    }
  }
  ?>
  
  document.getElementById('mac-address').textContent = '<?php echo $mac_address; ?>';
}

  // Function to handle the View More button for mobile devices
function handleViewMoreButton() {
  const glassEffect = document.querySelector('.glass-effect');
  const container = document.querySelector('.container');
  
  // Only add the button for mobile devices (width <= 570px)
  function checkScreenSize() {
    if (window.innerWidth <= 570) {
      // Initialize paragraph visibility for mobile view
      const paragraphs = glassEffect.querySelectorAll('p');
      paragraphs.forEach((p, index) => {
        if (index === 0) {
          p.style.display = 'block';
        } else {
          p.style.display = 'none';
        }
      });
      
      // If button doesn't exist yet, create it
      if (!document.querySelector('.view-more-btn')) {
        const viewMoreBtn = document.createElement('button');
        viewMoreBtn.className = 'view-more-btn';
        viewMoreBtn.textContent = 'View More';
        
        // Add click event to toggle expanded state
        viewMoreBtn.addEventListener('click', function() {
          glassEffect.classList.toggle('expanded');
          
          // Update button text based on expanded state
          if (glassEffect.classList.contains('expanded')) {
            viewMoreBtn.textContent = 'View Less';
            // Reset scroll position to top when expanding
            setTimeout(() => {
              glassEffect.scrollTop = 0;
            }, 50);
          } else {
            viewMoreBtn.textContent = 'View More';
          }
          
          // Show/hide paragraphs based on expanded state
          const paragraphs = glassEffect.querySelectorAll('p');
          if (glassEffect.classList.contains('expanded')) {
            // Show all paragraphs when expanded
            paragraphs.forEach(p => p.style.display = 'block');
          } else {
            // Hide all paragraphs except the first one when collapsed
            paragraphs.forEach((p, index) => {
              if (index === 0) {
                p.style.display = 'block';
              } else {
                p.style.display = 'none';
              }
            });
          }
        });
        glassEffect.appendChild(viewMoreBtn);
      }
    } else {
      // Remove button if screen is larger than 570px
      const viewMoreBtn = document.querySelector('.view-more-btn');
      if (viewMoreBtn) {
        viewMoreBtn.remove();
        
        // Reset glass-effect state when button is removed
        glassEffect.classList.remove('expanded');
      }
      
      // Always ensure all paragraphs are visible in desktop view
      // regardless of whether the button existed
      const paragraphs = glassEffect.querySelectorAll('p');
      paragraphs.forEach(p => p.style.display = 'block');
    
    }
  }
  
  // Check screen size on load and resize
  checkScreenSize();
  window.addEventListener('resize', checkScreenSize);
}

// Create initial elements
createFloatingElements();
updateTime();
setInterval(updateTime, 1000);
fetchLocation();
detectDevice();
displayUserAgent();
handleMacAddress();
handleViewMoreButton();

// Log security check initialization
console.log('Security checks initialized');
</script>
</body>
</html>
