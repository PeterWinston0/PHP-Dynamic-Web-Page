<?php
session_start();
$title = "Checkout Page";
require_once('../includes/config.php');
require_once('../includes/helpers.php');

//ordernumber generation
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
$orderNumber = $today . $rand;
$_SESSION['order_number'] = $orderNumber;

//cart_items session changes
$thanks_items = $_SESSION['cart_items'];
//changing
$_SESSION['thanks_items'] = $thanks_items;


$cartItemCount = count($_SESSION['cart_items']);

if (isset($_POST['submit'])) {
  if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['address'], $_POST['zipcode']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['zipcode'])) {
    $firstName = $_POST['first_name'];

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
      $errorMsg[] = 'Please enter valid email address';
    } else {
      //validate_input is a custom function
      //you can find it in helpers.php file
      $firstName = validate_input($_POST['first_name']);
      $lastName = validate_input($_POST['last_name']);
      $email = validate_input($_POST['email']);
      $address = validate_input($_POST['address']);
      $address2 = (!empty($_POST['address']) ? validate_input($_POST['address']) : '');
      $zipcode = validate_input($_POST['zipcode']);
      $orderNumber = $today . $rand;

      $sql = 'INSERT INTO ORDERS (first_name, last_name, email, address, address2, zipcode, order_status,created_at, updated_at, order_no) values (:fname, :lname, :email, :address, :address2, :zipcode, :order_status,:created_at, :updated_at, :order_no)';
      $statement = $db->prepare($sql);
      $params = [
        'fname' => $firstName,
        'lname' => $lastName,
        'email' => $email,
        'address' => $address,
        'address2' => $address2,
        'zipcode' => $zipcode,
        'order_status' => 'confirmed',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'order_no' => $orderNumber,
      ];

      $statement->execute($params);
      if ($statement->rowCount() == 1) {

        $getOrderID = $db->lastInsertId();

        if (isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items'])) {
          $sqlDetails = 'INSERT IGNORE INTO order_details (order_id, product_id, product_name, product_price, qty, total_price) values(:order_id, :product_id, :product_name, :product_price, :qty, :total_price)';
          $orderDetailStmt = $db->prepare($sqlDetails);

          $totalPriceOrder = 0;
          foreach ($_SESSION['cart_items'] as $item) {

            $totalPriceÎtem = $item['product_price'] * $item['qty'];

            $paramOrderDetails = [
              'order_id' => $getOrderID,
              'product_id' => $item['product_id'],
              'product_name' => $item['product_name'],
              'product_price' => $item['product_price'],
              'qty' => $item['qty'],
              'total_price' => $totalPriceÎtem
            ];

            $totalPriceOrder += $totalPriceÎtem;

            $orderDetailStmt->execute($paramOrderDetails);
          }

          $updateSql = 'UPDATE orders SET total_price = :total WHERE o_id = :id';

          $rs = $db->prepare($updateSql);
          $prepareUpdate = [
            'total' => $totalPriceOrder,
            'id' => $getOrderID
          ];

          $rs->execute($prepareUpdate);

          unset($_SESSION['cart_items']);
          $_SESSION['confirm_order'] = true;
          header('location:thank-you.php');
          exit();
        }
      } else {
        $errorMsg[] = 'Unable to save your order. Please try again';
      }
    }
  } else {
    $errorMsg = [];

    if (!isset($_POST['first_name']) || empty($_POST['first_name'])) {
      $errorMsg[] = 'First name is required';
    } else {
      $fnameValue = $_POST['first_name'];
    }

    if (!isset($_POST['last_name']) || empty($_POST['last_name'])) {
      $errorMsg[] = 'Last name is required';
    } else {
      $lnameValue = $_POST['last_name'];
    }

    if (!isset($_POST['email']) || empty($_POST['email'])) {
      $errorMsg[] = 'Email is required';
    } else {
      $emailValue = $_POST['email'];
    }

    if (!isset($_POST['address']) || empty($_POST['address'])) {
      $errorMsg[] = 'Address is required';
    } else {
      $addressValue = $_POST['address'];
    }

    if (!isset($_POST['zipcode']) || empty($_POST['zipcode'])) {
      $errorMsg[] = 'Zipcode is required';
    } else {
      $zipCodeValue = $_POST['zipcode'];
    }
    if (isset($_POST['address2']) || !empty($_POST['address2'])) {
      $address2Value = $_POST['address2'];
    }
  }
}

require "../includes/layout/frontHeader.php";
?>
<div class="page-container">
    <div class="checkout-container">
        <div class="billing-block">
        <h1 class="my-title">Checkout</h1>
            <h4 class="mb-3">Shipping Information</h4>
            <?php
      if (isset($errorMsg) && count($errorMsg) > 0) {
        foreach ($errorMsg as $error) {
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }
      }
      ?>
            <form class="needs-validation" method="POST">
                <div class="txt-wrap">
                    <div class="half-txt">
                        <div class="">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control txt" id="firstName" name="first_name"
                                placeholder="First Name"
                                value="<?php echo (isset($fnameValue) && !empty($fnameValue)) ? $fnameValue : '' ?>">
                        </div>
                    </div>
                    <div class="half-txt">
                        <div class="">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control txt" id="lastName" name="last_name"
                                placeholder="Last Name"
                                value="<?php echo (isset($lnameValue) && !empty($lnameValue)) ? $lnameValue : '' ?>">
                        </div>
                    </div>
                </div>

                <div class="full-txt">
                    <label for="address">Address</label>
                    <input type="text" class="form-control txt" id="address" name="address" placeholder="1234 Main St"
                        value="<?php echo (isset($addressValue) && !empty($addressValue)) ? $addressValue : '' ?>">
                </div>

                <div class="full-txt">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control txt" id="address2" name="address2"
                        placeholder="Apartment or suite"
                        value="<?php echo (isset($address2Value) && !empty($address2Value)) ? $address2Value : '' ?>">
                </div>

                <div class="full-txt">
                    <label for="email">Email</label>
                    <input type="email" class="form-control txt" id="email" name="email" placeholder="you@example.com"
                        value="<?php echo (isset($emailValue) && !empty($emailValue)) ? $emailValue : '' ?>">
                </div>
                <div class="txt-wrap">
                    <div class="three-quart-txt">
                        <label for="city">City</label>
                        <input type="city" class="form-control txt" id="city" name="city" placeholder="city" value="">
                    </div>

                    <div class="quart-txt">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control txt" id="zip" name="zipcode" placeholder=""
                            value="<?php echo (isset($zipCodeValue) && !empty($zipCodeValue)) ? $zipCodeValue : '' ?>">
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="">Payment</h4>

                <div class="payment-options">
                    <div class="payment-radio">
                        <input id="cash" name="custom-radio" type="radio" checked="checked" value="1" class="">
                        <label class="custom-control-label" for="cash">Cash on Delivery</label>
                    </div>
                    <div class="payment-radio">
                        <input id="card" name="custom-radio" type="radio" value="2" class="">
                        <label class="custom-control-label" for="card">Card</label>
                    </div>
                </div>

                <hr class="mb-4">

                <div id="card2" class="card-payment">
                    <div class="full-txt">
                        <label for="card-nr">Card Number</label>
                        <input type="text" class="form-control txt" id="card-nr" name="card-nr"
                            placeholder="Card Number" value="">
                    </div>
                    <div class="txt-wrap">
                        <div class="third-txt">
                            <label for="card-nr">Month</label>
                            <input type="text" class="form-control txt" id="card-nr" name="card-nr" placeholder="Month"
                                value="">
                        </div>
                        <div class="third-txt">
                            <label for="card-nr">Year</label>
                            <input type="text" class="form-control txt" id="card-nr" name="card-nr" placeholder="Year"
                                value="">
                        </div>
                        <div class="third-txt">
                            <label for="card-nr">Security</label>
                            <input type="text" class="form-control txt" id="card-nr" name="card-nr"
                                placeholder="Last Three" value="">
                        </div>
                    </div>
                    <hr class="mb-4">
                </div>

                <script type="text/javascript">
                  $(document).ready(function() {
                    $("div.card-payment").hide();
                        $("input[name$='custom-radio']").click(function() {
                            var test = $(this).val();
                            $("div.card-payment").hide();
                            $("#card" + test).show();
                        });
                    });
                </script>
                <div class="checkout-submit">
                    <button class="place-order-btn" type="submit" name="submit" value="submit">Place Order</button>
                    <p>By clicking PLACE ORDER you agree to DreamSneaker's <br>
                        Terms and Conditions and Privacy Policy</p>
                </div>

            </form>
        </div>

        <div class="summary-block">
            <h2>Order Summary</h2>
            <?php if (isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0) { ?>

            <?php
        $totalCounter = 0;
        $itemCounter = 0;
        foreach ($_SESSION['cart_items'] as $key => $item) {

          $imgUrl = PRODUCT_IMG_URL . $item['product_img'];

          $total = $item['product_price'] * $item['qty'];
          $totalCounter += $total;
          $itemCounter += $item['qty'];
      ?>


            <li class="order-summary">
                <div>
                    <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2" style="">
                </div>
                <div>
                    <h6 class="my-0">
                        <?php echo $item['product_name'] ?>
                    </h6>
                    <small class="text-muted">Quantity:
                        <?php echo $item['qty'] ?> X Price:
                        <?php echo $item['product_price'] ?>
                    </small>
                    <br>
                    <span class="text-muted">$
                        <?php echo $total; ?>
                    </span>
                </div>

            </li>
            <?php } ?>
            <div class="total-price">
                <strong>
                    <p>Total</p>
                    <p>DKK
                        <?php echo $totalCounter; ?> ,-
                    </p>
                </strong>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
<?php require "../includes/layout/frontFooter.php"; ?>