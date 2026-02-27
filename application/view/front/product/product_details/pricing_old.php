 <!-- pricing -->
<style type="text/css"> 
 li.flitem{display: none;}
 div.alert_msg{"position: relative;    
            padding: .75rem 1.25rem;    
            margin-bottom: 1rem;    
            border: 1px solid transparent;    
            border-radius: .25rem;"}
</style>
  <div class="tab-pane fade" role="tabpanel" id="pricing">
    <div class="cotnainer">
      <div class="product-view">
        <h1>Product Packages</h1>
      </div>
      <div class="pricing-sec table-responsive">
         <?php
            //$is_free_package = FALSE;
            $products_view = array();
            if (!empty($product_details)) {
              $background_colors = array('#6db8ff', '#846fbf', '#f5d246', '#495E67', '#FF3838','#76ad00','#0d8e50','#365fe2','#00b195','#2c3c0b','#7d4c09','#774646');
                foreach ($product_details as $product) {
                  
                  if ($product['package_type'] == 'free') {
                     // $is_free_package = TRUE;
                  }else{

                    $products_view['pkg_license'][$product['package_id']] = array(
                        'license' =>(!empty($product['package_license_list']) 
                            ? json_decode($product['package_license_list'],true) 
                            : array()),
                        'frequency'=>$product['license_frequency']
                    );

                    $products_view['pkg_transaction'][] = array(
                        'transaction' =>(!empty($product['package_transaction_list']) 
                            ? json_decode($product['package_transaction_list'],true) 
                            : array()),
                        'frequency'=>$product['transaction_frequency']
                    );
                    
                    $rand_background = $background_colors[array_rand($background_colors)];

                    $products_view['package_name'][]    = $product['package_name'];
                    $products_view['package_id'][]      = array(
                        'implementation_amount' =>$product['implementation_amount'],
                        'package_id'=>$product['package_id'],
                        'features_amount' =>$product['features_amount'],
                        'support_amount' =>$product['support_amount'],
                    );
                    $products_view['color'][]           = $rand_background;

                    $products_view['implementation'][]  = array(
                        'amount' =>$product['implementation_amount'],
                        'frequency'=>$product['implementaion_frequency']
                    );

                    $products_view['support'][]         = array(
                        'amount' =>$product['support_amount'],
                        'frequency'=>$product['support_frequency']
                    );

                    $products_view['features'][]         = array(
                        'package_type' =>$product['package_type'],
                        'amount' =>$product['features_amount'],
                        'frequency'=>$product['features_frequency'],
                        'features_list' =>(!empty($product['package_features_list'])
                            ? json_decode($product['package_features_list'],true) 
                            : array())
                        );
                  }
                }
            }
                        $table = '';
            if (!empty($products_view)) { 
               $table .= '<table class="table table-bordered pricing-table">'; 
               $table .= '<thead><tr><th ><div class="th-data"><h2 class="pckg-title">Elements</h2></div></th>';
               foreach ($products_view['package_name'] as $p_key => $package_name ) {
                  $color = $products_view['color'][$p_key];
                  $table .= '<th class="bg-head"><div class="th-data "><h2 class="pckg-title white">'.ucwords($package_name).'</h2></div></th>';
               }
               $table .= '</tr></thead>';

               $table .= '<tr class="last_row"><td></td>';
                foreach ($products_view['package_id'] as $p_key => $p_id ) {
                    $color  = $products_view['color'][$p_key];
                    if($products['product_id']==50){
                       $table .= '<td><div  class="tbl-buy-now">
                                <a href="javascript:void(0)" class="buy-product" data-product_id="'.$products['product_id'].'" data-package_id="'.$p_id['package_id'].'" >Buy Now</a>
                             </div></td>';
                    }else{


                     $pricelabel = '';
                      $implementation = 0 ;
                       if (!empty($p_id['implementation_amount']) ) {
                         $implementation = $p_id['implementation_amount'] ;
                         $pricelabel .= 'Implementation Cost ';
                         if (!empty($p_id['features_amount'])) {
                           $pricelabel .= '+';
                         }
                         //Implementation Cost + Features Cost
                       }
                      $features_amount =0 ;
                      if (!empty($p_id['features_amount'])) {
                        $features_amount = $p_id['features_amount'];
                        $pricelabel .= ' Features Cost';
                      }

                 

                       $table .= '<td><div class="tbl-buy-now">';
                       $plan_amount = $implementation+$features_amount;
                       if ($plan_amount != 0) {
                          $table .= '<span>'.get_currency(number_format($implementation+$features_amount,2)).'/- <br/>';
                       }
                      
                      $table .= !empty($pricelabel) ? ' ('.$pricelabel.')' :'';

                      $table .= ' </span><a href="'.$this->config->item('PORTAL_LINK').'/product/order-summary/'.$products['product_id'].'/'.$p_id['package_id'].'" class="buy-product1" data-product_id="'.$products['product_id'].'" data-package_id="'.$p_id['package_id'].'" >Buy Now</a>
                       </div></td>';
                    }
                 }
              $table .= '</tr>';
               //Implementation
               $implementation_html = '';
               $is_implementation_html = false;
               
                  $implementation_html .= '<tr><td><b>Implementation Cost</b></td>';
                  foreach ($products_view['implementation'] as $i_key => $implementation ) {

                     if (!empty($implementation['amount']) && !empty($implementation['frequency'])) {
                        $is_implementation_html = true;
                       /* $implementation_html .= '<td><i>('.$implementation['frequency'].')</i>
                           <p><b>'. number_format($implementation['amount'],2).'/-</b></p></td>';*/
                     }
                    $implementation_html.= '<td>'.(!empty($implementation['amount']) ? '<i>('.$implementation['frequency'].')</i><p><b>'.get_currency(number_format($implementation['amount'],2)).'/-</b></p>' : '---' ).'</td>';
                     
                  }
                  $implementation_html .= '</tr>';

               $table .= ($is_implementation_html ? $implementation_html : '');  

               //Features
               $features_html = '';
               $is_features_html = false;

                  $features_html .= '<tr><td><b>Features Cost</b></td>';
                     foreach ($products_view['features'] as $i_key => $features ) {
                        if (!empty($features['frequency']) && !empty($features['amount']) || $features['package_type'] == 'free') {
                           $is_features_html = true;
                        }
                        $features_html .= '<td>'.(!empty($features['amount']) ? '<i>('.$features['frequency'].')</i><p><b>'.get_currency(number_format($features['amount'],2)).'/-</b></p>' : '' );
                          $temp_features = '';
                        if (!empty($features['features_list'])) {
                           $temp_features = '<ul class="features_list">';
                           $fi= 1;
                           $fi_data= false;
                           foreach ($features['features_list'] as $features_point ) {
                              if($fi > 5){
                                $fi_data= true;
                                $temp_features .= '<li class="flitem">'.(!empty($features_point['name']) ? $features_point['name']: '' ).'</li>';

                              }else{

                                $temp_features .= '<li>'.(!empty($features_point['name']) ? $features_point['name']: '' ).'</li>';
                              }
                              $fi++;
                           }
                           if ($fi_data) {
                             $temp_features .= '<div class="feview_more"><a href="javascript:void(0)" class="view_more"> View More</a></div>';
                           }
                          $temp_features .= '<ul>';
                        }
                          $features_html .= $temp_features.'</td>';
                     }
                  $features_html .= '</tr>';

               $table .= ($is_features_html ? $features_html : '');

               //Support
               $support_html = '';
               $is_support_html = false;
               
                  $support_html .= '<tr><td><b>Support Cost</b></td>';
                  foreach ($products_view['support'] as $i_key => $support ) {
                     if (!empty($support['amount']) && !empty($support['frequency'])) {
                        $is_support_html = true;
                     }
                     $support_html .= '<td>'.(!empty($support['amount']) ? '<i>('.$support['frequency'].')</i><p><b>'.get_currency(number_format($support['amount'],2)).'/-</b></p>' : '---' ).'</td>';
                  }
                  $support_html .= '</tr>';

               $table .= ($is_support_html ? $support_html : ''); 


               //Transaction
               $transaction_html = '';
               $is_transaction_html = false;

                  $transaction_html .= '<tr><td><b>Transaction Cost</b></td>';
                   
                  foreach ($products_view['pkg_transaction'] as $transaction ) {
                     if (!empty($transaction['frequency'])) {
                        $is_transaction_html = true;
                     }

                     $transaction_html .= '<td><i>'.(!empty($transaction['frequency']) ? '('.$transaction['frequency'].')': '---' ).'</i>';
                    
                     foreach ($transaction['transaction'] as $each_trn ) {

                        if (strtolower($each_trn['unit']) == 'parcent') {
                           $transaction_html .= '<p>'.$each_trn['definition'].' : <b>'.$each_trn['amount'].' % of '.'</b> '.$each_trn['description']. '</p>';
                           
                        }else{
                           $transaction_html .= '<p>'.$each_trn['definition'].' : <b>'.get_currency(number_format($each_trn['amount'],2)).'/-</b></p>';
                        }


                        //$transaction_html .= '<p>'.$each_trn['definition'].' : <b>'.get_currency(number_format($each_trn['amount'],2)).'/-</b></p>';
                     }
                     $transaction_html .= '</td>';
                  }

                  $transaction_html .= '</tr>';
               
               $table .= ($is_transaction_html ? $transaction_html : '');

               //licences
               $licences_html = '';
               $is_licences_html = false;

                  $licences_html .= '<tr><td><b>No. of licences</b></td>';
                  foreach ($products_view['pkg_license'] as $license ) {
                     if (!empty($license['frequency'])) {
                        
                     }
                     $licences_html .= '<td><i>'.(!empty($license['frequency']) ? '('.$license['frequency'].')' : '---' ).'</i></td>';
                  }
                  $licences_html .= '</tr>';
                  
                  foreach ($license_elements as $element ) {
                     $license_table = '';
                  
                     foreach ($products_view['pkg_license'] as $p_id => $license ) {
                           $license_table .= '<td>';
                           $fill_data = false;
                           foreach ($license['license'] as $each_license ) {
                             if ($p_id == $each_license['package_id'] 
                              && $element['id'] == $each_license['license_id']) 
                             {
                                 $fill_data = true;
                                 $is_licences_html = true;
                     
                                 if (empty($each_license['to_range']) || $each_license['to_range'] == 0) {
                                     $license_table .= '<p><b>'.$each_license['from_range'].'</b> and above : <b>'.get_currency(number_format($each_license['amount'],2)).'/-</b> '.$element['license_name'].'</p>';
                                 }elseif (empty($each_license['from_range']) || $each_license['from_range'] == 0) {
                                    $license_table .= '<p> Up to <b>'.$each_license['to_range'].'</b> : <b>'.get_currency(number_format($each_license['amount'],2)).'</b>/- '.$element['license_name'].'</p>';
                                 }else{
                                     $license_table .= '<p> From <b>'.$each_license['from_range'].'</b> to <b>'.$each_license['to_range'].'</b> : <b>'.get_currency(number_format($each_license['amount'],2)).'</b>/- '.$element['license_name'].'</p>';
                                 }
                             }
                           }
                           if(!$fill_data){               $license_table .= '---';          }
                        $license_table .= '</td>';
                     }
                     $licences_html .= '<tr class="sub-level">';
                         $licences_html .= '<td>No of '.$element['license_name'].'</td>'.$license_table;
                     $licences_html .= '</tr>';
                  }

                  $table .= ($is_licences_html ? $licences_html : '');

                 



            


            $table .= '</table>';

            echo $table;
            
            }else{
              echo '<div class="alerts alert-danger alert_msg" role="alert">Product packages not defined yet.</div>';
            }  ?>
            <?php echo !empty($products['package_note']) ? '<div class="text-center"><B>*Note:</B>'.ucfirst($products['package_note']).'</div>':'' ?>
         </div>

         <?php /*if ($is_free_package) { 
          if (!empty($product_details)) {
                foreach ($product_details as $product) {
                  
                  if ($product['package_type'] == 'free') { 
                    if($products['product_id']!=50){?>
                    <div style=" background-color: #6fbbbf;    text-align: center;" class="tbl-buy-now">
                      <a href="<?php echo base_url('product/order-summary/').$products['product_id'].'/'.$product['package_id']?>" class="buy-product1" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>">START YOUR FREE TRIAL NOW</a>
                    </div>
                  <?php }else{?>
                    <div style=" background-color: #6fbbbf;    text-align: center;" class="tbl-buy-now">
                      <a href="javascript:void(0)" class="buy-product" data-product_id="<?php echo $product['product_id']; ?>" data-package_id="<?php echo $product['package_id']; ?>">START YOUR FREE TRIAL NOW</a>
                    </div>
                <?php  }
              }
                }
              }?>
         
          
          <?php }*/ ?>
   </div>
</div>

