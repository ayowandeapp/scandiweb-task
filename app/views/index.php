

<nav class="navbar">
    <div class="container">
        <h3 class="text-uppercase">product list</h3>
        <br><br>       
        <a href="/product/add_product" class="btn btn-info float-left">Add Item</a><br>
        <form action="/product/delete_product" method="post" id="delete-form" class="d-inline-block">
            <button for="delete-form" type="submit" class="btn btn-danger float-right" style="">Mass Delete</button><br>
        </form>

    </div>
</nav><hr>
<br>
<div class="container">        
    <div class="row">
        <?php foreach ($products as $res) : ?> 
        <div class="col-6 col-md-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <p><?= $res['sku']; ?></p>
                        <p><?= $res['name']; ?></p>
                        <p> $ <?= $res['price']; ?></p>
                        <p> <?= $res['value']; ?></p>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input form="delete-form" type="checkbox" name="<?= $res['id']; ?>" value="<?= $res['id']; ?>"></p>
                            </label>
                        </div>
                    </div>
                </div>
        </div>
        <?php endforeach ?>
    </div>    
        

</div>
        
             