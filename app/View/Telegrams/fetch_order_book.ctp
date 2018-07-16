<h1>Buy Orders</h1>
<table>
     
 <thead>
    <tr>
        <th>Price</th>
        <th>Volume</th>
    </tr>
</thead>
<tbody>
    <?php foreach($sell_array as $sell){ ?>
    <tr>
        <td><?= number_format((float)$sell['Price'], 8, '.', ''); ?></td>
        <td><?= $sell['Volume']; ?></td>
    </tr>
   <?php } ?> 
   
</tbody>

</table>

<h1>Sell Orders</h1>
<table>
     
 <thead>
    <tr>
        <th>Price</th>
        <th>Volume</th>
    </tr>
</thead>
<tbody>
    <?php foreach($buy_array as $buy){ ?>
    <tr>
        <td><?= number_format((float)$buy['Price'], 8, '.', ''); ?></td>
        <td><?= $buy['Volume']; ?></td>
    </tr>
   <?php } ?> 
   
</tbody>

</table>