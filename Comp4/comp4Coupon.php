<?php
session_start();
require_once '..\functions.php';

// display a coupon code
$_SESSION['coupon'] = "25OFFNOW";

$pageTitle = "Part III: Coupon";
writeHead($pageTitle);
?> <!-- end form submittal check and data processing -->

<div id="contentDiv">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

			<p>
				<?php echo "Your Coupon Code is: <strong>".$_SESSION['coupon']."</strong>"; ?>
	        </p>
           
        </form>
</div>
<!-- footer and html closing tags embedded -->

<?php
$pageFoot = "Part III: Coupon";
writeFoot($pageFoot);
?>