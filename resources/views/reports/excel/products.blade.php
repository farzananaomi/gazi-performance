<!doctype html>
<html>
<head>
    <title>Products Sale Sheet</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        th {
            text-align: center;
        }
        .box {
            border: 1px solid #000;
        }
    </style>
</head>
<body>

<div class=table-responsive><table>
    <thead>
    <tr>
        <th colspan="12" style="font-size: 32px;">GAZI PIPES - Product Sales Chart</th>
    </tr>
    <tr>
        <th colspan="3" class="box">Report for <strong>{{ "$month, $year" }}</strong></th>
        <th></th>
        <th colspan="2" class="box">Total Sales (Tk.) : Tk. {{ number_format($totalSalesCash, 2) }}</th>
        <th></th>
        <th colspan="2" class="box">Total Quantity (Pcs) : {{ $totalSalesQuantity }}</th>
        <th></th>
        <th colspan="2" class="box">Total Quantity (Kg) : {{ number_format($totalSalesWeight, 2) }} Kg</th>
    </tr>
    <tr>
        <th colspan="12"></th>
    </tr>
    <tr style="border-bottom: 2px solid #f4f4f4;">
        <th>Code</th>
        <th>Name</th>
        <th>Color</th>
        <th>Weight (Kg)</th>

        <th>Group</th>
        <th>Sub-group</th>
        <th>Price</th>
        <th>Total Weight</th>

        <th>Sales (Quantity)</th>
        <th>Sales (Tk.)</th>


        <th>% Quantity</th>
        <th>% Tk.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ $product->weight }}</td>

            <td>{{ $product->group->name }}</td>
            <td>{{ $product->subgroup->name }}</td>

            <td>{{ number_format($product->price, 2, '.', '') }}</td>
            <td>{{ $product->weight*$product->quantity }}</td>

            <td>{{ number_format($product->quantity, 2, '.', '') }}</td>
            <td>{{ number_format($product->cash, 2, '.', '') }}</td>

            <td>{{ $totalSalesQuantity > 0? number_format($product->quantity*100/$totalSalesQuantity, 2, '.', '') : '--' }}</td>
            <td>{{ $totalSalesCash > 0? number_format($product->cash*100/$totalSalesCash, 2, '.', '') : '--' }}</td>
        </tr>
    @endforeach
    </tbody>
</table></div>
</body>
</html>