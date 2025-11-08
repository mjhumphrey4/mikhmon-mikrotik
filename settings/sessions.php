<?php

// hide all error
error_reporting(0);
if (!isset($_SESSION["mikhmon"])) {
  header("Location:../admin.php?id=login");
} else {

// array color
  $color = array('1' => 'bg-blue', 'bg-indigo', 'bg-purple', 'bg-pink', 'bg-red', 'bg-yellow', 'bg-green', 'bg-teal', 'bg-cyan', 'bg-grey', 'bg-light-blue');

  if (isset($_POST['save'])) {

    $suseradm = ($_POST['useradm']);
    $spassadm = encrypt($_POST['passadm']);
    $logobt = ($_POST['logobt']);
    $qrbt = ($_POST['qrbt']);

    $cari = array('1' => "mikhmon<|<$useradm", "mikhmon>|>$passadm");
    $ganti = array('1' => "mikhmon<|<$suseradm", "mikhmon>|>$spassadm");

    for ($i = 1; $i < 3; $i++) {
      $file = file("./include/config.php");
      $content = file_get_contents("./include/config.php");
      $newcontent = str_replace((string)$cari[$i], (string)$ganti[$i], "$content");
      file_put_contents("./include/config.php", "$newcontent");
    }

  
  $gen = '<?php $qrbt="' . $qrbt . '";?>';
          $key = './include/quickbt.php';
          $handle = fopen($key, 'w') or die('Cannot open file:  ' . $key);
          $data = $gen;
          fwrite($handle, $data);
    echo "<script>window.location='./admin.php?id=sessions'</script>";
  }

}
?>

<!-- Load CSS based on theme -->
<link rel="stylesheet" href="./css/sessions.css" id="theme-stylesheet">

<script>
  function Pass(id){
    var x = document.getElementById(id);
    if (x.type === 'password') {
    x.type = 'text';
    } else {
    x.type = 'password';
    }}
    
  function openAddRouterModal() {
    document.getElementById('addRouterModal').classList.add('active');
  }
  
  function closeAddRouterModal() {
    document.getElementById('addRouterModal').classList.remove('active');
  }
  
  // Close modal when clicking outside
  document.addEventListener('click', function(event) {
    const modal = document.getElementById('addRouterModal');
    if (event.target === modal) {
      closeAddRouterModal();
    }
  });
  
  // Theme Toggle Functionality
  function toggleTheme() {
    const stylesheet = document.getElementById('theme-stylesheet');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    if (currentTheme === 'light') {
      stylesheet.href = './css/sessions-dark.css';
      themeIcon.className = 'fa fa-sun';
      localStorage.setItem('theme', 'dark');
    } else {
      stylesheet.href = './css/sessions.css';
      themeIcon.className = 'fa fa-moon';
      localStorage.setItem('theme', 'light');
    }
  }
  
  // Load saved theme on page load
  document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    const stylesheet = document.getElementById('theme-stylesheet');
    const themeIcon = document.getElementById('theme-icon');
    
    if (savedTheme === 'dark') {
      stylesheet.href = './css/sessions-dark.css';
      themeIcon.className = 'fa fa-sun';
    } else {
      stylesheet.href = './css/sessions.css';
      themeIcon.className = 'fa fa-moon';
    }
  });
</script>

<!-- Theme Toggle Button -->
<button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
  <i class="fa fa-moon" id="theme-icon"></i>
</button>

<!-- Page Header -->
<div class="sessions-header">
  <div class="sessions-title">
    <h2><?= $_admin_settings ?></h2>
    <p class="sessions-subtitle">Manage and monitor your network routers</p>
  </div>
  <button class="btn-add-router" onclick="openAddRouterModal()">
    <i class="fa fa-plus"></i>
    Adopt New Router
  </button>
</div>

<!-- Available Routers Section -->
<div class="routers-section">
  <h3 class="section-title">Available Routers</h3>
  <div class="routers-grid">
    <?php
    foreach (file('./include/config.php') as $line) {
      $value = explode("'", $line)[1];
      if ($value == "" || $value == "mikhmon") {
      } else { 
        $hotspotName = explode('%', $data[$value][4])[1];
        $sessionName = $value;
        
        // Determine status (you can add logic here based on your needs)
        $statusClass = 'status-online';
        $statusText = 'Online';
    ?>
        <div class="router-card">
          <div class="router-menu">
            <i class="fa fa-ellipsis-v"></i>
          </div>
          
          <div class="router-header">
            <div class="router-icon">
              <i class="fa fa-server"></i>
            </div>
            <div class="router-info">
              <h3><?= $hotspotName ?></h3>
              <p><?= $sessionName ?></p>
            </div>
          </div>
          
          <div class="router-details">
            <div class="detail-item">
              <span class="detail-label">Status</span>
              <span class="detail-value <?= $statusClass ?>"><?= $statusText ?></span>
            </div>
            <div class="detail-item">
              <span class="detail-label">IP Address</span>
              <span class="detail-value">192.168.1.1</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Connected Devices</span>
              <span class="detail-value">24</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Uptime</span>
              <span class="detail-value">15 days</span>
            </div>
          </div>
          
          <div class="router-actions">
            <button class="btn-manage connect pointer" id="<?= $value; ?>">
              <i class="fa fa-external-link"></i> Open
            </button>
            <a href="./admin.php?id=settings&session=<?= $value; ?>" style="flex: 1; text-decoration: none;">
              <button class="btn-manage" style="width: 100%;">
                <i class="fa fa-edit"></i> Edit
              </button>
            </a>
            <button class="btn-manage" onclick="if(confirm('Are you sure to delete data <?= $value; echo ' (' . $hotspotName . ')'; ?>?')){loadpage('./admin.php?id=remove-session&session=<?= $value; ?>')}else{}" style="border-color: #ef4444; color: #ef4444;">
              <i class="fa fa-remove"></i>
            </button>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
</div>

<!-- Admin Settings Section -->
<div class="routers-section">
  <h3 class="section-title"><i class="fa fa-user-circle"></i> <?= $_admin ?> Settings</h3>
  <div class="admin-settings-card">
    <form autocomplete="off" method="post" action="">
      <div class="settings-form-group">
        <label class="settings-label"><?= $_user_name ?></label>
        <input class="settings-input" id="useradm" type="text" name="useradm" title="User Admin" value="<?= $useradm; ?>" required="1"/>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label"><?= $_password ?></label>
        <div class="password-wrapper">
          <input class="settings-input" id="passadm" type="password" name="passadm" title="Password Admin" value="<?= decrypt($passadm); ?>" required="1" style="padding-right: 45px;"/>
          <span class="password-toggle" onclick="Pass('passadm')">
            <i class="fa fa-eye"></i>
          </span>
        </div>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label"><?= $_quick_print ?> QR</label>
        <select class="settings-input" name="qrbt">
          <option><?= $qrbt ?></option>
          <option>enable</option>
          <option>disable</option>
        </select>
      </div>
      
      <div class="settings-actions">
        <button class="btn-save" type="submit" name="save">
          <i class="fa fa-save"></i> <?= $_save ?>
        </button>
        <button class="btn-reload" type="button" onclick="location.reload();">
          <i class="fa fa-refresh"></i>
        </button>
      </div>
      
      <div class="version-info">
        <div id="loadV">v<?= $_SESSION['v']; ?></div>
        <div><b id="newVer" class="text-green"></b></div>
      </div>
    </form>
  </div>
</div>

<!-- Add Router Modal -->
<div class="modal-overlay" id="addRouterModal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">Adopt New Router</h3>
      <button class="modal-close" onclick="closeAddRouterModal()">
        <i class="fa fa-times"></i>
      </button>
    </div>
    
    <form autocomplete="off" method="post" action="">
      <div class="settings-form-group">
        <label class="settings-label">Router Name</label>
        <input class="settings-input" type="text" name="router_name" placeholder="Enter router name" required/>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label">IP Address</label>
        <input class="settings-input" type="text" name="ip_address" placeholder="192.168.1.1" required/>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label">Username</label>
        <input class="settings-input" type="text" name="router_username" placeholder="admin" required/>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label">Password</label>
        <input class="settings-input" type="password" name="router_password" placeholder="Enter password" required/>
      </div>
      
      <div class="settings-form-group">
        <label class="settings-label">Port</label>
        <input class="settings-input" type="text" name="router_port" placeholder="8728" value="8728"/>
      </div>
      
      <div class="settings-actions">
        <button class="btn-save" type="submit" name="add_router">
          <i class="fa fa-check"></i> Add Router
        </button>
        <button class="btn-reload" type="button" onclick="closeAddRouterModal()">
          Cancel
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  var _0x7470=["\x68\x6F\x73\x74\x6E\x61\x6D\x65","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x2E","\x73\x70\x6C\x69\x74","\x6D\x69\x6B\x68\x6D\x6F\x6E\x2E\x6F\x6E\x6C\x69\x6E\x65","\x78\x62\x61\x6E\x2E\x78\x79\x7A","\x6C\x6F\x67\x61\x6D\x2E\x69\x64","\x6D\x69\x6E\x69\x73\x2E\x69\x64","\x69\x6E\x64\x65\x78\x4F\x66","\x3C\x73\x70\x61\x6E\x20\x3E\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x65\x78\x74\x2D\x77\x68\x69\x74\x65\x20\x66\x61\x20\x66\x61\x2D\x69\x6E\x66\x6F\x2D\x63\x69\x72\x63\x6C\x65\x22\x3E\x3C\x2F\x69\x3E\x20\x3C\x61\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x65\x78\x74\x2D\x62\x6C\x75\x65\x22\x20\x68\x72\x65\x66\x3D\x22\x2E\x2F\x61\x64\x6D\x69\x6E\x2E\x70\x68\x70\x3F\x69\x64\x3D\x61\x62\x6F\x75\x74\x22\x3E\x43\x68\x65\x63\x6B\x20\x55\x70\x64\x61\x74\x65\x3C\x2F\x61\x3E\x3C\x2F\x73\x70\x61\x6E\x3E","\x68\x74\x6D\x6C","\x23\x6E\x65\x77\x56\x65\x72","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x72\x61\x77\x2E\x67\x69\x74\x68\x75\x62\x75\x73\x65\x72\x63\x6F\x6E\x74\x65\x6E\x74\x2E\x63\x6F\x6D\x2F\x6C\x61\x6B\x73\x61\x31\x39\x2F\x6D\x69\x6B\x68\x6D\x6F\x6E\x76\x33\x2F\x6D\x61\x73\x74\x65\x72\x2F\x76\x65\x72\x73\x69\x6F\x6E\x2E\x74\x78\x74\x3F\x74\x3D","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x76","\x76\x65\x72\x73\x69\x6F\x6E","","\x72\x65\x70\x6C\x61\x63\x65","\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x6C\x6F\x61\x64\x56","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x20","\x75\x70\x64\x61\x74\x65\x64","\x2D","\x4E\x65\x77\x20\x56\x65\x72\x73\x69\x6F\x6E\x20","\x3C\x62\x72\x3E\x3C\x73\x70\x61\x6E\x20\x3E\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x65\x78\x74\x2D\x77\x68\x69\x74\x65\x20\x66\x61\x20\x66\x61\x2D\x69\x6E\x66\x6F\x2D\x63\x69\x72\x63\x6C\x65\x22\x3E\x3C\x2F\x69\x3E\x20\x3C\x61\x20\x63\x6C\x61\x73\x73\x3D\x22\x74\x65\x78\x74\x2D\x62\x6C\x75\x65\x22\x20\x68\x72\x65\x66\x3D\x22\x2E\x2F\x61\x64\x6D\x69\x6E\x2E\x70\x68\x70\x3F\x69\x64\x3D\x61\x62\x6F\x75\x74\x22\x3E\x43\x68\x65\x63\x6B\x20\x55\x70\x64\x61\x74\x65\x3C\x2F\x61\x3E\x3C\x2F\x73\x70\x61\x6E\x3E","\x67\x65\x74\x4A\x53\x4F\x4E"];var hname=window[_0x7470[1]][_0x7470[0]];var dom=hname[_0x7470[3]](_0x7470[2])[1]+ _0x7470[2]+ hname[_0x7470[3]](_0x7470[2])[2];var domArray=[_0x7470[4],_0x7470[5],_0x7470[6],_0x7470[7]];var a=domArray[_0x7470[8]](hname);var b=domArray[_0x7470[8]](dom);if(dom== _0x7470[4]){$(_0x7470[11])[_0x7470[10]](_0x7470[9])}else {if(a> 0|| b> 0){}else {$[_0x7470[27]](_0x7470[12]+ (Math[_0x7470[14]]((Math[_0x7470[13]]()* 999999999)+ 1))* 128,function(_0xc1b4x6){getNewVer= (_0xc1b4x6[_0x7470[16]])[_0x7470[3]](_0x7470[15])[1];var _0xc1b4x7=parseInt(getNewVer[_0x7470[18]](_0x7470[2],_0x7470[17]));var _0xc1b4x8=document[_0x7470[21]](_0x7470[20])[_0x7470[19]];var _0xc1b4x9=(_0xc1b4x8[_0x7470[3]](_0x7470[22])[0])[_0x7470[3]](_0x7470[15])[1];var _0xc1b4xa=parseInt(_0xc1b4x9[_0x7470[18]](_0x7470[2],_0x7470[17]));var _0xc1b4xb=(_0xc1b4x7- _0xc1b4xa);getNewVer= (_0xc1b4x6[_0x7470[16]])[_0x7470[3]](_0x7470[15])[1];var _0xc1b4x7=parseInt(getNewVer[_0x7470[18]](_0x7470[2],_0x7470[17]));var _0xc1b4x8=document[_0x7470[21]](_0x7470[20])[_0x7470[19]];var _0xc1b4x9=(_0xc1b4x8[_0x7470[3]](_0x7470[22])[0])[_0x7470[3]](_0x7470[15])[1];var _0xc1b4xa=parseInt(_0xc1b4x9[_0x7470[18]](_0x7470[2],_0x7470[17]));var _0xc1b4xb=(_0xc1b4x7- _0xc1b4xa);getNewD= (_0xc1b4x6[_0x7470[23]])[_0x7470[3]](_0x7470[22])[0];newD= parseInt((getNewD)[_0x7470[3]](_0x7470[24])[2]+ (getNewD)[_0x7470[3]](_0x7470[24])[0]+ (getNewD)[_0x7470[3]](_0x7470[24])[1]);var _0xc1b4xc=parseInt((_0xc1b4x8[_0x7470[3]](_0x7470[22])[1])[_0x7470[3]](_0x7470[24])[2]+ (_0xc1b4x8[_0x7470[3]](_0x7470[22])[1])[_0x7470[3]](_0x7470[24])[0]+ (_0xc1b4x8[_0x7470[3]](_0x7470[22])[1][_0x7470[3]](_0x7470[24]))[1]);var _0xc1b4xd=(newD- _0xc1b4xc);if(_0xc1b4xb> 0|| _0xc1b4xd> 0){$(_0x7470[11])[_0x7470[10]](_0x7470[25]+ _0xc1b4x6[_0x7470[16]]+ _0x7470[22]+ _0xc1b4x6[_0x7470[23]]+ _0x7470[26])}})}}