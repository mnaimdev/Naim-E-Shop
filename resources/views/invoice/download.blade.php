<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 14cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="https://i.postimg.cc/7Lm30rSg/logo.png">
        </div>
        <h1>INVOICE {{ $billing_details->first()->order_id }}</h1>
        <div id="company" class="clearfix">
            <div>Tanisha Commerce</div>
            <div>Kamrangir Char,<br /> Dhaka, BD</div>
            <div>(+88) 01794-556889</div>
            <div><a href="mailto:tanisha@eshop.com">tanisha@eshop.com</a></div>
        </div>
        <div id="project">
            <div><span>To</span> {{ $billing_details->first()->name }}</div>
            <div><span>Country</span> {{ $billing_details->first()->country }}</div>
            <div><span>ADDRESS</span> {{ $billing_details->first()->address }}</div>
            <div><span>EMAIL</span> <a
                    href="mailto:{{ $billing_details->first()->email }}">{{ $billing_details->first()->email }}</a></div>
            <div><span>DATE</span> {{ $billing_details->first()->created_at->format('d-M-Y') }}</div>

        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Issue Date</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($order_products as $product)
                    <tr>
                        <td class="service">{{ $product->rel_to_product->product_name }}</td>
                        <td class="unit">{{ $product->rel_to_product->after_discount }} TK</td>
                        <td class="qty">{{ $product->quantity }}</td>
                        <td class="total">{{ $product->rel_to_product->after_discount }} x {{ $product->quantity }}
                            TK
                        </td>
                        <td>
                            {{ $product->created_at->format('Y-m-d') }}
                        </td>

                    </tr>
                @endforeach


                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total">{{ $order_info->sub_total }} TK</td>
                </tr>

                <tr>
                    <td colspan="4">Discount</td>
                    <td class="total">{{ $order_info->discount }} TK</td>
                </tr>

                <tr>
                    <td colspan="4">Charge</td>
                    <td class="total">{{ $order_info->charge }} TK</td>
                </tr>

                <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">{{ $order_info->total }} TK
                    </td>
                </tr>

            </tbody>
        </table>

    </main>

</body>

</html>
