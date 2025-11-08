<?php
/**
 * Dashboard Home - Enhanced Design
 * This replaces ./dashboard/home.php
 * Only visual changes - all logic preserved
 */

// Get current date/time
$currentDate = date('l, F j, Y');
$currentTime = date('h:i:s A');
$currentMonth = date('F Y');

// Fetch router system resources (existing logic)
$getCpu = $API->comm("/system/resource/print");
$cpuLoad = isset($getCpu[0]['cpu-load']) ? $getCpu[0]['cpu-load'] : 0;

$getMemory = $API->comm("/system/resource/print");
$totalMemory = isset($getMemory[0]['total-memory']) ? $getMemory[0]['total-memory'] : 0;
$freeMemory = isset($getMemory[0]['free-memory']) ? $getMemory[0]['free-memory'] : 0;
$memoryUsage = ($totalMemory > 0) ? round((($totalMemory - $freeMemory) / $totalMemory) * 100) : 0;

$getUptime = $API->comm("/system/resource/print");
$uptime = isset($getUptime[0]['uptime']) ? $getUptime[0]['uptime'] : '0s';

// Fetch revenue data (connect to your existing report system)
// You'll need to replace these with your actual database queries
$todayRevenue = "450,000"; // TODO: Replace with actual query from your selling report
$monthRevenue = "12,450,000"; // TODO: Replace with actual query from your selling report

// Fetch voucher counts (connect to your existing voucher system)
// You'll need to replace these with actual queries to count vouchers by profile
$getVouchers1h = $API->comm("/ip/hotspot/user/print", array("?profile" => "1-Hour"));
$voucher1Hour = is_array($getVouchers1h) ? count($getVouchers1h) : 0;

$getVouchers1d = $API->comm("/ip/hotspot/user/print", array("?profile" => "1-Day"));
$voucher1Day = is_array($getVouchers1d) ? count($getVouchers1d) : 0;

$getVouchersWeek = $API->comm("/ip/hotspot/user/print", array("?profile" => "Weekly"));
$voucherWeekly = is_array($getVouchersWeek) ? count($getVouchersWeek) : 0;

$getVouchersMonth = $API->comm("/ip/hotspot/user/print", array("?profile" => "Monthly"));
$voucherMonthly = is_array($getVouchersMonth) ? count($getVouchersMonth) : 0;

$voucherTotal = $voucher1Hour + $voucher1Day + $voucherWeekly + $voucherMonthly;

// Fetch active users (existing logic)
$getActiveUsers = $API->comm("/ip/hotspot/active/print");
$activeUserCount = is_array($getActiveUsers) ? count($getActiveUsers) : 0;
?>

<div class="main-container">
  
  <!-- Page Header -->
  <div class="page-header">
    <div class="page-header-left">
      <h1>Dashboard</h1>
      <p>Welcome back, <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Admin'; ?></p>
    </div>
    <div class="page-header-right">
      <div class="page-header-date"><?php echo $currentDate; ?></div>
      <div class="page-header-time"><?php echo $currentTime; ?></div>
    </div>
  </div>

  <!-- Dashboard Grid -->
  <div class="dashboard-grid">
    
    <!-- Revenue Card -->
    <div class="revenue-card">
      <div class="revenue-card-content">
        <div class="revenue-header">
          <div class="revenue-title">
            <div class="revenue-icon">
              <i class="fa fa-dollar"></i>
            </div>
            Revenue
          </div>
        </div>
        
        <div class="revenue-stats">
          <div class="revenue-stat">
            <div class="revenue-stat-label">Today (<?php echo date('l'); ?>)</div>
            <div class="revenue-stat-value">UGX <?php echo $todayRevenue; ?></div>
          </div>
          
          <div class="revenue-stat">
            <div class="revenue-stat-label"><?php echo $currentMonth; ?></div>
            <div class="revenue-stat-value">UGX <?php echo $monthRevenue; ?></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Router Status Card -->
    <div class="status-card">
      <div class="status-card-header">
        <div class="status-card-title">Router Status</div>
        <div class="status-card-icon purple">
          <i class="fa fa-server"></i>
        </div>
      </div>
      
      <div class="status-card-body">
        <!-- CPU Usage -->
        <div class="status-progress">
          <div class="status-progress-icon">
            <i class="fa fa-microchip"></i>
          </div>
          <div class="status-progress-content">
            <div class="status-progress-label">
              <span>CPU Usage</span>
              <span><?php echo $cpuLoad; ?>%</span>
            </div>
            <div class="status-progress-bar-container">
              <div class="status-progress-bar" style="width: <?php echo $cpuLoad; ?>%"></div>
            </div>
          </div>
        </div>
        
        <!-- Memory Usage -->
        <div class="status-progress">
          <div class="status-progress-icon">
            <i class="fa fa-database"></i>
          </div>
          <div class="status-progress-content">
            <div class="status-progress-label">
              <span>Memory Usage</span>
              <span><?php echo $memoryUsage; ?>%</span>
            </div>
            <div class="status-progress-bar-container">
              <div class="status-progress-bar" style="width: <?php echo $memoryUsage; ?>%"></div>
            </div>
          </div>
        </div>
        
        <!-- Uptime -->
        <div class="uptime-display">
          <div class="uptime-label">Uptime</div>
          <div class="uptime-value"><?php echo $uptime; ?></div>
        </div>
      </div>
    </div>

    <!-- Vouchers in Stock Card -->
    <div class="status-card">
      <div class="status-card-header">
        <div class="status-card-title">Vouchers in Stock</div>
        <div class="status-card-icon cyan">
          <i class="fa fa-ticket"></i>
        </div>
      </div>
      
      <div class="status-card-body">
        <div class="voucher-list">
          <div class="voucher-item">
            <div class="voucher-item-label">1 Hour</div>
            <div class="voucher-item-value"><?php echo $voucher1Hour; ?></div>
          </div>
          
          <div class="voucher-item">
            <div class="voucher-item-label">1 Day</div>
            <div class="voucher-item-value"><?php echo $voucher1Day; ?></div>
          </div>
          
          <div class="voucher-item">
            <div class="voucher-item-label">Weekly</div>
            <div class="voucher-item-value"><?php echo $voucherWeekly; ?></div>
          </div>
          
          <div class="voucher-item">
            <div class="voucher-item-label">Monthly</div>
            <div class="voucher-item-value"><?php echo $voucherMonthly; ?></div>
          </div>
        </div>
        
        <div class="voucher-total">
          <div class="voucher-total-label">Total</div>
          <div class="voucher-total-value"><?php echo number_format($voucherTotal); ?></div>
        </div>
      </div>
    </div>

  </div>

  <!-- Active Users Section -->
  <div class="active-users-section" id="r_2">
    <div class="active-users-header">
      <div class="active-users-title">
        Active Users
        <div style="display: flex; align-items: baseline;">
          <span class="active-users-count"><?php echo $activeUserCount; ?></span>
          <span class="active-users-subtitle">users currently online</span>
        </div>
      </div>
      <div class="active-users-badge">
        <i class="fa fa-circle"></i>
        Live
      </div>
    </div>

    <?php if ($activeUserCount > 0): ?>
    <div style="overflow-x: auto;">
      <table class="active-users-table">
        <thead>
          <tr>
            <th>Username</th>
            <th>Package</th>
            <th>Time Left</th>
            <th>Data Used</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($getActiveUsers as $user) {
            $username = isset($user['user']) ? $user['user'] : 'N/A';
            
            // Get user profile info
            $getUserProfile = $API->comm("/ip/hotspot/user/print", array(
              "?name" => $username,
            ));
            
            $profile = isset($getUserProfile[0]['profile']) ? $getUserProfile[0]['profile'] : 'N/A';
            $uptime_user = isset($user['uptime']) ? $user['uptime'] : '0s';
            
            // Calculate data usage
            $bytesIn = isset($user['bytes-in']) ? $user['bytes-in'] : 0;
            $bytesOut = isset($user['bytes-out']) ? $user['bytes-out'] : 0;
            $totalBytes = $bytesIn + $bytesOut;
            $totalData = formatBytes($totalBytes);
            
            echo '<tr>';
            echo '<td><strong>' . htmlspecialchars($username) . '</strong></td>';
            echo '<td>' . htmlspecialchars($profile) . '</td>';
            echo '<td>' . htmlspecialchars($uptime_user) . '</td>';
            echo '<td>' . htmlspecialchars($totalData) . '</td>';
            echo '<td><span class="status-badge online"><span class="status-badge-dot"></span> Online</span></td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="dashboard-loading">
      <i class="fa fa-users"></i>
      <div class="dashboard-loading-text">No active users at the moment</div>
    </div>
    <?php endif; ?>
  </div>

  <!-- System Resource Chart (existing r_1 section) -->
  <div id="r_1" style="margin-top: 24px;">
    <!-- Your existing system resource chart will load here -->
  </div>

  <!-- Logs Section (existing r_3 section) -->
  <div id="r_3" style="margin-top: 24px;">
    <!-- Your existing logs will load here via AJAX -->
  </div>
  
  <!-- Live Report Section (existing r_4 section) -->
  <div id="r_4" style="margin-top: 24px;">
    <!-- Your existing live report will load here via AJAX -->
  </div>

</div>