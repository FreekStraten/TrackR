<!DOCTYPE html>
<html>
<head>
    <title>Create a Packet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
{{--@extends('layouts.app')--}}


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create a Packet</h1>
                <hr>
                <form method="POST" action="{{ route('packets.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tracking_number">Tracking Number:</label>
                        <input type="text" name="tracking_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="format">Format:</label>
                        <select name="format" class="form-control" required>
                            <option value="letter">Letter</option>
                            <option value="parcel">Parcel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (in grams):</label>
                        <input type="number" name="weight" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_address">Shipping Address:</label>
                        <textarea name="shipping_address" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="delivery_address">Delivery Address:</label>
                        <textarea name="delivery_address" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Packet</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
