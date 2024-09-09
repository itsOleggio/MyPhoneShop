<?php
    session_start();
    require_once '../config.php';
    require_once '../functions.php';

    error_reporting(-1);

    if (isset($_POST['client_action'])) {
        switch ($_POST['client_action']) {
            case 'show':

                $begin_date = $_POST['begin-date'];
                $end_date = $_POST['end-date'];

                if ($begin_date == null) {
                    $begin_date = date("Y.m.d H:i:s", null);
                }
                if ($end_date == null) {
                    $end_date = date("Y.m.d H:i:s");
                }

                $query = "SELECT * FROM `orders` WHERE `client_id` = ". $_SESSION['user']['id']." AND `ordering_time` BETWEEN '$begin_date' AND '$end_date'";


                if ($result = mysqli_query($connection, $query)) {
                    $orders = get_orders($query);

                    echo json_encode(['code' => 'ok', 'orders' => $orders]);
                } else {
                    echo json_encode(['code' => 'error', 'message' => 'Ошибка во время выполнения запроса!']);
                }

                break;

            case 'edit':


                break;

        }
    }

    mysqli_close($connection);
?>


