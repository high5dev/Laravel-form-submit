<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
        }

        .submit-btn {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }

        .table tfoot td {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="form-header">Product Submission Form</h2>
                    <form id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" id="quantity" name="quantity_in_stock" placeholder="Enter available quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price per Item</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price_per_item" placeholder="Enter price per item" required>
                        </div>
                        <button type="submit" class="submit-btn">Submit Product</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-container">
                    <h3 class="mt-3">Submitted Products</h3>
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date/Time Submitted</th>
                                <th>Total Value</th>
                            </tr>
                        </thead>
                        <tbody id="productList">
                            <!-- AJAX-loaded products will be displayed here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total Sum</td>
                                <td id="totalSum"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            loadProducts();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#productForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/submit-product',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#productForm')[0].reset();
                        loadProducts();
                    }
                });
            });

            function loadProducts() {
                $.ajax({
                    url: '/get-products',
                    method: 'GET',
                    success: function (products) {
                        let productList = '';
                        let totalSum = 0;

                        products.forEach(product => {
                            const totalValue = product.quantity_in_stock * product.price_per_item;
                            totalSum += totalValue;

                            productList += `
                                <tr>
                                    <td>${product.product_name}</td>
                                    <td>${product.quantity_in_stock}</td>
                                    <td>${product.price_per_item}</td>
                                    <td>${product.created_at}</td>
                                    <td>${totalValue.toFixed(2)}</td>
                                </tr>
                            `;
                        });

                        $('#productList').html(productList);
                        $('#totalSum').text(totalSum.toFixed(2));
                    }
                });
            }
        });
    </script>
</body>

</html>
