<?php
include "header.php";
include "leftside.php";

function getDbConnection()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    return $conn;
}

function calculateTotalSales($conn, $sessionIdA)
{
    $query = "SELECT sanpham_gia, quantitys FROM tbl_carta WHERE session_idA = '$sessionIdA'";
    $result = $conn->query($query);
    $totalSales = 0;

    while ($row = $result->fetch_assoc()) {
        $totalSales += $row['sanpham_gia'] * $row['quantitys'];
    }

    $orderQuery = "SELECT tong_tien, diem_tich_luy_su_dung, ap_dung_diem_tich_luy FROM tbl_order_moi WHERE session_idA = '$sessionIdA'";
    $orderResult = $conn->query($orderQuery);
    if ($orderRow = $orderResult->fetch_assoc()) {
        if ($orderRow['ap_dung_diem_tich_luy']) {
            $totalSales = $orderRow['tong_tien'] - $orderRow['diem_tich_luy_su_dung'];
        } else {
            $totalSales = $orderRow['tong_tien'];
        }
    }

    return $totalSales;
}

$conn = getDbConnection();

$date = new DateTime();
$today = $date->format('d/m/Y');
$monthStart = $date->format('01/m/Y');
$yearStart = $date->format('01/01/Y');

$queryToday = "SELECT payment_id, session_idA FROM tbl_payment 
               WHERE STR_TO_DATE(order_date, '%d/%m/%Y') = STR_TO_DATE('$today', '%d/%m/%Y')";
$resultToday = $conn->query($queryToday);
$totalOrdersToday = 0;
$totalSalesToday = 0;

while ($row = $resultToday->fetch_assoc()) {
    $totalOrdersToday++;
    $totalSalesToday += calculateTotalSales($conn, $row['session_idA']);
}

$queryMonth = "SELECT payment_id, session_idA FROM tbl_payment 
               WHERE STR_TO_DATE(order_date, '%d/%m/%Y') >= STR_TO_DATE('$monthStart', '%d/%m/%Y') 
               AND STR_TO_DATE(order_date, '%d/%m/%Y') <= STR_TO_DATE('$today', '%d/%m/%Y')";
$resultMonth = $conn->query($queryMonth);
$totalOrdersMonth = 0;
$totalSalesMonth = 0;

while ($row = $resultMonth->fetch_assoc()) {
    $totalOrdersMonth++;
    $totalSalesMonth += calculateTotalSales($conn, $row['session_idA']);
}

$queryYear = "SELECT payment_id, session_idA FROM tbl_payment 
              WHERE STR_TO_DATE(order_date, '%d/%m/%Y') >= STR_TO_DATE('$yearStart', '%d/%m/%Y') 
              AND STR_TO_DATE(order_date, '%d/%m/%Y') <= STR_TO_DATE('$today', '%d/%m/%Y')";
$resultYear = $conn->query($queryYear);
$totalOrdersYear = 0;
$totalSalesYear = 0;

while ($row = $resultYear->fetch_assoc()) {
    $totalOrdersYear++;
    $totalSalesYear += calculateTotalSales($conn, $row['session_idA']);
}
?>

<style>
    .admin-content-right {
        padding: 20px;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px;
        flex: 1 1 calc(33.333% - 40px);
        margin-bottom: 20px;
        text-align: center;
    }

    .card h5 {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 1.5em;
        margin: 0;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-bg">
        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng đơn hôm nay</h5>
                    <p class="card-text"><?php echo $totalOrdersToday; ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng đơn trong tháng</h5>
                    <p class="card-text"><?php echo $totalOrdersMonth; ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng đơn trong năm</h5>
                    <p class="card-text"><?php echo $totalOrdersYear; ?></p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng tiền hôm nay</h5>
                    <p class="card-text"><?php echo number_format($totalSalesToday); ?> VND</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng tiền trong tháng</h5>
                    <p class="card-text"><?php echo number_format($totalSalesMonth); ?> VND</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng tiền trong năm</h5>
                    <p class="card-text"><?php echo number_format($totalSalesYear); ?> VND</p>
                </div>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Hôm nay', 'Tháng này', 'Năm nay'],
            datasets: [{
                label: 'Số lượng đơn',
                data: [<?php echo $totalOrdersToday; ?>, <?php echo $totalOrdersMonth; ?>, <?php echo $totalOrdersYear; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Tổng tiền (VND)',
                data: [<?php echo $totalSalesToday; ?>, <?php echo $totalSalesMonth; ?>, <?php echo $totalSalesYear; ?>],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>

</html>