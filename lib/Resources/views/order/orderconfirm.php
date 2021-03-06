<?php
namespace Destiny;
use Destiny\Common\Utils\Tpl;
use Destiny\Common\Config;
?>
<!DOCTYPE html>
<html>
<head>
<title><?=Tpl::title($model->title)?></title>
<meta charset="utf-8">
<?php include Tpl::file('seg/commontop.php') ?>
<?php include Tpl::file('seg/google.tracker.php') ?>
</head>
<body id="orderconfirm">

  <?php include Tpl::file('seg/top.php') ?>
  <?php include Tpl::file('seg/headerband.php') ?>
  
  <section class="container">

    <h1 class="title">
      <span>Subscribe</span> <small>confirm your selection</small>
    </h1>
    
    <div class="content content-dark clearfix">
    
      <?php if(!empty($model->warning)): ?>
      <div style="margin: 15px 15px 0 15px;">
        <div class="alert alert-warning" style="margin: 0;">
          <strong><span class="fa fa-warning"></span> Warning!</strong>
          <?=Tpl::out($model->warning->getMessage())?>
        </div>
      </div>
      <?php endif; ?>

      <div class="ui-step-legend-wrap clearfix">
        <div class="ui-step-legend clearfix">
          <ul>
            <li style="width: 25%;"><a>Select a subscription</a></li>
            <li style="width: 25%;" class="active"><a>Confirmation</a><i class="arrow"></i></li>
            <li style="width: 25%;"><a>Pay subscription</a></li>
            <li style="width: 25%;"><a>Complete</a></li>
          </ul>
        </div>
      </div>

      <div style="width: 100%;" class="clearfix stream">
        <form class="onceoff" action="/subscription/create" method="post">

          <input type="hidden" name="subscription" value="<?= $model->subscriptionType['id'] ?>">
          <input type="hidden" name="gift" value="<?= $model->gift ?>">

          <?php if(!empty($model->currentSubscription)): ?>

          <div class="ds-block clearfix">
          
            <div class="subscriptions pull-left" style="border-right:1px dashed #222; padding-right: 15px; margin-right: 15px;">
              <div class="subscription-tier clearfix">
                <div class="subscription" style="width: auto;">
                  <div><span class="label label-warning">FROM</span></div>
                  <h2><?=$model->currentSubscriptionType['tierLabel']?></h2>
                  <div><span class="sub-amount">$<?=$model->currentSubscriptionType['amount']?></span> (<?=$model->currentSubscriptionType['billingFrequency']?> <?=strtolower($model->currentSubscriptionType['billingPeriod'])?>)</div>
                </div>
              </div>
            </div>
            
            <div class="subscriptions pull-left">
              <div class="subscription-tier clearfix">
                <div class="subscription" style="width: auto;">
                  <div><span class="label label-success">TO</span></div>
                  <h2><?=$model->subscriptionType['tierLabel']?></h2>
                  <div><span class="sub-amount">$<?=$model->subscriptionType['amount']?></span> (<?=$model->subscriptionType['billingFrequency']?> <?=strtolower($model->subscriptionType['billingPeriod'])?>)</div>
                </div>
              </div>
            </div>
            
          </div>

          <?php else: ?>

          <div class="subscription-tier ds-block">
            <div class="subscription">
              <h2><?=$model->subscriptionType['tierLabel']?></h2>

              <?php if(!empty($model->gift)): ?>
              <p><span class="fa fa-gift"></span> You are gifting this to <span class="label label-danger"><?=Tpl::out($model->gift)?></span></p>
              <?php endif; ?>

              <p><span class="sub-amount">$<?=$model->subscriptionType['amount']?></span> (<?=$model->subscriptionType['billingFrequency']?> <?=strtolower($model->subscriptionType['billingPeriod'])?>)</p>
            </div>
          </div>

          <?php endif; ?>

          <div class="ds-block">
            <label class="checkbox">
              <input type="checkbox" name="renew" value="1" checked="checked" /> Automatically renew this subscription
            </label>
          </div>

          <div class="ds-block">
            <label>
              <div>Send a message with your subscription (optional):</div>
            </label>
            <textarea name="sub-message" autocomplete="off" maxlength="250" class="form-control" placeholder=""></textarea>
            <small>Maximum message length 250 characters</small>
          </div>

          <div class="form-actions">
            <img class="pull-right" title="Powered by Paypal" src="<?=Config::cdn()?>/web/img/Paypal.logosml.png" />
            <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-shopping-cart"></span> Pay subscription</button>
            <a href="/subscribe" class="btn btn-link">Cancel</a>
            <p style="font-size: 12px; margin: 15px 0 0 0; color: #">
              <span>By clicking the &quot;Pay subscription&quot; button, you are confirming that this purchase is what you wanted and that you have read the <a href="/help/agreement">user agreement</a>.</span>
            </p>
          </div>

        </form>
      </div>
    </div>
  </section>
  
  <?php include Tpl::file('seg/foot.php') ?>
  <?php include Tpl::file('seg/commonbottom.php') ?>
  
  <script>
  $(function(){
    $('form.onceoff').on('submit', function(){
      var frm = $(this);
      frm.find('[type="submit"]').attr("disabled", "disabled");
      window.setTimeout(function(){
        frm.find('[type="submit"]').removeAttr("disabled");
      }, 30000);
    });
    $('textarea[name="sub-message"]').focus();
  });
  </script>
  
</body>
</html>