<!-- 
   Invoices Generator - 2015
   Free and Open Source
   Developed by Mohamed Zakaria SAIDANE
   https://github.com/medzaksdn/InvoiceGenerator
-->

<STYLE TYPE="text/css">
<!--
@page { margin: 2cm }
P { margin-bottom: 0.21cm }
TD P { margin-bottom: 0cm }
table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
-->
</STYLE>

<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm">

<page_header>
 <table class="page_header">
  <tr>
   <td style="width: 100%; text-align: right">
    <b style="color:#FF3B00;">INVOICE ID : </b><?= $invoiceID ?><br>
    <b style="color:#FF3B00;">Date : </b><?= $invoiceDate ?><br>
   </td>
  </tr>
 </table>
</page_header>

<br>
<p align="center" style="margin-bottom: 0cm; line-height: 100%; width: 50%;">
  <span style="font-size: 200%; text-align: center; font-family:times; color:#FF3B00;"><b>INVOICE : <?= $invoiceName ?></b></span>
  <br><br><?= $logo ?>
  <br><br><br><br><br><br>
</p>

<table cellspacing="0" style="width: 100%; font-size: 14px; text-align: center;">
<tr>
<td style="width: 20%; text-align: left;"></td>
<td style="width: 30%; text-align: left;">
<b style="color:#FF3B00;" >BILLING FROM</b><br><br>
<?= $businessName1 ?><br><br>
<?= $adressline1 ?><br>
<?= $phone1 ?><br>
<?= $email1 ?> 				
</td>
<td style="width: 10%; text-align: left;"></td>
<td style="width: 30%; text-align: left;">
<b style="color:#FF3B00;" >BILLING TO</b><br><br>
<?= $businessName2 ?><br><br>
<?= $adressline2 ?><br>
<?= $phone2 ?><br>
<?= $email2 ?> 
</td>
<td style="width: 10%; text-align: left;"></td>
</tr>
</table>

<br><br>

<table cellspacing="0" style="width: 100%; font-size: 14px; text-align: center;">
<tr>
<td style="width: 10%;"></td>  
<td style="width: 80%; text-align:right;">
<table cellspacing="0" style="width: 100%; background: #E7E7E7; text-align: center; font-size: 10pt;">
 <tr bgcolor="#AAAADD" >
 <th style="width: 30%;">ITEM	</th>
 <th style="width: 20%;">QUANTITY</th>
 <th style="width: 25%;">PRICE</th>
<th style="width: 25%;">Total</th>
</tr>
<?= $items ?>
</table>
</td>
<td style="width: 10%;"></td>
</tr>
</table>

<br>

<table cellspacing="0" style="width: 100%; font-size: 14px; text-align: center;">
<tr>
<td style="width: 60%;"></td>  
<td style="width: 30%; text-align:right;">
<table cellspacing="0" style="width: 100%; background: #E7E7E7; text-align: center; font-size: 10pt;" border="1">
<tr bgcolor="#AAAADD" >
 <th style="width: 50%"></th>
 <th style="width: 50%">Amount</th>
</tr>
<tr>
 <td style="width: 50%;">Subtotal : </td>
 <td style="width: 50%;"><?= $subtotalhidden ?> <?= $currency ?></td>
</tr>
<tr>
 <td style="width: 50%;">Discount : </td>
 <td style="width: 50%;"><?= $discountvalue ?> %</td>
</tr>
<tr>
 <td style="width: 50%;">Tax : </td>
 <td style="width: 50%;"><?= $taxvalue ?> %</td>
</tr>
<tr>
 <td style="width: 50%;">Total : </td>
 <td style="width: 50%;"><?= $totalhidden ?> <?= $currency ?></td>
</tr>
</table>
</td>
<td style="width: 10%;"></td> 
</tr>
</table>

<br><br><br>

<table cellspacing="0" style="width: 100%; font-size: 14px; text-align: center;">
<tr>
 <td style="width: 5%;"></td>
 <td style="width: 40%; text-align: left; font-weight: bold;"><?= $notesdisplay ?></td>
 <td style="width: 10%;"></td>
 <td style="width: 40%; text-align: left; font-weight: bold;"><?= $termsdisplay ?></td>
 <td style="width: 5%;"></td>
</tr>
<tr>
 <td style="width: 5%;"></td>
 <td style="width: 40%; text-align: left;"><?= $notes ?></td>
 <td style="width: 10%;"></td>
 <td style="width: 40%; text-align: left;"><?= $terms ?></td>
 <td style="width: 5%;"></td>
</tr>
</table>

<page_footer>
 <table class="page_footer">
  <tr>
   <td style="width: 80%; text-align: left">
     <b>INVOICE GENERATOR</b>
   </td>
   <td style="width: 20%; text-align: right">
     Page [[page_cu]]/[[page_nb]]
    </td>
  </tr>
 </table>
</page_footer>

</page>