<?php
//Start Session.
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Flower Shop</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>

    <div id="wrap">

        <header>
          <div class="logo">
              <a href="main.php">
                  <img src="images/logo.gif" style="border:0" />
              </a>
          </div>

            <nav>
                <ul>
                  <li><a href="main.php">Home</a></li>
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="category.php">Flowers</a></li>
                  <li><a href="contact.php">Contact</a></li>
                  <li><a href="searchForm.php">Search</a></li>
                  <?php
                  include("php/nav.php");
                  /*-------------------------
                  Dynamic Nav bar.
                  --------------------------
                  if(isset($_SESSION["UserData"])){
                    echo "\n" . '<li><a href="myaccount.php">My Account</a></li>';
                    echo "\n" . '<li><a href="php/logout.php">Logout</a></li>';
                  }
                  else{
                    echo "\n" . '<li><a href="myaccount.php">Sign In</a></li>';
                    echo "\n" . '<li><a href="registerForm.php">Sign Up</a></li>';
                  }
                  */
                  ?>
                </ul>
            </nav>
        </header>

        <main>
            <div class="left_content">

                <div class="title" >
                    <span class="title_icon">
                        <img src="images/bullet1.gif" alt="" title="" />
                    </span>Order
                </div>

                <div class="feat_prod_box_details">
                    <!--details paragraph describes the content of the section-->
                    <p class="details">
                        Enter your details to have our flowers sent to you in no time!<br/>
                    </p>

                    <form name="order" action="#">

                        <?php
                        include("php/orderLeft.php");
                        ?>

                        <fieldset class="form_box" id="payment_details">
                            <legend class="form_subtitle">Payment Details</legend>

                            <div class="form_row">
                                <label class="form_field" for="payment_card_number"><strong>Card number</strong></label>
                                <input type="text" class="form_field_input" id="payment_card_number" autocomplete="cc-number" required />
                            </div>

                            <div class="form_row">
                                <label class="form_field" for="payment_cardholder"><strong>Name on card</strong></label>
                                <input type="text" class="form_field_input" id="payment_cardholder" autocomplete="cc-name" required/>
                            </div>

                            <!--Adapted from BookZone, Andrea Michele Torcasio, 2013, Order Page,
                            available at http://www.deakin.edu.au/~atorcasi/sit104/ass2/order.html, accessed 11/08/2016-->
                            <div class="form_row">
                                <!--split section into two for better form design, since input fields are small-->
                                <div class="form_column">
                                    <label class="form_field" for="payment_card_type"><strong>Card type</strong></label>
                                    <select class="form_field_input" id="payment_card_type" autocomplete="cc-type" required>
                                        <option value="" disabled selected>Choose card type</option>
                                        <option>MasterCard</option>
                                        <option>Visa</option>
                                        <option>AMEX</option>
                                    </select>
                                </div>
                                <div class="form_column">
                                    <label class="form_field" for="payment_csc"><strong>Card CSC</strong></label>
                                    <input type="text" class="form_field_input" id="payment_csc" autocomplete="cc-csc" required/>
                                </div>
                            </div>

                            <!--fieldset within a fieldset, allowed according to HTML5 spec,
                                used to group the date selectors together under one logical group-->
                            <fieldset class="form_box" id="payment_card_expiration_date">
                            <!--Adapted from BookZone, Andrea Michele Torcasio, 2013, Order Page,
                            available at http://www.deakin.edu.au/~atorcasi/sit104/ass2/order.html, accessed 11/08/2016-->
                                <legend class="form_subtitle">Card Expiry Date</legend>
                                <div class="form_row">
                                    <div class="form_column">
                                        <label class="form_field" for="payment_card_expiry_month"><strong>Expiry Month</strong></label>
                                        <select id="payment_card_expiry_month" size="5" autocomplete="cc-exp-month">
                                            <option value="" disabled selected>Choose expiry month</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                            <option value="5">05</option>
                                            <option value="6">06</option>
                                            <option value="7">07</option>
                                            <option value="8">08</option>
                                            <option value="9">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form_column">
                                        <label class="form_field" for="payment_card_expiry_year"><strong>Expiry Year</strong></label>
                                        <select id="payment_card_expiry_year" size="5" autocomplete="cc-exp-year">
                                            <option value="" disabled selected>Choose expiry year</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </fieldset>

                        <fieldset class="form_box" id="checkout">
                            <legend class="form_subtitle">Checkout</legend>
                            <div class="form_row">
                                <label class="form_field" for="payment_notes"><strong>Notes</strong></label>
                                <textarea class="form_field_input" id="payment_notes"></textarea>
                            </div>

                            <div class="form_row">
                                <input type="submit" value="Place Order" class="form_submit" />
                            </div>
                        </fieldset>
                    </form>

                </div>

                <div class="clear"></div>

            </div>
            <!--end of left content-->

            <div class="right_content">

                <div class="languages_box">
                    <span class="red">Languages:</span>
                    <a href="#">
                        <img src="images/au.gif" alt="" title="" style="border: 0; height:12px; width:15px;" />
                    </a>
                </div>

                <div class="currency">
                    <span class="red">Currency: </span>
                    <a href="#" class="selected">AUD</a>
                </div>
                <div>
                  <a href="myaccount.php" style="margin-left:50px" class="red">
                    <?php
                    /*-------------------------
                    Displays username by the cart on each page.
                    --------------------------*/
                    $seperator = "{||}";
                    $info = $_SESSION["UserData"];
                    $arr = array();
                    $arr = explode($seperator,$info);
                    $user = htmlentities($arr[1]);
                    echo "$user";
                    ?>
                  </a>
                </div>

                <!--CART-->
                <div class="cart">
                    <!--cart title-->
                    <div class="title">
                        <span class="title_icon">
                                <img src="images/cart.gif" alt="" title="" />
                        </span>My Cart
                    </div>
                    <!--end cart title-->
                    <!--cart content-->
                    <div class="home_cart_content">
                      <?php
                        if(isset($_SESSION["Plants"]) && $_SESSION["Plants"] != ""){
                          $numOfPlants = $_SESSION["CartNum"];
                          $$totalPrice = $_SESSION["CartPrice"];
                          echo "$numOfPlants x items | <span class='red'>TOTAL: $$totalPrice</span>";
                        }else{
                          echo "0 x items | <span class='red'>TOTAL: $0.00</span>";
                        }
                      ?>
                        <!--3 x items | <span class="red">TOTAL: 100$</span>-->
                    </div>
                    <!--end cart content-->
                    <!--cart links-->
                    <div class="cart_actions">
                        <a href="cart.php" class="view_cart">View Cart</a>
                        <a href="order.php" class="place_order">Place Order</a>
                    </div>
                    <!--end cart links-->
                </div>
                <!--END CART-->

                <div class="title">
                    <span class="title_icon">
                            <img src="images/bullet3.gif" alt="" title="" />
                    </span>About Our Shop
                </div>

                <div class="about">
                    <p>
                        <img src="images/about.gif" alt="" title="" class="right" /> Flowershop has quickly become renowned
                        as one of Geelong's most prestigious and luxurious retail flower stores, and this has been successfully
                        translated to our online flower shop. The same service, quality and range we provide to our retail
                        shoppers is also extended to our online community.
                        <!-- reference: Flower Temple, availalbe at <http://www.flowertemple.com.au/aboutflowertemple.aspx>, accessed 09/07/2013)-->
                    </p>
                </div>

                <div class="right_box">

                    <div class="title">
                        <span class="title_icon">
                                <img src="images/bullet5.gif" alt="" title="" />
                        </span>Categories
                    </div>

                    <ul class="list">
                        <li><a href="category.php">Flowers</a></li>
                    </ul>

                </div>

            </div>
            <!--end of right content-->

            <div class="clear"></div>

        </main>
        <!--end of main-->

        <footer>

            <div class="left_footer">
                <img src="images/footer_logo.gif" alt="" title="" /><br />
                <a href="http://csscreme.com/freecsstemplates/" title="free templates">
                    <img src="images/csscreme.gif" alt="free templates" title="free templates" style="border:0" />
                </a>
            </div>

            <div class="right_footer">
                <a href="main.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="category.php">Flowers</a>
                <a href="contact.php">Contact Us</a>
            </div>

            <aside id="deakinDisclaimer">
            ©Deakin University, School of Information Technology. This web page has been developed as a student assignment for the unit SIT203: Web Programming. Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.
            </aside>
        </footer>

    </div>

</body>

</html>
