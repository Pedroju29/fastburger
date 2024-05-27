<?php
include '../config/dbConfig.php';
include '../partials/header.php';
include '../partials/navigation.php';

$orders = $conn->prepare("SELECT
o.order_id,
o.order_date,
o.fk_payment_id,
c.customer_name,
p.payment_type
 from `orders` o
 INNER JOIN customer c ON o.fk_customer_id = c.customer_id
 INNER JOIN menu_type m ON o.fk_menu_type_id = m.menu_type_id
 INNER JOIN payment p ON o.fk_payment_id = p.payment_id
 ORDER BY o.order_date DESC
");
$orders->execute();
$orders->store_result();
$orders->bind_result($oid, $date, $fk_payment_type, $customer, $payment_type);
?>

<!-- component -->
<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
  <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Id</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order Date</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Menu</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cash / Card</th>
        <th scope="col" class="px-6 py-4 font-medium text-gray-900">View order details</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
    <?php while($orders->fetch()) : ?>
      <tr class="hover:bg-gray-50">
      <td class="px-6 py-4"><?= $oid ?></td>
        <td class="px-6 py-4"> <?= $customer ?></td>
        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
            <?= $date ?>
          </span>
        </td>
        <td class="px-6 py-4">Lunch</td>
        <td class="px-6 py-4">
          <div class="flex gap-2"><span class="inline-flex items-center gap-1 text-white rounded-full <?php if($fk_payment_type == 1) : ?> bg-green-500 <?php elseif($fk_payment_type == 2) : ?>bg-yellow-800 <?php else : ?> bg-red-400 <?php endif ?> px-2 py-1 text-xs font-semibold text-blue-600">
              <?= $payment_type ?>
            </span>
          </div>
        </td>
        <td class="px-6 py-4">
        <i class="fa-solid fa-eye"></i>
        </td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php
include '../partials/footer.php';