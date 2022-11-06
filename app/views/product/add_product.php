

<nav class="navbar">
    <div class="container">
        <h3 class="text-uppercase">add product</h3>
        <br><br>       
        <a href="/" class="btn btn-info float-right ml-auto">Go Back</a>
        
    </div>
</nav><hr>
<br>

<?php if (!empty($errors)) : ?>
    <div class="container mb-5 alert alert-danger">
        <h5>In valid data input!</h5>
        <ul class="m-0">
            <?php foreach ($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form  action="/product/add_product"  method="post" name="form" id="form1" class="form-validation" class="form-horizontal">
                <div class="form-group">
                    <label for="sku" class="col-sm-2 control-label">SKU</label>
                    <div class="col-sm-10">
                    <input type="text" name="sku" class="form-control" id="sku" required><span id="chksku" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" required><span id="chkname" ></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" step="1" min="1" name="price" class="form-control" id="price" required><span id="chkprice"></span>
                </div>
                </div>
                <div class="form-group">
                    <label for="typeSwitch" class="col-sm-2 control-label">Type switcher</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="typeSwitch" name="typeSwitch" required>
                        <option selected value=''>please choose</option>
                        <option value="disc">DVD-disc</option>
                        <option value="book">Book</option>
                        <option value="furniture">Furniture</option>
                    </select><span id="chktype"></span>
                    </div>
                </div>
                <div id="type">                    
                        <section class="form-group box selectable" name="disc" id="disc">
                            <label for="size" class="col-sm-2 control-label">Size</label>
                            <div class="col-sm-10">
                            <input type="number" step="1" min="1" name="size" class="form-control" id="size" ><span id="chksize"></span>
                            </div>
                        </section>
                        <section class="form-group box selectable" name="book" id="book">
                            <label for="weight" class="col-sm-2 control-label">Weight</label>
                            <div class="col-sm-10">
                            <input type="number" step="1" min="1" name="weight" class="form-control" id="weight" ><span id="chkweight"></span>
                            </div>
                        </section>
                        <section class="form-group  box selectable" name="furniture" id="furniture">
                            <label type="number" step="1" min="1" class="col-sm-2 control-label">Length</label>
                            <div class="col-sm-10">
                            <input type="number" step="1" min="1" name="length" class="form-control" id="length" ><span id="chklength"></span>
                            </div>
                            <label for="width" class="col-sm-2 control-label">Width</label>
                            <div class="col-sm-10">
                            <input type="number" step="1" min="1" name="width" class="form-control" id="width" ><span id="chkwidth"></span>
                            </div>
                            <label for="height" class="col-sm-2 control-label">Height</label>
                            <div class="col-sm-10">
                            <input type="number" step="1" min="1" name="height" class="form-control" id="height" ><span id="chkheight"></span>
                            </div>
                            <small>Please provide dimensions in HxWxL format.</small>
                        </section>
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="Submit" value="Submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>
 