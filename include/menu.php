<?php

session_start();
// hide all error
error_reporting(0);

if (!isset($_SESSION["mikhmon"])) {
  header("Location:../admin.php?id=login");
} else {

  include ('./include/version.php');

  $btnmenuactive = "font-weight: bold;background-color: #f9f9f9; color: #000000";
  if ($hotspot == "dashboard" || substr(end(explode("/", $url)), 0, 8) == "?session") {
    $shome = "active";
    $mpage = $_dashboard;
  } elseif ($hotspot == "quick-print" || $hotspot == "list-quick-print") {
    $squick = "active";
    $mpage = $_quick_print;   
  } elseif ($hotspot == "users" || $userbyprofile != "" || $hotspot == "export-users" || $removehotspotuserbycomment != "" || $removehotspotuser != "" || $removehotspotusers != "" || $disablehotspotuser || $enablehotspotuser != "") {
    $susersl = "active";
    $susers = "active";
    $mpage = $_users;
    $umenu = "menu-open";
  } elseif ($hotspotuser == "add") {
    $sadduser = "active";
    $mpage = $_users;
    $susers = "active";
    $umenu = "menu-open";
  } elseif ($hotspotuser == "generate") {
    $sgenuser = "active";
    $mpage = $_users;
    $susers = "active";
    $umenu = "menu-open";
  } elseif ($userbyname != ""  || $resethotspotuser != "") {
    $susers = "active";
    $mpage = $_users;
    $umenu = "menu-open";
  } elseif ($hotspot == "user-profiles") {
    $suserprofiles = "active";
    $suserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($hotspot == "active" || $removeuseractive != "") {
    $sactive = "active";
    $mpage = $_hotspot_active;
    $hamenu = "menu-open";
  } elseif ($hotspot == "hosts" || $hotspot == "hostp" || $hotspot == "hosta" || $removehost != "") {
    $shosts = "active";
    $mpage = $_hosts;
    $hmenu = "menu-open";
  } elseif ($hotspot == "dhcp-leases") {
    $slease = "active";
    $mpage = $_dhcp_leases;
  } elseif ($minterface == "traffic-monitor") {
    $strafficmonitor = "active";
    $mpage = $_traffic_monitor;  
  } elseif ($hotspot == "ipbinding" || $hotspot == "binding" || $removeipbinding != "" || $enableipbinding != "" || $disableipbinding != "") {
    $sipbind = "active";
    $mpage = $_ip_bindings;
    $ibmenu = "menu-open";
  } elseif ($hotspot == "template-editor") {
    $ssett = "active";
    $teditor = "active";
    $mpage = $_template_editor;
    $settmenu = "menu-open";
  } elseif ($hotspot == "uplogo") {
    $ssett = "active";
    $uplogo = "active";
    $mpage = $_upload_logo;
    $settmenu = "menu-open";
  } elseif ($hotspot == "cookies" || $removecookie != "") {
    $scookies = "active";
    $mpage = $_hotspot_cookies;
    $cmenu = "menu-open";
  } elseif ($hotspot == "log") {
    $log = "active";
    $slog = "active";
    $mpage = $_hotspot_log;
    $lmenu = "menu-open";
  } elseif ($report == "userlog") {
    $log = "active";
    $sulog = "active";
    $mpage = $_user_log;
    $lmenu = "menu-open";
  } elseif ($ppp == "secrets" || $ppp == "addsecret" || $enablesecr != "" || $disablesecr != "" || $removesecr != "" || $secretbyname != "") {
    $mppp = "active";
    $ssecrets = "active";
    $mpage = $_ppp_secrets;
    $pppmenu = "menu-open";
  } elseif ($ppp == "profiles" || $removepprofile != "" || $ppp == "add-profile" || $ppp == "edit-profile"  ) {
    $mppp = "active";
    $spprofile = "active";
    $mpage = $_ppp_profiles;
    $pppmenu = "menu-open";
  } elseif ($ppp == "active" || $removepactive != "") {
    $mppp = "active";
    $spactive = "active";
    $mpage = $_ppp_active;
    $pppmenu = "menu-open";
  } elseif ($sys == "scheduler" || $enablesch != "" || $disablesch != "" || $removesch != "") {
    $sysmenu = "active";
    $ssch = "active";
    $mpage = $_system_scheduler;
    $schmenu = "menu-open";
  } elseif ($report == "selling" || $report == "resume-report") {
    $sselling = "active";
    $mpage = $_report;
  } elseif ($userprofile == "add") {
    $suserprof = "active";
    $sadduserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($userprofilebyname != "") {
    $suserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($hotspot == "users-by-profile") {
    $susersbp = "active";
    $mpage = $_vouchers;
  } elseif ($userbyname != "") {
    $mpage = $_users;
    $susers = "active";
  } elseif ($hotspot == "about") {
    $mpage = $_about;
    $sabout = "active";
  } elseif ($id == "sessions" || $id == "remove" || $router == "new") {
    $ssesslist = "active";
    $mpage = $_admin_settings;
  } elseif ($id == "settings" && $session == "new") {
    $snsettings = "active";
    $mpage = $_add_router;
  } elseif ($id == "settings" || $id == "connect") {
    $ssettings = "active";
    $mpage = $_session_settings;
  } elseif ($id == "about") {
    $sabout = "active";
    $mpage = $_about;
  } elseif ($id == "uplogo") {
    $suplogo = "active";
    $mpage = $_upload_logo;
  } elseif ($id == "editor") {
    $seditor = "active";
    $mpage = $_template_editor;
  }
}

if($idleto != "disable"){
  $didleto = 'display:flex;';
}else{
  $didleto = 'display:none;';
}

// Get logged in username
$loggedUser = isset($_SESSION["mikhmon"]) ? $_SESSION["mikhmon"] : "Admin";
$userInitials = strtoupper(substr($loggedUser, 0, 2));
?>

<!-- Load Dark Mode CSS Only -->
<link rel="stylesheet" href="./css/menu-sidebar-dark.css">

<script>
// Toggle sidebar on mobile
function toggleSidebar() {
  const sidenav = document.getElementById('sidenav');
  const openNav = document.getElementById('openNav');
  const closeNav = document.getElementById('closeNav');
  
  if (sidenav.classList.contains('open')) {
    sidenav.classList.remove('open');
    openNav.style.display = 'flex';
    closeNav.style.display = 'none';
  } else {
    sidenav.classList.add('open');
    openNav.style.display = 'none';
    closeNav.style.display = 'flex';
  }
}

// Dropdown toggle functionality
document.addEventListener('DOMContentLoaded', function() {
  var dropdown = document.getElementsByClassName("dropdown-btn");
  
  for (var i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent && dropdownContent.classList.contains('dropdown-container')) {
        dropdownContent.classList.toggle('menu-open');
      }
    });
  }
  
  // Auto-expand active menu items
  var activeItems = document.querySelectorAll('.dropdown-container.menu-open');
  activeItems.forEach(function(item) {
    var btn = item.previousElementSibling;
    if (btn && btn.classList.contains('dropdown-btn')) {
      btn.classList.add('active');
    }
  });
});

// Update timer display
function updateTimer() {
  const timerElement = document.getElementById('timer');
  if (timerElement) {
    const idleTimeout = document.getElementById('idto');
    if (idleTimeout && idleTimeout.textContent !== 'disable') {
      // Add your timer logic here
    }
  }
}

// Start timer updates
if (document.getElementById('idto') && document.getElementById('idto').textContent !== 'disable') {
  setInterval(updateTimer, 1000);
}
</script>

<span style="display:none;" id="idto"><?= $idleto ;?></span>

<?php if ($id != "") { ?>

<div id="navbar" class="navbar">
  <div class="navbar-left">
    <a id="brand" href="javascript:void(0)">
      <i class="fa fa-wifi"></i> MIKHMON
    </a>
    <a id="openNav" href="javascript:void(0)" onclick="toggleSidebar()">
      <i class="fa fa-bars"></i>
    </a>
    <a id="closeNav" href="javascript:void(0)" onclick="toggleSidebar()">
      <i class="fa fa-times"></i>
    </a>
    <span id="cpage"><?= $mpage; ?></span>
  </div>
  <div class="navbar-right">
    <!-- Timer -->
    <div class="timer-display" style="<?= $didleto; ?>">
      <i class="fa fa-clock-o"></i>
      <span id="timer">00:00</span>
    </div>
    
    <!-- Language Selector -->
    <select class="slang ses" title="<?= $_language ?>">
      <option><?= $language ?></option>
      <?php 
        $fileList = glob('lang/*');
        foreach($fileList as $filename){
          if(is_file($filename)){
            $filename = substr(explode("/",$filename)[1],0,-4);
            if($filename == "isocodelang"){}else{
              echo '<option value="'.$url.'&setlang=' . $filename . '">'. $isocodelang[$filename]. '</option>'; 
           }   
          }
        }
      ?>
    </select>
    
    <!-- User Profile -->
    <div class="user-profile" title="<?= $loggedUser ?>">
      <div class="user-avatar"><?= $userInitials ?></div>
      <div class="user-info">
        <div class="user-name"><?= $loggedUser ?></div>
        <div class="user-role">Administrator</div>
      </div>
    </div>
    
    <!-- Logout -->
    <a id="logout" href="./admin.php?id=logout" title="<?= $_logout ?>">
      <i class="fa fa-sign-out"></i>
      <span><?= $_logout ?></span>
    </a>
  </div>
</div>

<div id="sidenav" class="sidenav">
<?php if (($id == "settings" && $session == "new") || $id == "settings" && $router == "new") {
}else if ($id == "settings" || $id == "editor"|| $id == "uplogo" || $id == "connect"){
?>  
  <div class="card-header">
    <h3 id="MikhmonSession"><?= $session; ?></h3>
  </div>
  <a class="connect menu <?= $shome; ?>" id="<?= $session; ?>&c=settings">
    <i class='fa fa-tachometer'></i> <?= $_dashboard ?>
  </a>
  <a href="./admin.php?id=settings&session=<?= $session; ?>" class="menu <?= $ssettings; ?>" title="Mikhmon Settings">
    <i class='fa fa-gear'></i> <?= $_session_settings ?>
  </a>
  <a href="./admin.php?id=uplogo&session=<?= $session; ?>" class="menu <?= $suplogo; ?>">
    <i class="fa fa-upload"></i> <?= $_upload_logo ?>
  </a>
  <a href="./admin.php?id=editor&template=default&session=<?= $session; ?>" class="menu <?= $seditor; ?>">
    <i class="fa fa-edit"></i> <?= $_template_editor ?>
  </a>
  <div class="menu spa"></div>
<?php 
} ?>  
  <a href="./admin.php?id=sessions" class="menu <?= $ssesslist; ?>">
    <i class="fa fa-gear"></i> <?= $_admin_settings ?>
  </a>
  <a href="./admin.php?id=settings&router=new-<?= rand(1111,9999) ?>" class="menu <?= $snsettings ?>">
    <i class="fa fa-plus"></i> <?= $_add_router ?>
  </a>
  <a href="./admin.php?id=about" class="menu <?= $sabout; ?>">
    <i class="fa fa-info-circle"></i> <?= $_about ?>
  </a>
</div>

<script>
$(document).ready(function(){
  $(".connect").click(function(){
    notify("<?= $_connecting ?>");
    connect(this.id)
  });
  $(".slang").change(function(){
    notify("<?= $_loading ?>");
    stheme(this.value)
  });
});
</script>
<div id="notify"><div class="message"></div></div>
<div id="temp"></div>
<?php 
include('./info.php');
} else { ?>

<div id="navbar" class="navbar">
  <div class="navbar-left">
    <a id="brand" href="./?session=<?= $session; ?>">
      <i class="fa fa-wifi"></i> MIKHMON
    </a>
    <a id="openNav" href="javascript:void(0)" onclick="toggleSidebar()">
      <i class="fa fa-bars"></i>
    </a>
    <a id="closeNav" href="javascript:void(0)" onclick="toggleSidebar()">
      <i class="fa fa-times"></i>
    </a>
    <span id="cpage"><?= $mpage; ?></span>
  </div>
  <div class="navbar-right">
    <!-- Timer -->
    <div class="timer-display" style="<?= $didleto; ?>">
      <i class="fa fa-clock-o"></i>
      <span id="timer">00:00</span>
    </div>
    
    <!-- Session Selector -->
    <select class="connect optfa ses" title="Switch Session">
      <option id="MikhmonSession" value="<?= $session; ?>"><?= $hotspotname; ?></option>
        <?php
        foreach (file('./include/config.php') as $line) {
          $sesname = explode("'", $line)[1];
          if ($sesname == "" || $sesname== "mikhmon") {
          } else {
          if($sesname == $session){
            echo '<option value="' . $sesname. '">'.$sesname. ' ●</option>';
          }else{
            echo '<option value="' . $sesname. '">'.$sesname. '</option>';
          }
          }
        }
        ?>
    </select>
    
    <!-- User Profile -->
    <div class="user-profile" title="<?= $loggedUser ?>">
      <div class="user-avatar"><?= $userInitials ?></div>
      <div class="user-info">
        <div class="user-name"><?= $loggedUser ?></div>
        <div class="user-role">Administrator</div>
      </div>
    </div>
    
    <!-- Logout -->
    <a id="logout" href="./?hotspot=logout&session=<?= $session; ?>" title="<?= $_logout ?>">
      <i class="fa fa-sign-out"></i>
      <span><?= $_logout ?></span>
    </a>
  </div>
</div>

<div id="sidenav" class="sidenav">
  <div class="card-header">
    <h3><?= $identity; ?></h3>
  </div>
  
  <!-- Dashboard -->
  <a href="./?session=<?= $session; ?>" class="menu <?= $shome; ?>">
    <i class="fa fa-dashboard"></i> <?= $_dashboard ?>
  </a>
  
  <!-- Hotspot -->
  <button class="dropdown-btn <?= $susers . $suserprof . $sactive . $shosts . $sipbind . $scookies; ?>">
    <i class="fa fa-wifi"></i> Hotspot
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container <?= $umenu . $upmenu . $hamenu . $hmenu . $ibmenu . $cmenu; ?>">
    <!-- Users -->
    <button class="dropdown-btn <?= $susers; ?>">
      <i class="fa fa-users"></i> <?= $_users ?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container <?= $umenu; ?>">
      <a href="./?hotspot=users&profile=all&session=<?= $session; ?>" class="<?= $susersl; ?>">
        <i class="fa fa-list"></i> <?= $_user_list ?>
      </a>
      <a href="./?hotspot-user=add&session=<?= $session; ?>" class="<?= $sadduser; ?>">
        <i class="fa fa-user-plus"></i> <?= $_add_user ?>
      </a>
      <a href="./?hotspot-user=generate&session=<?= $session; ?>" class="<?= $sgenuser; ?>">
        <i class="fa fa-user-plus"></i> <?= $_generate ?>
      </a>        
    </div>
    
    <!-- Profile -->
    <button class="dropdown-btn <?= $suserprof; ?>">
      <i class="fa fa-pie-chart"></i> <?= $_user_profile ?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container <?= $upmenu; ?>">
      <a href="./?hotspot=user-profiles&session=<?= $session; ?>" class="<?= $suserprofiles; ?>">
        <i class="fa fa-list"></i> <?= $_user_profile_list ?>
      </a>
      <a href="./?user-profile=add&session=<?= $session; ?>" class="<?= $sadduserprof; ?>">
        <i class="fa fa-plus-square"></i> <?= $_add_user_profile ?>
      </a>
    </div>
    
    <!-- Active -->
    <a href="./?hotspot=active&session=<?= $session; ?>" class="<?= $sactive; ?>">
      <i class="fa fa-wifi"></i> <?= $_hotspot_active ?>
    </a>
    
    <!-- Hosts -->
    <a href="./?hotspot=hosts&session=<?= $session; ?>" class="<?= $shosts; ?>">
      <i class="fa fa-laptop"></i> <?= $_hosts ?>
    </a>
    
    <!-- IP Bindings -->
    <a href="./?hotspot=ipbinding&session=<?= $session; ?>" class="<?= $sipbind; ?>">
      <i class="fa fa-address-book"></i> <?= $_ip_bindings ?>
    </a>
    
    <!-- Cookies -->
    <a href="./?hotspot=cookies&session=<?= $session; ?>" class="<?= $scookies; ?>">
      <i class="fa fa-hourglass"></i> <?= $_hotspot_cookies ?>
    </a>
  </div>
  
  <!-- Quick Print -->
  <a href="./?hotspot=quick-print&session=<?= $session; ?>" class="menu <?= $squick; ?>">
    <i class="fa fa-print"></i> <?= $_quick_print ?>
  </a>
  
  <!-- Vouchers -->
  <a href="./?hotspot=users-by-profile&session=<?= $session; ?>" class="menu <?= $susersbp; ?>">
    <i class="fa fa-ticket"></i> <?= $_vouchers ?>
  </a>
  
  <!-- Log -->
  <button class="dropdown-btn <?= $log; ?>">
    <i class="fa fa-align-justify"></i> <?= $_log ?>
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container <?= $lmenu; ?>">
    <a href="./?hotspot=log&session=<?= $session; ?>" class="<?= $slog; ?>">
      <i class="fa fa-wifi"></i> <?= $_hotspot_log ?>
    </a>
    <a href="./?report=userlog&idbl=<?= strtolower(date("M")) . date("Y"); ?>&session=<?= $session; ?>" class="<?= $sulog; ?>">
      <i class="fa fa-users"></i> <?= $_user_log ?>
    </a>
  </div>
  
  <!-- System -->
  <button class="dropdown-btn <?= $sysmenu; ?>">
    <i class="fa fa-gear"></i> <?= $_system ?>
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container <?= $schmenu; ?>">
    <a href="./?system=scheduler&session=<?= $session; ?>" class="<?= $ssch; ?>">
      <i class="fa fa-clock-o"></i> <?= $_system_scheduler ?>
    </a>
    <a href="./admin.php?id=reboot&session=<?= $session; ?>">
      <i class="fa fa-power-off"></i> <?= $_system_reboot ?>
    </a>            
    <a href="./admin.php?id=shutdown&session=<?= $session; ?>">
      <i class="fa fa-power-off"></i> <?= $_system_off ?>
    </a> 
  </div>
  
  <!-- DHCP Leases -->
  <a href="./?hotspot=dhcp-leases&session=<?= $session; ?>" class="menu <?= $slease; ?>">
    <i class="fa fa-sitemap"></i> <?= $_dhcp_leases ?>
  </a>
  
  <!-- Traffic Monitor -->
  <a href="./?interface=traffic-monitor&session=<?= $session; ?>" class="menu <?= $strafficmonitor; ?>">
    <i class="fa fa-area-chart"></i> <?= $_traffic_monitor ?>
  </a>
  
  <!-- Report -->
  <a href="./?report=selling&idbl=<?= strtolower(date("M")) . date("Y"); ?>&session=<?= $session; ?>" class="menu <?= $sselling; ?>">
    <i class="fa fa-money"></i> <?= $_report ?>
  </a>
  
  <!-- Settings -->
  <button class="dropdown-btn <?= $ssett; ?>">
    <i class="fa fa-gear"></i> <?= $_settings ?> 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container <?= $settmenu; ?>">
    <a href="./admin.php?id=settings&session=<?= $session; ?>">
      <i class="fa fa-gear"></i> <?= $_session_settings ?>
    </a>
    <a href="./admin.php?id=sessions">
      <i class="fa fa-gear"></i> <?= $_admin_settings ?>
    </a>
    <a href="./?hotspot=uplogo&session=<?= $session; ?>" class="<?= $uplogo; ?>">
      <i class="fa fa-upload"></i> <?= $_upload_logo ?>
    </a>
    <a href="./?hotspot=template-editor&template=default&session=<?= $session; ?>" class="<?= $teditor; ?>">
      <i class="fa fa-edit"></i> <?= $_template_editor ?>
    </a>          
  </div>
  
  <!-- About -->
  <a href="./?hotspot=about&session=<?= $session; ?>" class="menu <?= $sabout; ?>">
    <i class="fa fa-info-circle"></i> <?= $_about ?>
  </a>
</div>

<script>
$(document).ready(function(){
  $(".connect").change(function(){
    notify("<?= $_connecting ?>");
    connect(this.value)
  });
});
</script>
<div id="notify"><div class="message"></div></div>
<div id="temp"></div>
<?php 
include('./include/info.php');
} ?>

<div id="main">  
<div id="loading" class="lds-dual-ring"></div>
<?php if($hotspot == 'template-editor' || $id == 'editor'){
echo '<div class="main-container">';
}else{
  echo '<div class="main-container" style="display:none">';
}
?>