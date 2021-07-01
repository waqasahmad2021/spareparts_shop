var globalArr = new Array(
    [
        "product1.jpg",
        "Honda",
        "123456789ab",
        "COVER ASSY, HEAD LAMP",
        "10",
        "100",
        "85",
    ],

    [
        "product2.jpg",
        "Toyota",
        "123456789cd",
        "Moto Oil, Engin Oil",
        "8",
        "400",
        "60",
    ],

    [
        "product18.jpg",
        "Nissan",
        "123456789ef",
        "Turbo system, Auto engin new",
        "100",
        "2000",
        "2",
    ],

    [
        "product3.jpg",
        "Honda",
        "123456789gh",
        "MICHELIN® Brand Tires",
        "0",
        "300",
        "0",
    ],
);

$(document).ready(function() {
    // var proTotalArr = $("#get_total_arr").val();

    $(".search_part_no_event").click(function() {
        var searchInput = $("#search_part_no").val();
        // alert(searchInput);
        var jqueryarray = globalArr;
        for (var i = 0; i < jqueryarray.length; i++) {
            // console.log(jqueryarray[i]);
            // console.log(jqueryarray[i][2]);
            if (jqueryarray[i][2] == searchInput) {
                // alert(jqueryarray[i][2] + "/" + searchInput);
                // console.log(jqueryarray[i]);
                var chkstock = "In stock";
                if (jqueryarray[i][4] == "0") {
                    var chkstock = "Out of stock";
                }
                var proHtml = "<tr class='hide_after_clear_filter'><td><img src='../assets/img/product/" + jqueryarray[i][0] + "' alt=''></td><td>" + jqueryarray[i][1] + "</td><td>" + jqueryarray[i][2] + "</td><td>" + jqueryarray[i][4] + " <label class='small-text'>Days</label></td><td>" + jqueryarray[i][5] + " <label class='small-text'>AED</label></td><td>" + jqueryarray[i][6] + " <label class='small-text'>" + chkstock + "</label></td><td class='product_quantity'><label class='small-text' >Quantity</label> <input id='pro_qnt' name='pro_qnt' class='chkevent' data_val='" + jqueryarray[i][6] + "'  min='1' max='100' value='' type='number'></td><td><span class='small-text'>" + jqueryarray[i][3] + "</span></td><td class='product_total'><a href='#'>Add To Cart</a></td></tr>";
                $(".search_result_html").html(proHtml);
                $(".partno_title").text(jqueryarray[i][2]);
                $(".partno_description").text(jqueryarray[i][1] + " , " + jqueryarray[i][3]);
                $(".toggle_event").show();


            }
        }

    });

    // quantity code start

    $("table tr td .chkevent").on("keyup", function() {
        alert("called");
        return;
        var qntInput = $(this).val();
        var stock_available = $(this).attr("data_val");
        // alert(qntInput + "/" + stock_available);
        // console.log(stock_available + "/" + qntInput);
        if (parseInt(qntInput) > parseInt(stock_available)) {
            alert("sorry we have in stock total " + stock_available);
        }
        if (parseInt(qntInput) <= parseInt(stock_available)) {
            $("#runtimeqnt").val(qntInput);
        }
    });

    $(".get_array_of_index").click(function() {


        // var menuId = $("ul.nav").first().attr("id");
        var indexVal = $(this).attr("data_indexvalue");
        var qantity = $("#runtimeqnt").val();
        var request = $.ajax({
            url: "addtocart.php",
            method: "POST",
            data: { indexes: indexVal, runtime_qantity: qantity },
            dataType: "json"
        });

        request.done(function(msg) {

            $(".carholder").append(msg.cart);
            var count = $(".carholder").find(".cart_item").length;
            $(".countofthecart").text(count);
            // console.log(msg.cart);
            // $("#log").html(msg);
        });

        request.fail(function(jqXHR, textStatus) {
            // alert("Request failed: " + textStatus);
            alert("Sorry!");
        });

    });

});

var input = document.getElementById("search_part_no");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        $(".search_part_no_event").click();
    }
});

function myFunc() {
    let name = input.value;
    if (name == "") {
        var jqueryarray = globalArr;
        for (var i = 0; i < jqueryarray.length; i++) {
            var chkstock = "In stock";
            if (jqueryarray[i][4] == "0") {
                var chkstock = "Out of stock";
            }
            $(".hide_after_clear_filter").hide();
            var proHtml = "<tr><td><img src='../assets/img/product/" + jqueryarray[i][0] + "' alt=''></td><td>" + jqueryarray[i][1] + "</td><td>" + jqueryarray[i][2] + "</td><td>" + jqueryarray[i][6] + " <label class='small-text'>Days</label></td><td>" + jqueryarray[i][5] + " <label class='small-text'>AED</label></td><td>" + jqueryarray[i][4] + " <label class='small-text'>" + chkstock + "</label></td><td class='product_quantity'><label class='small-text' >Quantity</label> <input min='1' max='100' id='pro_qnt' name='pro_qnt' value='1' type='number'></td><td><span class='small-text'>" + jqueryarray[i][3] + "</span></td><td class='product_total'><a href='#'>Add To Cart</a></td></tr>";
            $(".search_result_html").append(proHtml);
        }
        $(".toggle_event").hide();
    }
};


