<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .actions button {
            background-color: #000;
            color: #fff;
            width: 40px;
            height: 40px;
        }

        .actions .qty-box {

            height: 40px;
        }

        .img-responsive {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <br><br><br><br>
        <div class="row">

            <?php $i = 1;
            while ($i <= 3) { ?>
                <div class="col-md-4 box">
                    <div>
                        <img class="img img-responsive" src="https://www.theshapersark.org/uploads/books/2.jpg" alt="">
                    </div>
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit
                    </p>
                    <div class="actions text-center">
                        <button class="btn btn-dec" data-ref=<?php echo $i; ?>>-</button>
                        <input type="number" readonly value="0" class="qty-box" data-ref=<?php echo $i; ?>>
                        <button class="btn btn-inc" data-ref=<?php echo $i; ?>>+</button>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>

        <div class="text-center">
            <br><br>
            <button id="btn-submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


    <script src="js/jquery-3.5.1.min.js" ></script>
    <script>
        $(function() {
            $('.btn-dec').each(function() { //decremental buttons
                $(this).click(function() {
                    const ref = $(this).data('ref');
                    const input = $(`.qty-box[data-ref='${ref}'`);
                    let previousQty = Number(input.val());

                    if (previousQty > 0) { //qty cannot be less than 0
                        input.val(--previousQty);
                    }
                })
            })


            $('.btn-inc').each(function() {
                $(this).click(function() {
                    const ref = $(this).data('ref');
                    const input = $(`.qty-box[data-ref='${ref}'`);
                    let previousQty = Number(input.val());
                    input.val(++previousQty);
                })
            });


            $('#btn-submit').click(function() {
                let selectedItems = [];

                $('.qty-box').each(function() {
                    const qty = Number($(this).val());
                    if (qty > 0) {
                        const temp = {
                            itemId: $(this).data('ref'),
                            qty
                        }
                        selectedItems.push(JSON.stringify(temp));
                    }

                });

                console.log(selectedItems);


                /*

                YOU CAN THEN PASS selectedItems to the SERVER
               
                $.ajax({
                    url: 'YOUR_SERVER_URL',
                    type: 'POST',
                    data: {
                        items: selectedItems
                    },
                    success: function(response) {
                        // Some actions here
                    },
                    error: function(error) {
                        // Some actions here
                    }
                });

                */
            });
        })
    </script>
</body>

</html>
<?php

/*


if (isset($_POST['items'])) {
    $items = $_POST['items'];

    foreach ($items as $item => $value) {
        $data = json_decode($value);
        $id = $data->itemId;
        $qty = $data->qty;

        //bla bla bla
    }
}

*/
?>