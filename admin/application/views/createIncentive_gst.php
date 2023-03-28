<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Invoice</title>
</head>
<?php
    $order_label =  '';
    //print_r($order_bill);
    $gst = '';
    $company = '';
    if( intval($order_type) == 1 ){
        $order_label = 'CUSTOMER';
    }else if( intval($order_type) == 2 ){
        $order_label = 'WHOLESALER';
        $wholesaler_data = $this->master_db->getcontent1('user','id',$orders[0]->user_id);
        if( count($wholesaler_data) ){
            $gst = $wholesaler_data[0]->gst;
            $company = $wholesaler_data[0]->company_name;
        }
    }
?>
<body> 


<style>
	@import url('https://fonts.googleapis.com/css?family=Noto+Serif:400,700');
</style>


 <table style="width:100%; font-family: 'Noto Serif', serif; font-size:14px;" cellpadding="0" cellspacing="0">
  <thead>
  	<tr>    
      <td colspan="26" style="padding:1px; text-align:left;">
      <img src="<?php echo asset_url(); ?>images/logo.png" style="width:16%; display: inline-block;"/>
      <div style="display:inline-block; vertical-align:top;">

      </div>
     
      
      </td>
      
      <td></td>
      
      <td style="padding:1px; font-size:14px; text-align:right;"><strong> Tax Invoice/Bill of Supply/Cash Memo </strong> <br /> (Original for Recipient) </td>
    </tr>
    
 </thead>
  
</table> 



    
     <table style="width: 100%; font-size:14px; line-height:20px;"
                    cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="50%" align="left" valign="top" style="padding: 1px;">
                            <b>Sold By: </b><br>
                            222, baker street Oiishee The<br/>
							Gift Of Nature Bengaluru<br/>
							Phone : +91 9900100000<br>
                            Email : support@oiishee.com
                        </td>
                       
                         <td width="50%" align="right" valign="top" style="padding: 1px;">
                            <b>Billing Address: </b> <br />
                               <?php
                                    if( $company != '' ){echo $company.'<br>';}
                                ?>
                                <?=$order_bill[0]->sname?> <br />
                              <?=$order_bill[0]->saddr1.' '.$order_bill[0]->saddr2?><br>
                            <?php
                                if( !empty($order_bill[0]->landmark) ){
                                    echo "Landmark : ".$order_bill[0]->landmark;
                                }
                            ?>
                            <?=$order_bill[0]->scity?>,
                            <?=$order_bill[0]->sstate?>,
                            <?=$order_bill[0]->scountry?> -
                            <?=$order_bill[0]->spincode?><br>
                            <?='Phone : '.$order_bill[0]->sphone?><br>
                            <?='Email : '.$order_bill[0]->bemail?><br>
                            
                        </td>
                            
                    </tr>
                </table>
                
                
                <table style="width: 100%; margin:20px 0px; font-size:14px; line-height:20px;"
                    cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="50%" align="left" valign="top" style="padding: 1px;">
                            <?php if( $wholesaler_data[0]->pan_no != '' ){ ?><b>PAN NO: </b> <?php $wholesaler_data[0]->pan_no;}?><br/>
						  
                            <?php if( $wholesaler_data[0]->gst != '' ){ ?><b>GST Registration No: </b> <?php $wholesaler_data[0]->gst;}?>
                            <br />
                        </td>
                       
                         <td width="50%" align="right" valign="top" style="padding: 1px;">
                            <b>Shipping Address: </b> <br />
                                <?php
                                    if( $company != '' ){echo $company.'<br>';}
                                ?>
                                <?=$order_bill[0]->sname?> <br />
                              <?=$order_bill[0]->saddr1.' '.$order_bill[0]->saddr2?><br>
                            <?php
                                if( !empty($order_bill[0]->landmark) ){
                                    echo "Landmark : ".$order_bill[0]->landmark;
                                }
                            ?>
                            <?=$order_bill[0]->scity?>,
                            <?=$order_bill[0]->sstate?>,
                            <?=$order_bill[0]->scountry?> -
                            <?=$order_bill[0]->spincode?><br>
                            <?='Phone : '.$order_bill[0]->sphone?><br>
                            <?='Email : '.$order_bill[0]->bemail?><br>
							</td>
                            
                    </tr>
                </table>
                
                <table style="width: 100%; margin:10px 0px; font-size:14px; line-height:20px;"
                    cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="50%" align="left" valign="top" style="padding: 1px;">
                            <b>Order Number: </b> <?php echo $order[0]->orderid;?> <br>
                            <b>Order Date: </b> <?php echo $order[0]->ordered_date;?> <br />
                        </td>
                       
                         <td width="50%" align="right" valign="top" style="padding-top: 20px;">
                            <b>Invoice Number : </b> <?php echo $invoice?> <br />
                          <!--  <b>Invoice Details : </b> MH-BOM7-882292155-2122 <br />-->
                            <b>Invoice Date : </b><?php echo $order[0]->invoice_date?> 
                        </td>
                            
                    </tr>
                </table>



		<table style="width:100%; margin:30px 0; border-top:1px solid #333; font-size:14px;" width="0" border="0" cellpadding="0" cellspacing="0"> 

             
              <tr>
              
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Sl No. </strong></td>
               <td width="8%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Description </strong></td>
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Unit Price </strong></td>
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Qty </strong></td>
               
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Net Amount </strong></td>
               
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Tax Rate </strong></td>
               
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Tax Type </strong></td>
               
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong> Tax Amount </strong></td>
               
               <td width="1%" valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333; border-right:1px solid #333;" align="left"><strong> Total Amount </strong></td>
               
               </tr>
               <?php if(count($order_products)>0){ $i = 0;$qty = 0;$total_amt = 0;
                      $rowCount = 0;
                      //echo '<pre>';print_r($order_products);exit;
                   foreach ($order_products as $ord){
                    $rowCount = $rowCount + 1;
                    $product_size = $this->db->query("select * from product_sizes where id=".$ord->psid)->result();
						//echo $this->db->last_query();exit;
                        $products = $this->db->query("select * from products where id=".$product_size[0]->pid)->result();
                       
                        //echo '<pre>';print_r($products);exit;
                        
                      $pname .= $products[0]->name;
                      $qty += $ord->qty; 
                      $i = $i+1;
                   ?>
               
               <tr>
              
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> <?php echo $i;?> </td>
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> 
              <?php echo $pname?></td>
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> 
               <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0; font-weight:500;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $this->orders_db->getnumberformat($ord->unit_price);?></h3> </td>
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> <?php echo $ord->qty;?> </td>
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> 
               <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0; font-weight:500;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $this->orders_db->getnumberformat($ord->price);?> </h3> </td>
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> <?php echo $this->orders_db->getnumberformat($ord->igst_per);?> %  </td>
             
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> IGST </td>
             
              <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"> 
               <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0; font-weight:500;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $this->orders_db->getnumberformat($ord->igst_amt);?> </h3> </td>
             
             <td valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;" 
                align="left"> <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0; font-weight:500;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $this->orders_db->getnumberformat($ord->price+$ord->igst_amt);?> </h3> </td>
             
             </tr>  
			   <?php }}?>
			<tr>
              
               <td colspan="8" valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"><strong>Delivery Charges: </strong></td>
               
               
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-right:1px solid #333; border-left:1px solid #333;" align="left"><strong>
                <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $order[0]->devilery_charge;?> </h3>  </strong> </td>
              
             </tr>
                <tr>
              
               <td colspan="7" valign="top" style="padding:7px; border-bottom:1px solid #333; border-left:1px solid #333;" align="left"><strong> TOTAL: </strong></td>
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-left:1px solid #333;" align="left"><strong>
               <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;"><?php echo $this->orders_db->getnumberformat($ord->price+$ord->igst_amt);?></h3>  
               </strong> </td>
               
               <td valign="top" style="padding:7px; border-bottom:1px solid #333; background-color: #ccc; border-right:1px solid #333; border-left:1px solid #333;" align="left"><strong>
                <h3 style="font-size:16px; font-style:normal; margin:0px 22px 0px 0;">
               <img src="<?php echo asset_url(); ?>images/rupee.png" style="display: inline-block;">
				<?php echo $this->orders_db->getnumberformat($order[0]->devilery_charge+$ord->price+$ord->igst_amt);?> 			   </h3>  </strong> </td>
              
             </tr>  
             
             
             
             
             <tr>              
             
               <td colspan="9" valign="top" style="padding:3px; font-size:16px; border-bottom:1px solid #333; border-right:1px solid #333; border-left:1px solid #333;" 
               align="left"><strong> Amount in Words: <br />
			  <?php echo $this->report_db->convertNumberToWordsForIndia(round($orders[0]->total_amt_paid));?> </strong></td>
             
             </tr> 
             
             
             <tr>              
             
               <td colspan="9" valign="top" style="padding:7px; font-size:16px; border-bottom:1px solid #333; border-right:1px solid #333; border-left:1px solid #333;" 
               align="right"><strong> 222, baker street Oiishee The<br/>
							Gift Of Nature Bengaluru: <br />
               <img src="<?php echo asset_url(); ?>images/sign.jpg"/> <br />
			   Authorized Signatory </strong></td>
             
             </tr>  
             
             
             <tr>              
             
               <td colspan="9" valign="top" style="padding:2px; font-size:15px;" 
               align="left"> Whether tax is payable under reverse charge - No </td>
             
             </tr> 
</table>			 

</body>
</html>