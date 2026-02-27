                     <!--vertical Tabs-->
<?php                 
$products_view = array();
if (!empty($product_details)) 
{ 
  foreach ($product_details as $product) 
  {
     if ($product['package_type'] == 'free') {
      }else{
    $temp_array = array();
    $temp_array['package_details']         = $product; 
    $products_view[$product['package_id']] = $temp_array;
    }
  }
} 
?> 
                         
 <!--vertical Tabs-->
<div class="ChildVerticalTab_1">
  <div class="row">
    <div class="col-lg-3">
      <ul class="resp-tabs-list ver_1 content">
      <?php foreach ($products_view as $products_key => $products_res) 
         { ?>
        <li> <?php echo ucfirst($products_res['package_details']['package_name']); ?> </li>
       <?php } ?> 
      </ul>
    </div>
    <div class="col-lg-9">
      <div class="resp-tabs-container ver_1">
<?php
if(!empty($products_view)) 
{
  $i=1;
  foreach ($products_view as $products_key => $products_res ) 
  {
    ?>
    <div>
        <div class="sh-price-bar">
    <?php
        $implementation = $features_amount =0 ;
        $pricelabel = $plan_amount='';

        if ($products_res['package_details']['implementation_amount'] != "") 
        {
          $implementation = $products_res['package_details']['implementation_amount'];
          $pricelabel .= 'Implementation Cost ';
          
          if ($products_res['package_details']['features_amount']) 
          {
            $pricelabel .= '+';
          }
        }
        if ($products_res['package_details']['features_amount'] != "") 
        {
          $features_amount = $products_res['package_details']['features_amount'];
          $pricelabel .= ' Features Cost';
        }
        $plan_amount = $implementation+$features_amount;

        
        if ($plan_amount != 0) 
        { ?>
           <h3><?php echo get_currency(number_format($implementation+$features_amount,2)).'/-';?></h3>
           <small><?php echo (!empty($pricelabel))? ' ('.$pricelabel.')' :'' ?></small>
        <?php  } ?> 

          <?php if($products_res['package_details']['product_id']==50)
                  { ?>
              <a href="javascript:void(0)" class="btn btn-primary buy-product" data-product_id="<?php echo $products_res['package_details']['product_id']?>" data-package_id="<?php echo $products_res['package_details']['package_id']?>">Buy Now</a>
                   
            <?php }else{ ?>
              <a href="<?php echo $this->config->item('PORTAL_LINK').'product/order-summary/'.$products_res['package_details']['product_id'].'/'.$products_res['package_details']['package_id']?>" class="btn btn-primary buy-product" data-product_id="<?php echo $products_res['package_details']['product_id']?>" data-package_id="<?php echo $products_res['package_details']['package_id']?>">Buy Now</a>
            <?php } ?>

             <?php 
                   
                if ($products_res['package_details']['implementation_amount'] !=""  && $products_res['package_details']['implementaion_frequency'] !="") 
                {
                     
                    $implementation_html = !empty($products_res['package_details']['implementation_amount']) ? '<h6>('. $products_res['package_details']['implementaion_frequency'].')</h6><h2>'.get_currency(number_format($products_res['package_details']['implementation_amount'],2)).'/-</h2>' : '---' ;
                ?>
                    <div class="sh-inner-price">
                        <h4>Implementation Cost</h4>
                        <?php echo $implementation_html; ?>
                    </div>                            
                        
            <?php } ?>

            <?php 
            if (($products_res['package_details']['features_frequency'] != "" && $products_res['package_details']['features_amount'] != "" ) )   
            {  ?>

                <div class="sh-inner-price">
                  <h4>Feature Cost</h4>
                  <h6>(<?php echo ucfirst($products_res['package_details']['features_frequency']); ?>)</h6>
                  <h2><?php echo get_currency(number_format($products_res['package_details']['features_amount'],2)).'/-';?></h2>
                </div>
                
                        
            <?php 

              $package_features_list_json = $products_res['package_details']['package_features_list'];
              if($package_features_list_json != "")
              {
                $package_features_list_arr = json_decode($package_features_list_json, true);
                if(count($package_features_list_arr > 0))
                {               

                  $fi= 1;
                  $fi_data=false; ?>
                  <ul>
                  <?php 
                    foreach ($package_features_list_arr as $i_key => $features )  
                    {
                      if($fi > 5)
                      {  $fi_data = true;
                        ?>
                      <li><?php echo (!empty($features['name']) ? $features['name']: '' )?></li>
                  <?php }
                      else
                      { ?>
                      <li><?php echo (!empty($features['name']) ? $features['name']: '' )?></li>
                  
                  <?php }
                   $fi++;
                    } if ($fi_data) {?>
                            <a href="javascript:void(0)" class="view_more">View More <i class="fa fa-angle-down"></i></a>
                   <?php } ?>
                  </ul>
                  <?php  }
              } ?> 
      <?php   }
               ?>


        <?php if (!empty($products_res['package_details']['support_amount']) && !empty($products_res['package_details']['support_frequency'])) 
            { ?>

                <div class="sh-inner-price">
                  <h4>Support Cost</h4>
                  <h6>(<?php echo ucfirst($products_res['package_details']['support_frequency']); ?>)</h6>
                  <h2><?php echo get_currency(number_format($products_res['package_details']['support_amount'],2)).'/-';?></h2>
                </div>
      <?php } ?>

      <?php if ($products_res['package_details']['transaction_frequency'] != "") 
            { ?>

                <div class="sh-inner-price">
                  <h4>Transaction Cost</h4>
                  <h6>(<?php echo ucfirst($products_res['package_details']['transaction_frequency']); ?>)</h6>
                </div>

                <ul>  
                  <?php 
                  $package_transaction_list_json = $products_res['package_details']['package_transaction_list'];

                  if($package_transaction_list_json != "")
                  {
                    $package_transaction_list_arr = json_decode($package_transaction_list_json, true);
                    if(count($package_transaction_list_arr > 0))
                    {
                      foreach ($package_transaction_list_arr as $each_trn ) 
                      { //print_r($each_trn); 
                        if (strtolower($each_trn['unit']) == 'parcent') 
                        {  ?>
                          <li><?php echo $each_trn['definition'].' - <b>'.$each_trn['amount'].' % of '.'</b> '.$each_trn['description']?></li>
                    <?php   }
                        else
                        { ?>
                          <li><?php echo $each_trn['definition'].' - <b>'.get_currency(number_format($each_trn['amount'],2)).'/- </b>'.$each_trn['description']?> </li>
                    <?php   } 
                      }
                    }
                  } ?>
                  </ul>
        <?php }  ?>

        <?php if ($products_res['package_details']['license_frequency'] != "") 
          {  ?>  

            <div class="sh-inner-price">
              <h4>No. of licences</h4>
              <h6>(<?php echo ucfirst($products_res['package_details']['license_frequency']); ?>)</h6>
            </div>

                <ul >  
                  <?php $license_table = $lable = $per = "";
                  $package_license_list_json = $products_res['package_details']['package_license_list'];
                  //echo"<pre>";print_r($package_license_list_json); die;
                  if($package_license_list_json != "")
                  {
                    $package_license_list_arr = json_decode($package_license_list_json, true);
                    if(count($package_license_list_arr > 0))
                    { //echo"<pre>";print_r($package_license_list_arr); die;
                   $i =  0;
                  if($package_license_list_arr[$i]['license_id'] == 1)
                    { $lable .= '<b>No of Users</b>'; $per .='Per User'; }
                  else if($package_license_list_arr[$i]['license_id'] == 2)
                    { $lable .='<b>No of Locations</b>';  $per .='Per Location';}
                  else{
                    $lable .='<b>No of Branches</b>';  $per .='Per Branch';}

                      foreach ($package_license_list_arr as $each_trn ) 
                      { 
                         if (empty($each_trn['to_range']) || $each_trn['to_range'] == 0) {
                             $license_table .= '<p><b>'.$each_trn['from_range'].'</b> and above : <b>'.get_currency(number_format($each_trn['amount'],2)).'/-</b> '.$per.'</p>';
                         }elseif (empty($each_trn['from_range']) || $each_trn['from_range'] == 0) {
                            $license_table .= '<p> Up to <b>'.$each_trn['to_range'].'</b> : <b>'.get_currency(number_format($each_trn['amount'],2)).'</b>/- '.$per.'</p>';
                         }else{
                             $license_table .= '<p> From <b>'.$each_trn['from_range'].'</b> to <b>'.$each_trn['to_range'].'</b> : <b>'.get_currency(number_format($each_trn['amount'],2)).'</b>/- '.$per.'</p>';
                         }                          
                      }
                      echo $lable;
                        echo $license_table;
                       
                      $i++;
                    }
                  } ?>
                  </ul>
             
              <?php } ?>

            
            
            
            
            <!-- <button type="button" class="btn btn-info sh-expand-btn collapsed" data-toggle="collapse" data-target="#demo">
            <span class="sh-btn_1"> Expand <i class="fa fa-angle-down" aria-hidden="true"></i></span>
            <span class="sh-btn_2"> Collapse <i class="fa fa-angle-up" aria-hidden="true"></i></span>
            </button>
            <div id="demo" class="collapse sh-open-details">
              <div class="sh-inner-price">
                <h4>Feature Cost</h4>
                <h6>(Annually)</h6>
                <h2>₹ 2500</h2>
              </div>
            </div> -->


          </div>
        </div>

<?php }

?>
<?php  } else {?>
<div class="alerts alert_msg col-lg-12" role="alert" >
  <p> Product packages not defined yet. </p>
</div> <?php }?>
      </div>
    </div>
  </div>
</div>

